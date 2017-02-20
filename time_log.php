 <!DOCTYPE html>
 <html>
	 <head>
		 	<link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
		 	<title></title>
	 </head>
	 <body>
	 </body>
 </html>
 <!-- Page for Developer where he can update his timelog, comments and percentage complete -->
 <?php
 session_start();
 require 'logoutdisplay.php';
 $task_id = $_GET['tid'];
 $uid = $_GET['uid'];
 echo "<br><form method='post' action=update_log.php?tid=" . $task_id ."&uid=" . $uid . ">Timelog <input type='text' name='log' required='required'><br>Percentage Complete <input type='text' name='progress' required='required'><br>Comments <textarea name='comments' required='required'></textarea><br><input type='submit'>";
 ?>