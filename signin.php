<html>
<head>
  <link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
</head>
<body></body>
</html> 
<?php
  session_start();
  //If session is already there, then switch to page according to the role of developer.
  if ($_SESSION["uid"] == 1 || $_SESSION["role"] == "Manager" || $_SESSION["role"] == "Developer") {
        header('Location: main_page.php');
  }
  //Login Details
  else {
    echo "<div class ='signinpage'><form action='signin.php' method='post'>";
    echo "Email ID :- <input type='text' name='uname' required='required'><br>";
    echo "Password :- <input type='password' name='pwd' required='required'><br>";
    echo "<input type='submit' name='submit' value='Submit'><br></div>";
  }

  //This block checks the user's login details and matches with the DB.
  if (isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $email = $passwd =  "";
      $found = 0;
      $name = $_POST["uname"];
      $passwd = $_POST["pwd"];
      $passwd = md5($passwd);
      require 'database_connection.php';
     
       $sql = "SELECT user_id,user_name, email_id, password FROM signup";
       $result = $conn->query($sql);

      if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) {
          $uname = $row["user_name"];
          $email = $row["email_id"];
          $pass = $row["password"];
          $user_id = $row["user_id"];
          if (($name == $uname || $name == $email) && $passwd == $pass) {
            $_SESSION["user"] = $uname;
            $_SESSION["uid"] = $user_id;
            $verify_id = $_SESSION["uid"];
            $found = 1;
            break;
          }
      }
  }
   //If result is not found
   if ($found == 0) { 
        echo "<h2 class='invalid'>Invalid emailID or password</h2>";
        }

   //If result is found and getting the role_name from roles table.     
   else {
    $sql = "SELECT role_id, user_id from members WHERE user_id = " . $verify_id;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $role =  $row['role_id'];
    echo $role;

    if (!empty($role)) {
      $sql = "SELECT role_id, role_name from roles WHERE role_id = " . $role;
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $role_name =  $row['role_name'];  
      $_SESSION["role"] = $role_name;
    }   
      header('Location: main_page.php');    
      $conn->close();  
      }
    }
  }     
?>