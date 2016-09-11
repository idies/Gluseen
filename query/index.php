<!DOCTYPE html>
<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script type="text/javascript">
		
		$(document).ready(function () {

		selectValues = { "1": "test 1", "2": "test 2" };
$.each(selectValues, function(key, value) {   
     $('#siteID')
          .append($('<option>', { value : key })
          .text(value)); 
});
});
		
		</script>
</head>

<body>

<form action="login.php" method="post" enctype="multipart/form-data">
   Name:<br>
<input type="text" name="name">
<br>
Password:<br>
<input type="text" name="password">
 <input type="submit" value="login" name="login">
</form>

<form>


<select id="siteID">
<option value="Baltimore"></option> 


</select>
</form>

</body>
</html>