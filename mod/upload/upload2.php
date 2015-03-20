<?php

//$name=elgg_get_logged_in_user_entity()->name;

require $_SERVER["DOCUMENT_ROOT"].'/constants.php'; 
$token= $_COOKIE['token'];


$filename = $_FILES['file']['name'];
$filedata = $_FILES['file']['tmp_name'];



$url = ROOT_URL.'/vospace-2.0/1/files_put/dropbox/Test/'.basename($_FILES["file"]["name"]).'?overwrite=true';
//$url='10.55.17.52/testupload/uploads/';
 //$fp = fopen('http://urlToFileToUpload.com');
 //$token='d621c30e7b92414d9ce71d7d2b1b23be';
 //echo $_FILES["fileToUpload"]["tmp_name"];
 $ch=curl_init();
 curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
	//curl_setopt($ch, CURLOPT_UPLOAD, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth-Token:'.$token,'Content-Type:application/file'));
	
	
	// same as <input type="file" name="file_box">
  
  //  $post = array(
 //       "file_box"=>$_FILES["file"]["tmp_name"],
 //   );
     $post = array("filedata" => "@$filedata", "filename" => $filename);
	//$file_name_with_full_path = realpath($_FILES['file']['name'];
   // $post = array('extra_info' => '123456','file_contents'=>'@'.$file_name_with_full_path);
   
   curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    //curl_setopt($ch, CURLOPT_INFILE, $fh);
    //curl_setopt($ch, CURLOPT_INFILESIZE, strlen($post));
    
    $response = curl_exec($ch);
	if ($response){
		echo $response;
		//header('Location:http://scitest09.pha.jhu.edu/scidrive');
	}
	else
		echo "Upload Failed!";
    fclose($fh);
?>