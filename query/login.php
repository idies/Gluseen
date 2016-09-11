<?php

$url = 'http://scitest02.pha.jhu.edu//CasJobs/RestApi/contexts/EarthSciTest/query';
//$url='10.55.17.52';
$token= $_COOKIE['token'];
$date='11/5/2013';
$cdate='3/24/2014';
$habitat='Disturbed';
$site='Baltimore';

//echo $token;
 $ch=curl_init(); 
 curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth-Token:'.$token,'Content-Type:application/json'));
 
 
 
 //$post = array(
    
 //"Query"=> "select h.HabitatType, s.TeabagID, ss.SiteID, s.DeploymentWeight, s.CollectionWeight,s.DeploymentDate,s.CollectionDate,p.PlotID,h.HabitatID,p.Name,ss.Name as SiteName from DecompSample AS s, Plot AS p, Habitat AS h ,Site as ss WHERE s.PlotID = p.PlotID AND p.HabitatID = h.HabitatID AND s.DecompSampleID=ss.SiteID AND s.DeploymentDate ='".$date."' and s.CollectionDate ='".$cdate."' and h.HabitatType='".$habitat."'"
  //);

	
 $post = array(
	//"Query"=>"select * from [EarthSciTest_scitest02].[stateReg].[Load]"
	"Query"=>"select Name from Site"
	);
	
	$data_string = json_encode($post);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
    $response = curl_exec($ch);
	echo $response;
	echo gettype($response);
	//echo str_getcsv($response);



?>