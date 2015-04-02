<?php
	elgg_register_event_handler('init', 'system', 'mapping_init');
	$results = file_get_contents('http://yutingsite.com/kml/CSVtoKML.php');
 	//getCSV_KML();
function mapping_init() {
	elgg_register_page_handler('mapping', 'mapping_page_handler');
	//add menu item
    $item = new ElggMenuItem('mapping', elgg_echo('Mapping'), 'mapping');
	elgg_register_menu_item('site', $item); 	
}
function mapping_page_handler() {
	
$content = elgg_view('mapping/map', array());
$sidebar = elgg_view('mapping/hello', array());//right side bar
$sidebar_alt = elgg_view('mapping/sidebar', array());//left side bar

	$params = array(
        //'title' => 'Hello world!',
        'content' => $content,		
		'sidebar'=> $sidebar,
		//'sidebar_alt'=> $sidebar_alt,
		
        'filter' => '',
    );	
    $body = elgg_view_layout('one_sidebar', $params);//use two_sidebar option to show left bar
    echo elgg_view_page('mapping', $body); 
	return true;
	}
	
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
$url =  elgg_get_site_url	(	 	$site_guid = 0	);	

//echo "<script type='text/javascript'>alert('$url');</script>";	

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
		$filename = "baltimoresite.kml"; 
		$dom->save($filename); 

}
}
?>
