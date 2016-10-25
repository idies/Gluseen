<?php
/**
 * d3

 */

elgg_register_event_handler('init', 'system', 'upload2sci_init');

/**
 * Init d3 plugin.
 */
function upload2sci_init() {

		$url2 = 'mod/d3/jquery.csv.js';
	elgg_register_js('j-c', $url2);


elgg_register_entity_type('object', 'upload');



	
	elgg_register_page_handler('upload2sci', 'upload2sci_handler');

	$item = new ElggMenuItem('upload2sci', 'Upload Data', 'upload2sci');
elgg_register_menu_item('site', $item);


	
}



function upload2sci_handler() {

elgg_load_js('j-c');
//$name=elgg_get_logged_in_user_entity()->name;


$params = array(
        'title' => 'Upload Data to GLUSEEN Database:',
        'content' => '


<p>Use the following template to upload your data to the integrated decomposition database.  The template can be found here:<br> <a href="mod/upload/DecompSampleTemplate.csv" target="_blank">DecompSampleTemplate.csv</a>  </p>


<form action="" id="form" method="post" enctype="multipart/form-data">

    <h2>Select a file to upload</h2><br>
    <input type="file" name="file" id="file">
	<br><br>
    <input type="button"  id="bt" value="Upload File" name="upload">
</form>
<br>
<p>Once you have uploaded your file, you can check the status of your upload by clicking <a href="http://scitest09.pha.jhu.edu/elgg/uploadStatus">Upload Status</a>.</p>
	<div class="view">
	
	
	</div>
	

<h2>List Plot IDs by Site</h2>
<form>
Site:
<select id="siteID">

</select>

 <input type="button"  id="splot" value="Show Plot ID and Name" name="plot">
</form>


		<div class="result">
      <table id=result1></table>
    </div>
<script type="text/javascript">
		

$("#bt").click(function(){
	
			$.ajax({
  type: "POST",
  url: "mod/upload/enable.php",
  data: { name: "John" }
}).done(function( msg ) {
  //alert( "Message: " + msg );
}); 

	
	var fileInput = document.getElementById("file");
var file = fileInput.files[0];
     // var file_data = $("#file")[0].files[0];   
    var form_data = new FormData();                  
    form_data.append("file", file);
	//alert(file);
     $.ajax({
		 processData: false,
		 contentType: false,
        type: "POST",
        url: "mod/upload/upload2.php",
        data: form_data,
         success: function (data) {
          // alert(data);
		  $(".view").html(data);
         },
      });
  });  

$("#splot").click(function(){
	
	
	example();
	
	  });
function example(){

var site=document.getElementById("siteID").value;

		$.post("mod/upload/read.php",{site:site},function(data){
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
	  
	$(document).ready(function () {
     $.ajax({
		 processData: false,
		 contentType: false,
        type: "GET",
        url: "mod/d3/query.php",
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
     $("#siteID")
          .append($("<option>", { value : key })
          .text(value)
		  .val(value)
		  ); 
});

		},
      });



		

});		 
			 </script>
		',
		
		
        'filter' => '',
    );
		
//$params = jj_readcsv('mod/table/data.csv',true);

 
	
	
	$body = elgg_view_layout('content',$params);

	echo elgg_view_page($params['title'], $body);
	return true;
}



