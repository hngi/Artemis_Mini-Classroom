<?php

    include('db_params.php');
    function connect() {
        
        $con = mysqli_connect( DB_SERVER, DB_USER, DB_PASS, DB_NAME );
        return $con; 
        
        // Check connection
        // if (mysqli_connect_errno())
        // {
        //     echo "Failed to connect: " . mysqli_connect_error();
        // } else {
           
        // }
  
  
        
        
    }
    
?>