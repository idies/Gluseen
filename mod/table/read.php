<?php


$site=$_POST['site'];
//$data = file_get_contents("http://dsa002.pha.jhu.edu/EarthScience/EarthScience/getData?Query=select%20*%20from%20DecompSample%20where%20DeploymentDate%20=%27".$date."%27and%20SiteID=%27".$site."%27&format=csv");
//echo $dataintext = implode("\n",$data);





$url = 'http://scitest02.pha.jhu.edu//CasJobs/RestApi/contexts/EarthSciTest/query';
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
	"Query"=>"select s.DecompSampleID, s.PlotID,p.Name as PlotName,s.TeabagID,s.DeploymentDate,s.CollectionDate,s.DeploymentWeight,s.CollectionWeight,ss.Name as SiteName from DecompSample as s,Plot as p, Site as ss where s.PlotID=p.PlotID and p.SiteID=ss.SiteID and ss.Name='".$site."'"
	//"Query"=>"select * from Site"
	//	"Query"=>"select * from DecompSample as s,Plot as p, Site as ss where s.PlotID=p.PlotID and p.SiteID=ss.SiteID and s.DeploymentDate='".$date."' and ss.Name='".$site."'"
	);
	$data_string = json_encode($post);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
    $data = curl_exec($ch);





echo $data
?>