<?php


elgg_register_event_handler('init', 'system', 'uploadStatus_init');


function uploadStatus_init() {


	$url = 'http://d3js.org/d3.v3.min.js';
	elgg_register_js('d3', $url);
	
		$url = 'http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js';
	elgg_register_js('d3.tip', $url);
	
			$url2 = 'mod/d3/jquery.csv.js';
	elgg_register_js('j-c', $url2);
	


//elgg_load_css('special');

	
	elgg_register_page_handler('uploadStatus', 'uploadStatus_handler');




	
}



function uploadStatus_handler() {
//elgg_load_js('d3');
//elgg_load_js('d3.tip');
elgg_load_js('j-c');



$params = array(
        'title' => 'Upload Status',
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
    example();

	});
	

	




	function example(){


		$.post("mod/uploadStatus/read.php",function(data){
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





		<div class=result>
      <table id=result1></table>
    </div>
		',
		
		
        'filter' => '',
    );
		


 
	
	
	$body = elgg_view_layout('content',$params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




