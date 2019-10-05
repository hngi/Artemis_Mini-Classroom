<?php
session_start();

error_reporting (1);
include('connection.php');

$con = connect();

$userId =  $_GET['id'];

// get name of receiver
$recQuery = 'SELECT * FROM users WHERE user_id = '.$userId.'';
$recResult = mysqli_query($con,$recQuery) or die(mysqli_error($con));
$recRow = mysqli_fetch_assoc($recResult);
$recName = $recRow['firstname'] . ' ' . $recRow['lastname'];

// get chat history
$chatHistoryQuery = 'SELECT * FROM chat_messages WHERE sen_id='.$_SESSION["userId"].' AND rec_id = '.$userId.' OR sen_id = '.$userId.' AND rec_id = '.$_SESSION["userId"].'';
$chatHistoryResult = mysqli_query($con,$chatHistoryQuery) or die(mysqli_query($con));
$chatHistoryCount = mysqli_affected_rows($con);
if($chatHistoryCount > 0) {
    echo '<div class="row">This is the very beginning of your direct message history with '.$recName.'.</div>';
    while($row = mysqli_fetch_assoc($chatHistoryResult)) {
        // get sender's name
        $senderId = $row['sen_id'];
        $senderQuery = 'SELECT * FROM users WHERE user_id = '.$senderId.'';
        $senderResult = mysqli_query($con, $senderQuery);
        $senderRow = mysqli_fetch_assoc($senderResult);

        // format date and time
        $date = date_create($row['date_time']);
        $fdate = date_format($date,"D jS, M Y. g:i:s A");

        // get sender and receiver
        if($_SESSION["userId"] == $row["sen_id"]) {
            $style = "me";
        } else {
            $style = "you";
        }

        // mark messages as read
        $readMessagesQuery = 'UPDATE chat_messages SET seen = 1 WHERE rec_id = '.$_SESSION["userId"].' AND sen_id = '.$userId.'';
        $readMessagesResult = mysqli_query($con,$readMessagesQuery) or die(mysqli_error($con));

        echo '
        <div class="row">
            <div class="col-md-6 '.$style.'">
                <p><small><b>'.$senderRow["firstname"].' '.$senderRow["lastname"].' - '.$fdate.'</b></small></p>
                '.$row["message"].'
            </div>
        </div>';
    }
} else {
    echo '<div class="row">This is the very beginning of your direct message history with '.$recName.'.</div>';
}

              
?>