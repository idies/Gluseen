<?php
/**
 * d3

 */

elgg_register_event_handler('init', 'system', 'table_init');

/**
 * Init d3 plugin.
 */
function table_init() {


	
		$url = 'http://jquery-csv.googlecode.com/git/src/jquery.csv.js';
	elgg_register_js('jquery-csv', $url);

//elgg_load_css('special');

	
	elgg_register_page_handler('table', 'table_handler');




	
}



function table_handler() {
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

$(document).ready(function () {
     $.ajax({
		 processData: false,
		 contentType: false,
        type: "GET",
        url: "/mod/table/query.php",
        data: "",
         success: function (data) {
		 var tmp = data.split("\n");

        var selectValues={};

for (i=1;i<tmp.length;i++){
if (tmp[i]!="")
{
var str=tmp[i];
var ss=str.substring(1,str.length-1);
selectValues[i]=ss;
}

}
//alert(selectValues);

$.each(selectValues, function(key, value) {   
     $("#site")
          .append($("<option>", { value : key })
          .text(value)
		  .val(value)
		  ); 
});

		},
      });



		//selectValues = { "1": "test 1", "2": "test 2" };

});

		$(document).ready(function() {
    //example();
	 $("#run3").bind("click", function() {
     
      example();
    });
	});
	

	




	function example(){

var site=document.getElementById("site").value;
//alert(site);
		$.post("mod/table/read.php",{site:site},function(data){
		//$("#input3").val(data);
		alert (data);
		
		

	
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



<b>Site:</b> 
<form>
<select id="site">

</select>
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




