<?php
 session_start();

 error_reporting (1);
 include('functions/connection.php');

 $con = connect();

    // get chat history
    $chatHistoryQuery = 'SELECT * FROM chat_messages WHERE sen_id='.$_SESSION["userId"].'';
    $chatHistoryResult = mysqli_query($con,$chatHistoryQuery) or die(mysqli_query($con));
    $chatHistoryCount = mysqli_affected_rows($con);
    if($chatHistoryCount > 0) {
        while($row = mysqli_fetch_assoc($chatHistoryResult)) {
            echo '
            <div class="row">
                <div class="col-md-6 me">'.$row["message"].'</div>
            </div>';
        }
    } else {
        echo '<h3>You have not sent any message to this user yet</h3>';
    }

?>