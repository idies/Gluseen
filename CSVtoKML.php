

<?php

function getCSV_KML() {

$data= file_get_contents('http://dsa002.pha.jhu.edu/EarthScience/EarthScience/getData?Query=select*%20from%20plot&format=csv');
$rows = explode("\n",$data); //函数把字符串分割为数组。
//echo var_dump($rows);
$s = array(); //array() 创建数组，带有键和值。
foreach($rows as $row) {
	if($row!=null) {
    				$s[] = str_getcsv($row);
    			}
}
unset($s[0]); 
//print_r($s);
// printf("<br>"); 
// printf("<br>"); 
// echo print_r($s[1]);


$dom = new DOMDocument('1.0', 'UTF-8');  
$dom->formatOutput = true; 
$kml = $dom->createElementNS('http://earth.google.com/kml/2.1', 'kml');
$dom->appendChild($kml);
//$kml = $dom->createElement("kml");
$document = $dom->createElement("Document");
$dname = $dom->createElement("name","KmlFile");  
$document->appendChild($dname);

foreach ($s as $inner) {  //遍历数组


		$placemark = $dom->createElement("Placemark");
		
		if($inner[0] == 2) {
			$name = $dom->createElement("name","601 Woodbourne &amp; Ready Ave"); 
		}
		else{
			$name = $dom->createElement("name",$inner[2]); 
		}
		$style = $dom->createElement("styleUrl", "#style"); 
		$placemark->appendChild($name); 

		$point =$dom->createElement("Point"); 
		$coordinates="$inner[4]".","."$inner[3]";
		$coordinates =$dom->createElement("coordinates", $coordinates); 
		$point->appendChild($coordinates);
	
		$placemark->appendChild($style); 
	    $placemark->appendChild($point);
		$document->appendChild($placemark);

		$kml->appendChild($document);
		$dom->appendChild($kml);

		 //cho $dom->saveXML() ;
		$filename = "test.kml"; 
		$dom->save($filename); 
	
}
}
getCSV_KML();


?>