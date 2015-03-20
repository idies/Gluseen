<?php

$date=$_POST['date'];
$site=$_POST['site'];
$data = file_get_contents("http://dsa002.pha.jhu.edu/EarthScience/EarthScience/getData?Query=select%20s.SiteID,%20s.DeploymentWeight,%20s.CollectionWeight,s.DeploymentDate,s.CollectionDate,p.PlotID,h.HabitatID,p.Name%20from%20DecompSample%20AS%20s,%20Plot%20AS%20p,%20Habitat%20AS%20h%20WHERE%20s.PlotID%20=%20p.PlotID%20AND%20p.HabitatID%20=%20h.HabitatID%20&format=csv");
//echo $dataintext = implode("\n",$data);
echo $data
?>