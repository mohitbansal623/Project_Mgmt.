<?php
  session_start();
  
  // Retrieving values from form.
  if ($_SESSION['role'] == "Manager") {   
    $wid = $_GET["wid"];
    $tname = $_POST["tname"];
    $time = $_POST["time"];
    $descr = $_POST["description"];
    $developer = $_POST["Developer"];

    require 'database_connection.php';

    // Inserting data into table called task_create
    $sql = "INSERT INTO task_create (task_name, estimate_time, description,workspace_id) VALUES('$tname', '$time', 'descr','$wid')";

    if ($conn->query($sql) === TRUE) {
     $tid = $conn->insert_id;
    } 
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Inserting data into developer table.
    $sql = "INSERT INTO developer (task_id, user_id) VALUES ('$tid', '$developer')";
    if ($conn->query($sql) === TRUE) {
      //echo "New record created successfully";
    } 
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "SELECT workspace_id FROM members WHERE workspace_id =" . $wid . " AND user_id = " . $developer . " AND role_id = 3";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      header('Location: main_page.php');  
      }   
    else { 
      //Inserting data into members table which will help user to show all the details which is assigned to him.    
      $sql = "INSERT INTO members (workspace_id, user_id , role_id) VALUES ('$wid', '$developer' , '3')";
      if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
      } 
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      header('Location: main_page.php');
    }
  }      
?>