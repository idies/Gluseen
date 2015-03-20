<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'citizenscience_init');



/**
 * Init d3 plugin.
 */
function citizenscience_init() {




	
	elgg_register_page_handler('citizenscience', 'citizenscience_page_handler');




	
}


function citizenscience_page_handler() {





$params = array(
        'title' => 'Global Litter Decomposition Study',
        'content' => '
	<p>Tea bag index (TBI): describes decomposition rate (k) and litter stabilization factor (S)<br>
Main purposes:<br>
1.Increase the density & resolution of decomposition measurements<br>
2.Facilitate comparison of decomposition rates between biomes, ecosystems and soil types - leading to new insights in global climate effects on decomposition<br></p>
<img src="http://10.55.17.52/mod/citizenscience/cs.JPG">
<br>

<p>
<b>TBI protocol</b><br>
•	&nbsp;&nbsp;&nbsp;&nbsp;Use Lipton green tea (EAN: 87 22700 05552 5) and Lipton rooibos tea (EAN: 87 22700 18843 8)<br>
•	&nbsp;&nbsp;&nbsp;&nbsp;Cook the tea according the instruction on the box and dry them at 70°C for 48 hours<br>
•	&nbsp;&nbsp;&nbsp;&nbsp;Mark the tea bags on the white side of the label<br>
•	&nbsp;&nbsp;&nbsp;&nbsp;Measure the initial weight and subtract the weight of an empty bag (2.019 g ±0.026)<br>
•	&nbsp;&nbsp;&nbsp;&nbsp;Select the 3 study sites; paying attention on the selection criteria<br>
•	&nbsp;&nbsp;&nbsp;&nbsp;Bury the tea bags (n=5 for 2 samplings campaigns) in 8-cm deep, separate holes while keeping the labels visible above the soil.<br>
•	&nbsp;&nbsp;&nbsp;&nbsp;Mark the site, note the experimental conditions (e.g. slope, aspect, vegetation etc.)<br>
•	&nbsp;&nbsp;&nbsp;&nbsp;Recover first set (5 replicates of each tea) after 1 year and 2 years , respectively<br>
•	&nbsp;&nbsp;&nbsp;&nbsp;Remove adhered soil particles and dry them at 70°C for 38 hours<br>
•	&nbsp;&nbsp;&nbsp;&nbsp;Weigh the bags and subtract the weight of an empty bag without the label to determine the weight after incubation<br>
•	&nbsp;&nbsp;&nbsp;&nbsp;Calculate the stabilization factor S and decomposition rate K according to Keuskamp et al., 2013<br></p>


	',
        'filter' => '',
    );
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




