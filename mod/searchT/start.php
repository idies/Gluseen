<?php
/**
 * d3

 */

elgg_register_event_handler('init', 'system', 'searchT_init');

/**
 * Init d3 plugin.
 */
function searchT_init() {

//$css_url = 'mod/d3/vendors/style.css';
//elgg_register_css('special', $css_url);


//elgg_register_simplecache_view('js/my_plugin/my_javascript');
	$url = 'http://d3js.org/d3.v3.min.js';
	elgg_register_js('d3', $url);
	
		$url = 'http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js';
	elgg_register_js('d3.tip', $url);
	
		$url = 'http://jquery-csv.googlecode.com/git/src/jquery.csv.js';
	elgg_register_js('jquery-csv', $url);

//elgg_load_css('special');

	
	elgg_register_page_handler('searchT', 'searchT_handler');




	
}



function searchT_handler() {
//elgg_load_js('d3');
//elgg_load_js('d3.tip');
elgg_load_js('jquery-csv');



$params = array(
        'title' => 'Table Visualization',
        'content' => '
		<style>
		
		.result {
width:100%;
overflow:auto;
 border-style: solid;
border:1px !important;
}



td {
  padding:5px !important;
}
</style>
	<script type="text/javascript">


		$(document).ready(function() {
    
	 $("#run3").bind("click", function() {
     
      example();
    });
	});
	

	




	function example(){

var site=document.getElementById("site").value;
//alert(site);
		$.post("mod/searchT/read.php",{site:site},function(data){
		//$("#input3").val(data);
		//alert (data);
		
		

	
	  //var input = $("#input3").val();
	 //var input=processData(data);
    var data1 = $.csv.toArrays(data);
	
	
	
	
	
    var html = generateTable(data1);
	   $("#result1").empty();
    $("#result1").html(html);
	
	});
	
	}
		function generateTable(data) {
    var html = "";

    if(typeof(data[0]) === "undefined") {
      return null;
    }

    if(data[0].constructor === String) {
      html += "<tr>\r\n";
      for(var item in data) {
        html += "<td>" + data[item] + "</td>\r\n";
      }
      html += "</tr>\r\n";
    }

    if(data[0].constructor === Array) {
      for(var row in data) {
        html += "<tr>\r\n";
        for(var item in data[row]) {
          html += "<td>" + data[row][item] + "</td>\r\n";
        }
        html += "</tr>\r\n";
      }
    }

    if(data[0].constructor === Object) {
      for(var row in data) {
        html += "<tr>\r\n";
        for(var item in data[row]) {
          html += "<td>" + item + ":" + data[row][item] + "</td>\r\n";
        }
        html += "</tr>\r\n";
      }
    }
    
    return html;
  }
</script>



<b>Table name:</b> 
<form>
<input type="text" name="site" id="site">
</form>
<br>

<input id=run3 type=button value="Run" />
		<div class=result>
      <table id=result1></table>
    </div>
		',
		
		
        'filter' => '',
    );
		
//$params = jj_readcsv('mod/table/data.csv',true);

 
	
	
	$body = elgg_view_layout('content',$params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




