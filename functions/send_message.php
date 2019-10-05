<?php
    session_start();

    error_reporting (1);
    include('connection.php');

    $con = connect();

    $message = $_POST['message'];
    $rec_id = $_POST['rec_id'];

    if(strlen($message) > 0) {
        $sendQuery = "INSERT INTO chat_messages (sen_id, rec_id, message, date_time, seen) VALUES('".$_SESSION["userId"]."', '".$rec_id."', '".$message."', now(), 0)";
        $sendResult = mysqli_query($con, $sendQuery) or die(mysqli_error($con));
    }

    
?>