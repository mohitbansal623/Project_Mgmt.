<?php
  session_start();
  $wid = $pname = $date = $descr = $manager = $developer = "";
  if ($_SESSION['role'] == "Admin" || $_SESSION['uid'] == 1) {  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $pname = $_POST["pname"];
      $descr = $_POST["description"];
      $manager = $_POST["Manager"];
      $developer = $_POST["Developer"];
      $wid = "";
      $man_size = count($manager);
      $dev_size = count($developer);
      require 'database_connection.php';

      //Inserting workspace info into workspace table.
      $sql = "INSERT INTO workspace (project_name, description) VALUES('$pname' ,'$descr')";

      if ($conn->query($sql) === TRUE) {
         $wid = $conn->insert_id;
      } 
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      //Inserting names of those who are managers for that workspace.
      $sql = "SELECT role_id FROM roles WHERE role_name = 'Manager'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $role = $row['role_id'];
      
      echo $man_size;
      for ($i = 0; $i < $man_size; $i++) {
        echo $manager[$i];
        $sql = "INSERT INTO members (workspace_id, user_id, role_id) VALUES('$wid', '$manager[$i]', '$role')";
        if ($conn->query($sql) === TRUE) {
          echo "manager added";
      }
        else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
      //Inserting names of those who are managers for that workspace.
      $sql = "SELECT role_id FROM roles WHERE role_name = 'Developer'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $role =  $row['role_id'];
       
      for ($i = 0; $i < $dev_size; $i++) {
        //echo $developer[$i];
        $sql = "INSERT INTO members (workspace_id, user_id, role_id) VALUES('$wid', '$developer[$i]', '$role')";
        if ($conn->query($sql) === TRUE) {
          echo "developer added";
        }
        else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }  	
    }
    header('Location: main_page.php'); 
  }
?>