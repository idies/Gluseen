<?php

function addDayswithdate($date,$days){
	$day1=intval($days);
    //$date1 = strtotime($date);
   $date2=date("m/d/Y", strtotime($date . " + {$day1} days"));
    return  $date2;

}

//$date=$_POST['date'];
$habitat=$_POST['habitat'];
$dateRange=$_POST['dateRange'];
//$cdate=addDayswithdate($date,$dateRange);




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
    
// "Query"=> "select h.HabitatType, s.TeabagID, ss.SiteID, s.DeploymentWeight, s.CollectionWeight,s.DeploymentDate,s.CollectionDate,p.PlotID,h.HabitatID,p.Name,ss.Name as SiteName from DecompSample AS s, Plot AS p, Habitat AS h ,Site as ss WHERE s.PlotID = p.PlotID AND p.HabitatID = h.HabitatID AND p.SiteID=ss.SiteID AND s.DeploymentDate ='".$date."' and s.CollectionDate ='".$cdate."' and h.HabitatType='".$habitat."'"
   "Query"=> "select h.HabitatType, s.TeabagID, ss.SiteID, s.DeploymentWeight, s.CollectionWeight,s.DeploymentDate,s.CollectionDate,p.PlotID,h.HabitatID,p.Name,ss.Name as SiteName from DecompSample AS s, Plot AS p, Habitat AS h ,Site as ss WHERE s.PlotID = p.PlotID AND p.HabitatID = h.HabitatID AND p.SiteID=ss.SiteID and h.HabitatType='".$habitat."'"
  );
	$data_string = json_encode($post);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
    $data = curl_exec($ch);
















//$data = file_get_contents(
//"http://dsa002.pha.jhu.edu/EarthScience/EarthScience/getData?Query=select%20h.HabitatType,%20s.TeabagID,%20s.SiteID,%20s.DeploymentWeight,%20s.CollectionWeight,s.DeploymentDate,s.CollectionDate,p.PlotID,h.HabitatID,p.Name,ss.Name%20as%20SiteName%20from%20DecompSample%20AS%20s,%20Plot%20AS%20p,%20Habitat%20AS%20h%20,Site%20as%20ss%20WHERE%20s.PlotID%20=%20p.PlotID%20AND%20p.HabitatID%20=%20h.HabitatID%20AND%20s.SiteID=ss.SiteID%20AND%20s.DeploymentDate%20=%27".$date."%27and%20s.CollectionDate%20=%27".$cdate."%27and%20h.HabitatType=%27".$habitat."%27&format=csv");
//echo $dataintext = implode("\n",$data);
echo $data
?>