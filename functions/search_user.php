<?php
    session_start();

    error_reporting (1);
    include('connection.php');

    $con = connect();

    $searchTerm = $_POST["searchTerm"];
    
    $display = '';

    $searchQuery = "SELECT * FROM users WHERE firstname LIKE '%".$searchTerm."%' OR lastname LIKE '%".$searchTerm."%' ";
    $searchResult = mysqli_query($con, $searchQuery);
    $count = mysqli_affected_rows($con);
    if($count > 0) {
        // match found
        
        while($row = mysqli_fetch_assoc($searchResult)) {
            echo '
            <div class="user">
                <a href="chat_history.php?user_id='.$row["user_id"].'">
                    '.$row["firstname"].' '.$row["lastname"].' ( '.$row["role"].' ) 
                </a>
            </div>';
        }
    
    } else {
        // no match found
        $display = '<p>No User found</p>';
    }
    
    echo $display;
            
?>