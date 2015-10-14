<?php
$filename="addplot";
$directory="uploads/";
$csv_filename = $filename."_".date("Ymd_Hi",time()).".csv";
$data = $_REQUEST['data'];

$list=explode(';', $data); 
//echo $data;
$array = array();
foreach ($list as $fields) {
 $fields=explode(',', $fields); 
 $array[] =$fields;
}
$fp = fopen($directory.$csv_filename, 'w');


 //    fwrite ($fp,$data);
 foreach ($array as $fields) {

    fputcsv($fp, $fields);
}


fclose($fp);

require $_SERVER["DOCUMENT_ROOT"].'/constants.php'; 
$token= $_COOKIE['token'];

//$filedata = $_FILES['file']['tmp_name'];
//$filesize=$_FILES['file']['size'];
$file =fopen($directory.$csv_filename, 'rb');
$url = ROOT_URL.'/vospace-2.0/1/files_put/dropbox/Gluseen/AddPlot/'.rawurlencode(basename($directory.$csv_filename)).'?overwrite=true';
$ch=curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_PUT, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth-Token:'.$token,'Content-Type:application/file'));		
curl_setopt($ch, CURLOPT_INFILE, $file);
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