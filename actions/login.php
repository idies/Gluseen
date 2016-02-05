<?php
/**
 * Elgg login action
 *
 * @package Elgg.Core
 * @subpackage User.Authentication
 */
//require $_SERVER["DOCUMENT_ROOT"].'/constants.php'; 
// set forward url

//$session = elgg_get_session();
if (!empty($_SESSION['last_forward_from'])) {
  $forward_url = $_SESSION['last_forward_from'];
   $forward_source = 'last_forward_from';
} elseif (get_input('returntoreferer')) {
  $forward_url = REFERER;
   $forward_source = 'return_to_referer';
} else {
  // forward to main index page
  $forward_url = '';
   $forward_source = null;
}

$username = get_input('username');
$password = get_input('password', null, false);
$persistent = (bool) get_input("persistent");
$result = false;
if (empty($username) || empty($password)) {
  register_error(elgg_echo('login:empty'));
  forward();
}

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
/*
$url = PORTAL_URL.'/keystone/v3/tokens';
$ch=curl_init(); 

    $post = array(
      "auth"=> array(
        "identity"=> array(
          "methods"=> array(
            "password"
          ),
          "password"=> array(
            "user"=> array(
              "domain"=> array(
                "name"=>"Default"
              ),
              "name"=> $username,
              "password"=> $password
            )
          )
        ),
        "scope"=> array(
          "project"=> array(
            "name"=> $username,
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
    
 
$result = curl_exec($ch);
$info = curl_getinfo($ch);
$http_code = (int) $info['http_code'];

if ($http_code !== 200)
{
  // throw new Exception("Could not obtain token.");
}
else
{

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
*/
try {
  login($user, $persistent);
 // re-register at least the core language file for users with language other than site default
  register_translations(dirname(dirname(__FILE__)) . "/languages/");
} catch (LoginException $e) {
  register_error($e->getMessage());
  forward(REFERER);
}

//elgg_echo() caches the language and does not provide a way to change the language.
//@todo we need to use the config object to store this so that the current language
//can be changed. Refs #4171

if ($user->language) {
  $message = elgg_echo('loginok', array(), $user->language);
} else {
 $message = elgg_echo('loginok');
}
/*
if (isset($_SESSION['last_forward_from'])) {
  unset($_SESSION['last_forward_from']);
}
*/
 $session->remove('last_forward_from'); 
 $params = array('user' => $user, 'source' => $forward_source);
 $forward_url = elgg_trigger_plugin_hook('login:forward', 'user', $params, $forward_url);
system_message($message);
forward($forward_url);


 //$token_id = $_GET['token'];
 //setcookie('token', $token_id, time() + 60*60*24); // Cookie expires in 1 day.
 /*
try {
		  
      
      
        
        if (empty($_GET['token']) && empty($_COOKIE['token'])) 
        {
          /* If no token has been found, just throw an exception. 
          We will take care of it later. */
  /*        throw new Exception('You are not signed in.');
        }
        else 
        {
          $token_id = '';
          if (!empty($_GET['token'])) // Request parameter has precedence over cookies.
          {
            $token_id = $_GET['token'];
          }      
          else  if (!empty($_COOKIE['token']))
          {
            $token_id = $_COOKIE['token'];
          }
          
          /* Try to validate the token. */
  /*        try 
          {
            $user_info = validate_token($token_id);
          }
          catch (Exception $e) 
          {
           /* If there was a cookie, erase it. Otherwise, we'll keep getting this
            error over and over again with every page reload! */
      /*      setcookie('token', null, 0); 
            
           
            throw $e;
          }
          
          /* If we got this far, then we have a valid token. 
          Store it in a cookie and display user's info. */
/*          setcookie('token', $token_id, time() + 60*60*24); // Cookie expires in 1 day.
          $linked_user_id = try_get_linked_user($user_info->token->user->id);
          show_user_info_v3($token_id, $user_info, $linked_user_id);
          
       
     //     echo '<input type="button" onclick="sign_out()" value="Sign Out"/>';
        }
      }
	  
      catch (Exception $e) 
      {
    
        echo '<p>'.$e->getMessage().'</p>';
        echo '<input type="button" onclick="sign_in()" value="Sign In" />';
      }
	  
*/	  