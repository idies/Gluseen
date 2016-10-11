<?php
require $_SERVER["DOCUMENT_ROOT"].'/constants.php'; 
$token_user = $_COOKIE['token'];
	$container_name='Gluseen/Gluseen-site';
	$url7 = ROOT_URL.'/vospace-2.0/nodes/'.$container_name;
	
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_URL, $url7);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	
	$xml_data = '<vos:node xmlns:xsi="http://www.w3.org/2001/thisSchema-instance" xsi:type="vos:ContainerNode" xmlns:vos="http://www.ivoa.net/xml/VOSpace/v2.0" uri="vos://scidrive.org!vospace//'.$container_name.'">
	<vos:properties/>
	<vos:accepts/>
	<vos:provides/>
	<vos:capabilities/>
</vos:node>
';
			
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth-Token:'.$token_user,'Content-Type:application/xml'));
	
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
    
	$response5 = curl_exec($ch);
	echo $response5;
	curl_close($ch); 
 //echo $token_user;
	
	
	$url8 = ROOT_URL.'/vospace-2.0/1/account/service/gluseenprocessor';
	$ch=curl_init(); 

    $post = array(
      "connectionUrl"=>
	 CONNECT_STRING, //"jdbc:sqlserver://sciserver04.pha.jhu.edu:1433;databaseName=EarthSciTest_scitest02;integratedSecurity=false;user=gluseen;password=67sFSMFDjL;",
  "tableName"=>"dbo.Site",
  "containers"=>array("/".$container_name)
  

    );
  
	$data_string = json_encode($post);
	curl_setopt($ch, CURLOPT_URL, $url8);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Auth-Token: ".$token_user,"Content-Type: application/json"));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
    

 
	$result = curl_exec($ch);
	echo $result;
	curl_close($ch); 
	




?>




