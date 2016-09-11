<?php
$name=$_POST['name'];
$password=$_POST['password'];
$url = 'scitest02.pha.jhu.edu/login-portal/keystone/v3/tokens';
//$url='10.55.17.52';
//$token='6c09c8f8-0fff-45d4-9750-588227ed1a1c';

 $ch=curl_init(); 
 curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	//curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Api-Key:'.$token,'Content-Type:application/json'));
    // same as <input type="file" name="file_box">
    $post = array(
      "auth"=> array(
        "identity"=> array(
          "methods"=> array(
            "password"
          ),
          "password"=> array(
            "user"=> array(
              "domain"=> array(
                "id"=>"Default"
              ),
              "name"=> $name,
              "password"=> $password
            )
          )
        ),
        "scope"=> array(
          "project"=> array(
            "name"=> $name,
          )
        )
      )      
    );
	$data_string = json_encode($post);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
    $result = curl_exec($ch);
$info = curl_getinfo($ch);
$http_code = (int) $info['http_code'];
//echo $result;

if ($http_code !== 200)
{
 throw new Exception("Could not obtain token.");
}
else
{
  /* Retrieve token id from header by parsing header lines
  one by one. We need the X-Subject-Token field. */
  $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  $header = substr($result, 0, $header_size);
  $header_list = explode("\r\n", $header);
 // echo $header;
  foreach ($header_list as &$str)
  {
    list($key, $value) = array_pad(explode(':', $str, 2), 2, null);
	
    if ($key === "X-Subject-Token")
    {
      $token_user = trim($value);
    }
  }
} 
//echo $token_user;
curl_close($ch);	

  $url4 = 'scitest02.pha.jhu.edu/login-portal/keystone/v3/tokens/'.$token_user;
 $ch=curl_init();
 curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_URL, $url4);
    //curl_setopt($ch, CURLOPT_GET, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	
 

    

    
    $response3 = curl_exec($ch);
	echo $response3;
 
?>