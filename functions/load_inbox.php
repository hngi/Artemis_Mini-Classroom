<?php
session_start();

error_reporting (1);
include('connection.php');

$con = connect();

$inboxQuery = 'SELECT message_id, sen_id, rec_id, message, date_time FROM chat_messages WHERE rec_id = '.$_SESSION["userId"].' GROUP BY sen_id ORDER BY message_id DESC';
$inboxResult = mysqli_query($con, $inboxQuery) or die(mysqli_error($con));
$inboxCount = mysqli_affected_rows($con);
if($inboxCount > 0) {
    while($inboxRow = mysqli_fetch_assoc($inboxResult)) {

        // get sender details
        $senderQuery = 'SELECT * FROM users WHERE user_id = '.$inboxRow["sen_id"].'';
        $senderResult = mysqli_query($con,$senderQuery);
        $senderRow = mysqli_fetch_assoc($senderResult);
        $senderName = $senderRow["firstname"] . ' ' . $senderRow["lastname"];

        // unread messages
        $unreadQuery = 'SELECT * FROM chat_messages WHERE sen_id = '.$inboxRow["sen_id"].' AND rec_id = '.$_SESSION["userId"].' AND seen = 0';
        $unreadResult = mysqli_query($con,$unreadQuery);
        $unreadRow = mysqli_fetch_assoc($unreadResult);
        $unreadCount = mysqli_affected_rows($con);

        if($unreadCount > 0) {
            $unreadCount = ' - <span style="color: red; font-size: 12px;"> '.$unreadCount . ' New Message' .$result = $unreadCount > 1 ? "s" : "" .'</span>';
        } else {
            $unreadCount = "";
        }

        echo '
        <div class="user">
            <a href="chat_history.php?user_id='.$inboxRow["sen_id"].'">
                '.$senderName.'  '.$unreadCount.'
            </a>
        </div>';
    }
} else {
    echo '<h3>You have no message in your inbox</h3>';
}

?>