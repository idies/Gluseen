<?php
$filename="addsite";

$csv_filename = $filename."_".date("Ymd_Hi",time()).".csv";
$data = $_REQUEST['data'];

$list=explode(';', $data); 

$array = array();
foreach ($list as $fields) {
 $fields=explode(',', $fields); 
 $array[] =$fields;
}
//$fp = fopen($directory.$csv_filename, 'w');
$fp = fopen( 'php://memory', 'r+' );


 //    fwrite ($fp,$data);
 foreach ($array as $fields) {

    fputcsv($fp, $fields);
}


// echo fread($fp, 8192);
//fclose($fp);
require $_SERVER["DOCUMENT_ROOT"].'/constants.php'; 
$token= $_COOKIE['token'];


//$filesize=$_FILES['file']['size'];
//$file =fopen($directory.$csv_filename, 'rb');
//$file = fopen('php://temp', 'rb');

rewind($fp);
//$file1=stream_get_contents($fp);

//echo $file1;
$url = ROOT_URL.'/vospace-2.0/1/files_put/dropbox/Gluseen/Gluseen-site/'.rawurlencode($csv_filename).'?overwrite=true';
$ch=curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_PUT, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth-Token:'.$token,'Content-Type:application/file'));		
curl_setopt($ch, CURLOPT_INFILE, $fp);
//curl_setopt($ch, CURLOPT_INFILESIZE, $filesize);
$response = curl_exec($ch);
curl_close($ch);
if ($response) {
 // echo $response;
 echo "<br>";
 echo "<h3>Upload Successfully</h3><br>";

 
 
 
}
else {
  echo "<h3>Upload Failed!</h3>";
}


?>