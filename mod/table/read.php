<?php

$date=$_POST['date'];
$site=$_POST['site'];
$data = file_get_contents("http://dsa002.pha.jhu.edu/EarthScience/EarthScience/getData?Query=select%20*%20from%20DecompSample%20where%20DeploymentDate%20=%27".$date."%27and%20SiteID=%27".$site."%27&format=csv");
//echo $dataintext = implode("\n",$data);
echo $data
?>