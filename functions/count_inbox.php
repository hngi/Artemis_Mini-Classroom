<?php
session_start();

error_reporting (1);
include('connection.php');

$con = connect();

// get count of inbox

$query = 'SELECT * FROM chat_messages WHERE rec_id = '.$_SESSION["userId"].' AND seen = 0';
$result = mysqli_query($con,$query);
$count = mysqli_affected_rows($con);
if($count > 0) {
    echo '<span class="badge">'.$count.'</span>';
} else {
    $count = 0;
}
            
?>