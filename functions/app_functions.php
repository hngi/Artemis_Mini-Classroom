<?php
   session_start();
   error_reporting (1);
   include('connection.php');

   $con = connect();

   function logout() {
      session_unset();
      session_destroy();
      $_SESSION = array();
      header("Location: signin.php");
   }

   function create_class() {
      echo '<h1>Here Now</h1>';
      exit();
      $className = $_POST["className"];
      $classDesc = $_POST["classDesc"];
      $teacherId = $_SESSION["userId"];

      $insertQuery = "INSERT INTO  classes ( class_name, class_desc, teacher_id, date_created ) VALUES ('".$className."', '".$classDesc."', '".$teacherId."',  now() )";

      $result = mysqli_query($con, $insertQuery);


   }
    
?>