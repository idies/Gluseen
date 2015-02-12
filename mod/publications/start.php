<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'publications_init');



/**
 * Init d3 plugin.
 */
function publications_init() {


//$css_url = 'mod/d3/vendors/style.css';
//elgg_register_css('special', $css_url);


//elgg_register_simplecache_view('js/my_plugin/my_javascript');
	$url = 'http://d3js.org/d3.v3.min.js';
	elgg_register_js('d3', $url);
	
		$url = 'http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js';
	elgg_register_js('d3.tip', $url);
	
		$url = 'mod/d3data2/jquery-csv.js';
	elgg_register_js('jquery-csv', $url);

//elgg_load_css('special');

	
	elgg_register_page_handler('publications', 'publications_page_handler');




	
}


function publications_page_handler() {





elgg_load_js('d3');
elgg_load_js('d3.tip');
elgg_load_js('jquery-csv');

$params = array(
        'title' => 'Publications',
        'content' => '
	<b>	Presentations:</b><br>
Szlavecz, K., R.V. Pouyat, S. Cilliers, Cs.Csuzdi, M. Dombos, E. Hornung, D.J. Kotze, S. Mishra, H.
Setälä, D.E. Schmidt, S.A. Yarwood, I.D. Yesilonis. A multi-city comparison of urban soil
ecosystem function. 1st Global Soil Biodiversity Conference, Dijon, France, December 2-4, 2014 <br><br>

Pouyat R.V., K. Szlavecz, H. Setälä, I.D. Yesilonis, S. Cilliers, E. Hornung, S. Yarwood, D. J. Kotze.
Tea anyone? Engaging Citizen Scientists in an Open Distributed Experimental Network in Urban
Soil Ecology. 1st Global Soil Biodiversity Conference, Dijon, France, December 2-4, 2014 <br><br>

Tóth Zs, Hornung E., Cilliers S., Dombos M, Kotze D.J., Setälä H., Yarwood S.A., Yesilonis I.D.,
Pouyat R.V. Szlavecz K. Városi talajok lebontó hatásfokának vizsgálata (GLUSEEN, Budapest)
(Decomposition studies in urban soils. GLUSEEN Budapest). Magyar Természetvédelmi Biológiai
Konferencia:Tudományoktól a döntéshozatalig”(Hungarian Nature Protection Conference: From
Science to Decision Making”). Szeged, Hungary, Nov 20-23, 2014. <br><br>

Schmidt DEJ, K Szlavecz, H Setälä, DJ Kotze, RV Pouyat, I Yesilonis, E Hornung, S Cilliers, M
Dombos, Cs Csuzdi, S Yarwood. Life Beneath the City: The Effects of Urbanization on Soil
Microbial Community Composition. Soil Science Society of America International Annual
Meeting, Long Beach, CA, Nov 2-5, 2014.<br><br>

Yesilonis I, Pouyat R, Szlavecz K, Adams MB, Cilliers S, Hornung E, Jurgensen M, Kotze J, PageDumroese
D, Setälä H, Yarwood S. Merging urban soil research networks to develop a more
comprehensive understanding of decomposition rates across different scales. Soil Science
Society of America International Annual Meeting, Long Beach, CA, Nov 2-5, 2014 INVITED.<br><br>

Szlavecz K, Pouyat RV, Yesilonis ID, Setala H, Kotze J, Cilliers S, Hornung E, Yarwood S. Citizen
science experiments to study urban soils. 99th Ecological Society Annual Meeting, Sacramento,
CA, August 10-15, 2014. <a href="http://eco.confex.com/eco/2014/webprogram/Paper49880.html">http://eco.confex.com/eco/2014/webprogram/Paper49880.html.</a><br><br>

Schmidt, DE, K Szlavecz, J Kotze, ID Yesilonis, RV Pouyat, H Setälä, S Cilliers, E Hornung, M
Dombos, Cs Csuzdi, SA Yarwood. Assay for Education: Exploring Urban Soils Function and
Microbial Composition. Mid-Atlantic Chapter of the Ecological Society of America Annual
Meeting, College Park, MD, March 28-30, 2014.<br><br>

Szlavecz K, R. Pouyat, I. Yesilonis, H. Setälä, J. Kotze, S. Yarwood, E. Hornung, S. Cilliers, M.
Dombos, Cs. Csuzdi: Biotic and Abiotic Drivers of Decomposition Rates in Urban Soils: A Proof of
Concept for a Global Experimental Network. SSSA Special Conference: “Soil’s Role in Restoring
Ecosystem Services”, Sacramento CA, March 6-9, 2014.<br>
	',
        'filter' => '',
    );
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




