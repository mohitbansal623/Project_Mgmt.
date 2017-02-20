<?php
require 'logoutdisplay.php';
?>
<!-- Page for creating a workspace by the admin -->
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
	<script>
	function getuser() {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    	document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("POST","get_mng&dev.php",true);
    xmlhttp.send();
	}	
	</script>
</head>
<body>
	<div class='admin'>
		<form action="workspace.php" method="post">
			Project Name <input type="text" name="pname" required="required"><br>
			Description: <br><br><textarea rows="5" cols="50" required="required" name="description"></textarea><br>
			<input type="button" onclick="getuser()" value ="Add managers and developers"><br><br>
			<div id ="txtHint"></div>
			<br><br>
			<input type="submit" name="submit" value="save">
			</form>
	</div>		
</body>
</html>