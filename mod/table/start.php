<?php
/**
 * d3

 */

elgg_register_event_handler('init', 'system', 'table_init');

/**
 * Init d3 plugin.
 */
function table_init() {

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

	
	elgg_register_page_handler('table', 'table_handler');




	
}



function table_handler() {
//elgg_load_js('d3');
//elgg_load_js('d3.tip');
elgg_load_js('jquery-csv');

$data = file("mod/table/data.csv");
echo $dataintext = implode("\n",$data);

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
		<script>
		$(document).ready(function() {
    //example();
	 $("#run3").bind("click", function() {
     
      example();
    });
	});
	
	function tester()
{
var datevalue=document.getElementById("time").value;
var siteID=document.getElementById("siteID").value;
//var datevalue="3/24/2014";
		$.post("mod/table/read.php",{date:datevalue,site:siteID},function(data){
		$("#input3").val(data);
		//alert (data);
		});

}
	
	




	function example(){
	var datevalue=document.getElementById("time").value;
var siteID=document.getElementById("siteID").value;

		$.post("mod/table/read.php",{date:datevalue,site:siteID},function(data){
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


<b>Deployment Date:</b> <select id="time">
<option value="11/5/2013">11/5/2013</option>
<option value="11/6/2013">11/6/2013</option>
</select><br>
<b>Site ID:</b> <select id="siteID">
<option value="1">1</option>
<option value="2">2</option>
</select><br>
<br>
<!--
<a href="javascript:tester();"><b>Load File</b></a>
 <textarea id="input3" style="height:150px;"></textarea>-->
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




