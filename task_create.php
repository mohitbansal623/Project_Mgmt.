<?php
	session_start();
	require 'logoutdisplay.php';
	$wid = $_GET['wid'];
	//echo $wid;
?>

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
     xmlhttp.open("POST","get_dev.php?wid=<?php echo $wid;?>",true);
     xmlhttp.send();
	}	
	</script>
</head>
<!-- Page for Creation of a task -->
<body>
	<div class='create_task'> 
		<form action="taskspace.php?wid=<?php echo $wid;?>" method="post">
			Task Name <input type="text" name="tname" required="required"><br>
			Estimated Time: <input type="text" name="time" required="required"><br>
			Description: <br><textarea rows="5" cols="50" required="required" name="description"></textarea><br>
			<!-- <a href ="getuser.php">Add Managers and Developers</a><br> -->
			<input type="button" onclick="getuser()" value ="Add developers"><br><br>
			<div id ="txtHint"></div>
			<br><br>
			<input type="submit" name="submit" value="save">
		</form>	
	</div>	
</body>
</html>