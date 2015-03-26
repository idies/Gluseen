<?php
/**
 * d3

 */

elgg_register_event_handler('init', 'system', 'upload2sci_init');

/**
 * Init d3 plugin.
 */
function upload2sci_init() {



	
	elgg_register_page_handler('upload2sci', 'upload2sci_handler');




	
}



function upload2sci_handler() {


//$name=elgg_get_logged_in_user_entity()->name;


$params = array(
        'title' => 'Upload Files to Scidrive',
        'content' => '
		<!--
<form action="/mod/upload/upload2.php" method="post" enctype="multipart/form-data">
-->



<form action="" id="form" method="post" enctype="multipart/form-data">

    <h2>Select a file to upload:</h2><br>
    <input type="file" name="file" id="file">
	<br><br>
    <input type="button"  id="bt" value="Upload File" name="upload">
</form>

	<div class="view">
	
	
	</div>
<script type="text/javascript">
		

$("#bt").click(function(){
	
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
        url: "/mod/upload/upload2.php",
        data: form_data,
         success: function (data) {
          // alert(data);
		  $(".view").html(data);
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




