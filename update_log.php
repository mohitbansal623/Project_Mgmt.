<?php
	session_start();
	require 'logoutdisplay.php';
	$spent_time = "";
	$uid = $_GET['uid'];
	$task_id= $_GET['tid'];
	$time = $_POST['log'];
	$bar = $_POST['progress'];
	$comments = $_POST['comments'];
	$prev_time = $prev_comm = "";
	require 'database_connection.php';

	//Retrieving the previous spent time and modifying it with the updated one.
	$sql = "SELECT spent_time FROM developer WHERE user_id = " . $uid;
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
	$prev_time = $row['spent_time'];
	}

	$spent_time = $time+$prev_time;

	//update spent time and progress
	$sql = "UPDATE developer SET spent_time =" . $spent_time . ", progress = " . $bar . " WHERE user_id=" . $uid;

	if ($conn->query($sql) === TRUE) {	
		echo "Updated Carefully";
	}
	else {
		echo "Error updating record: " . $conn->error;
	}

	//Inserting the data in table called dev_time_logs.
	$t = time();
	$sql = "INSERT INTO dev_time_logs (time_log, comments, time_in_sec, task_id) values ('$time', '$comments', '$t', '$task_id')";
	$conn->query($sql);
	header('Location: list_of_tasks.php');
?>
