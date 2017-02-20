<?php
// define variables and set to empty values
  $uid = $name = $email = $passwd = $select = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Retrieving values from the form.
      $name = $_POST["uname"];
      $passwd = $_POST["pwd"];
      $passwd = md5($passwd);
      $email = $_POST["email"];
    //Establishing DB connection.
    require 'database_connection.php';

    //Inserting data into signup table.
    $sql = "INSERT INTO signup (user_name, email_id, password) VALUES ('$name', '$email','$passwd')";
    if ($conn->query($sql) === TRUE) {
      header('Location: signin.php');
    } 
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();	
}