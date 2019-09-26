<?php

    include('db_params.php');
    function connect() {
        
        $con = mysqli_connect( DB_SERVER, DB_USER, DB_PASS, DB_NAME );
        return $con;
        
    }
    
?>