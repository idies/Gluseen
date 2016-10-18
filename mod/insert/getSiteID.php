<?php




$sitename = $_REQUEST['sitename'];
require $_SERVER["DOCUMENT_ROOT"].'/constants.php';
$url = DB_URL;
//$url='10.55.17.52';
$token= $_COOKIE['token'];
//echo $token;
 $ch=curl_init(); 
 curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth-Token:'.$token,'Content-Type:application/json'));

   $post = array(
    
 "Query"=> "select SiteID from Site where Name='".$sitename."'"

 
  );
	$data_string = json_encode($post);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
    $data = curl_exec($ch);
	echo $data;
?>
