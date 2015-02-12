<?php

function addDayswithdate($date,$days){
	$day1=intval($days);
    //$date1 = strtotime($date);
   $date2=date("m/d/Y", strtotime($date . " + {$day1} days"));
    return  $date2;

}

$date=$_POST['date'];
$site=$_POST['site'];
$dateRange=$_POST['dateRange'];
$cdate=addDayswithdate($date,$dateRange);
$data = file_get_contents(
"http://dsa002.pha.jhu.edu/EarthScience/EarthScience/getData?Query=select%20s.TeabagID,%20s.SiteID,%20s.DeploymentWeight,%20s.CollectionWeight,s.DeploymentDate,s.CollectionDate,p.PlotID,h.HabitatID,p.Name,ss.Name%20as%20SiteName%20from%20DecompSample%20AS%20s,%20Plot%20AS%20p,%20Habitat%20AS%20h%20,Site%20as%20ss%20WHERE%20s.PlotID%20=%20p.PlotID%20AND%20p.HabitatID%20=%20h.HabitatID%20AND%20s.SiteID=ss.SiteID%20AND%20s.DeploymentDate%20=%27".$date."%27and%20s.CollectionDate%20=%27".$cdate."%27and%20ss.Name=%27".$site."%27&format=csv");
//echo $dataintext = implode("\n",$data);
echo $data
?>