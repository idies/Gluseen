<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'sites_init');



/**
 * Init d3 plugin.
 */
function sites_init() {



	
	elgg_register_page_handler('sites', 'sites_page_handler');




	
}


function sites_page_handler() {








$params = array(
        'title' => 'Research Sites',
        'content' => '
		
		
		
		
		<!--
		<h2>Motivation</h2>
		
		<ul>
		<li>
		Urban soils are still neglected in urban ecosystem studies</li>
<li>Opportunity to reconnect people with nature</li>
<li>Soil is everywhere and forms a continuum of human effects</li>
		</ul>
		<br>
		<h2>Objectives</h2>
		
		
		<ul>
		<li>To develop experimental protocols that are simple to adopt across many habitat types and soil conditions in urban areas across the world. 
</li>
<li>Two-tier approach: scientists, citizen scientists
</li>

		</ul>
		<br>
		<h2>Main Questions</h2>
		<ol>
		<li>1.Does urbanization create novel soil ecosystems?
</li>
<li>2.Are assembly rules of urban soil communities different?
</li>
<li>3.How do abiotic drivers differ in urban soil ecosystems?
</li>
<li>4.What is the relative importance of <u>native</u> (climate, parent material)vs. <u>anthropogenic</u> (management, disturbance) soil forming factors? 
</li>
<li>5.Do soil ecosystem attributes “converge” on a global and on regional scales? </li>
 </ol>
	<br>
	<h2>Observations and Measurements</h2>
	<br>
	<b>Habitat selection protocol</b><br>
&nbsp;&nbsp;&nbsp;Level of maintenance (M) (High-Medium-Low)<br>
&nbsp;&nbsp;&nbsp;Level of disturbance (D) (High-Low)<br>
&nbsp;&nbsp;&nbsp;Vegetation cover<br>
&nbsp;&nbsp;&nbsp;Additional considerations: soil type, patch size, location, access<br>
<b>Four habitat types</b><br>
&nbsp;&nbsp;&nbsp;HD/LM : Ruderal (Massive)<br>
&nbsp;&nbsp;&nbsp;HD/MM : Public green spaces; turf<br>
&nbsp;&nbsp;&nbsp;LD/LM : Remnant <br>
&nbsp;&nbsp;&nbsp;Reference : representing the biome <br>
<b>Soil sampling</b><br>
<b>Soil analysis: pH, organic matter</b><br>
&nbsp;&nbsp;&nbsp;In-house analysis<br>
<b>Soil microbial community</b><br>
&nbsp;&nbsp;&nbsp;Central lab: University of Maryland <br>
<b>Earthworm sampling</b> <br>
&nbsp;&nbsp;&nbsp;Adapted from EU protocol<br>
<b>Decomposition: using universally available pyramid teabags in place of litterbags</b><br>-->
<img src="mod/sites/Sites.PNG" style="width: 100%;">

	',
        'filter' => '',
    );
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




