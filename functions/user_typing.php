<?php
    session_start();
    
    error_reporting (1);
    include('connection.php');
    
    $con = connect();
    
    $recId = $_POST['rec_id'];
    
    // get my name
    $query = 'SELECT * FROM users WHERE user_id = '.$_SESSION["userId"].'';
    $res = mysqli_query($con,$query);
    $row = mysqli_fetch_assoc($res);
    $username = $row["firstname"] .' '.$row["lastname"];
    echo $recId;
    // check who has the message
    if($_SESSION["userId"] == $recId) {
        // echo '<p>'.$username.' is typing...</p>';
        
    }
    
            
?>