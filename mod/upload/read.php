<?php


$site=$_POST['site'];



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
	
    // same as <input type="file" name="file_box">
   $post = array(
	"Query"=>"select p.PlotID as ID, p.Name from Plot as p, Site as s where p.SiteID=s.SiteID and s.Name='".$site."'"
	
	);
	$data_string = json_encode($post);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
    $data = curl_exec($ch);





echo $data
?>