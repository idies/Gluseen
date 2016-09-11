<?php
$url = 'http://scitest09.pha.jhu.edu/vospace-2.0/1/files_put/dropbox/test/'.basename($_FILES["fileToUpload"]["name"]).'?overwrite=true';
//$url='10.55.17.52/testupload/uploads/';
 //$fp = fopen('http://urlToFileToUpload.com');
 $token='35b6e6fe6de34eceaaa4255189e7c42f';
 echo $_FILES["fileToUpload"]["tmp_name"];
 $ch=curl_init();
 curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth-Token:'.$token,'Content-Type:application/file'));
	
    // same as <input type="file" name="file_box">
    $post = array(
        "file_box"=>$_FILES["fileToUpload"]["tmp_name"],
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
    $response = curl_exec($ch);
	echo $response;
?>