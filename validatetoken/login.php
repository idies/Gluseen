<?php

$url = 'scitest02.pha.jhu.edu/login-portal/reguser';
//$url='10.55.17.52';
$token='6c09c8f8-0fff-45d4-9750-588227ed1a1c';

 $ch=curl_init(); 
 curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
	//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Api-Key:'.$token,'Content-Type:application/json'));
    // same as <input type="file" name="file_box">
    $post = array(
        "UserName"=>"test121212",
		"Email"=>"test1212@gmail.com",		
		"Password"=>'test1212',
		"ConfirmPassword"=>'test1212'
		
		//"domain_id"=>"default",
    );
	$data_string = json_encode($post);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
    $response = curl_exec($ch);
	
	$info = curl_getinfo($ch);
$http_code = (int) $info['http_code'];


if ($http_code !== 201)
{
echo $http_code;
echo "Error";
 throw new Exception("Error.");
}
else
{
echo $response;
}
 // list($header, $body) = explode("\r\n\r\n", $response, 2);
 //echo $header;
 // echo "<br>";
  // $token=substr($header,139,32);
  // echo $token;


?>