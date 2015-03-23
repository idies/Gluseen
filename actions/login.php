<?php
/**
 * Elgg login action
 *
 * @package Elgg.Core
 * @subpackage User.Authentication
 */
require $_SERVER["DOCUMENT_ROOT"].'/constants.php'; 
// set forward url
if (!empty($_SESSION['last_forward_from'])) {
  $forward_url = $_SESSION['last_forward_from'];
} elseif (get_input('returntoreferer')) {
  $forward_url = REFERER;
} else {
  // forward to main index page
  $forward_url = '';
}

$username = get_input('username');
$password = get_input('password', null, false);
$persistent = (bool) get_input("persistent");
$result = false;

if (empty($username) || empty($password)) {
  register_error(elgg_echo('login:empty'));
  forward();
}

// check if logging in with email address
if (strpos($username, '@') !== false && ($users = get_user_by_email($username))) {
  $username = $users[0]->username;
}

$result = elgg_authenticate($username, $password);
if ($result !== true) {
  register_error($result);
  forward(REFERER);
}

$user = get_user_by_username($username);
if (!$user) {
  register_error(elgg_echo('login:baduser'));
  forward(REFERER);
}

$url = ROOT_URL.'/keystone/v3/auth/tokens';

$ch=curl_init(); 

/*
  curl_setopt($ch, CURLOPT_HEADER, 1);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  
  // same as <input type="file" name="file_box">
*/

    $post = array(
      "auth"=> array(
      "identity"=> array(
        "methods"=> array(
          "password"
        ),
        "password"=> array(
          "user"=> array(
            "domain"=> array(
              "id"=>"default"
            ),
            "name"=> $username,
            "password"=> $password
          )
        )
      )
    )
  );
  
  $data_string = json_encode($post);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
    
/*
  $response = curl_exec($ch);
  echo $response;
  list($header, $body) = explode("\r\n\r\n", $response, 2);
  //echo $header;
  echo "<br>";
  $token=substr($header,140,32);
  echo $token;
*/
 
$result = curl_exec($ch);
$info = curl_getinfo($ch);
$http_code = (int) $info['http_code'];

/* Sucessful token request should return HTTP status code:
201 Created. */
if ($http_code !== 201)
{
  // throw new Exception("Could not obtain token.");
}
else
{
  /* Retrieve token id from header by parsing header lines
  one by one. We need the X-Subject-Token field. */
  $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  $header = substr($result, 0, $header_size);
  $header_list = explode("\r\n", $header);
  foreach ($header_list as &$str)
  {
    list($key, $value) = array_pad(explode(':', $str, 2), 2, null);
    if ($key === "X-Subject-Token")
    {
      $token = trim($value);
    }
  }
}   
   
setcookie("token", $token, time() + 60*60*24,'/');

try {
  login($user, $persistent);
  // re-register at least the core language file for users with language other than site default
  register_translations(dirname(dirname(__FILE__)) . "/languages/");
} catch (LoginException $e) {
  register_error($e->getMessage());
  forward(REFERER);
}

// elgg_echo() caches the language and does not provide a way to change the language.
// @todo we need to use the config object to store this so that the current language
// can be changed. Refs #4171
if ($user->language) {
  $message = elgg_echo('loginok', array(), $user->language);
} else {
  $message = elgg_echo('loginok');
}

if (isset($_SESSION['last_forward_from'])) {
  unset($_SESSION['last_forward_from']);
}

system_message($message);
forward($forward_url);
