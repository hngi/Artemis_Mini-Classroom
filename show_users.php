<?php
session_start();
include('functions/connection.php');
$con = connect();

if( (!isset($_SESSION["userId"])) && ($_SESSION["role"] != 'student') ) {
    header('Location:signin.php');
}

if(isset($_GET["enroll"]) && isset($_GET["classId"])) {
    $studentId = $_SESSION["userId"];
    $classId = $_GET["classId"];
    
    // check if student is already enrolled in selected class
    $checkQuery = "SELECT * FROM enrolment WHERE student_id = ".$studentId." AND class_id = ".$classId." ";
    $checkResult = mysqli_query($con, $checkQuery);
    $checkCount = mysqli_affected_rows($con);
    if($checkCount > 0) {
        // student is alreay enrolled
        $response = '<p>You are already enrolled in the class you selected.</p>';
    } else {
        // student is not enrolled
        // enroll student
        $enrolQuery = "INSERT into enrolment (student_id, class_id, date_enrolled) VALUES ('".$studentId."', '".$classId."', now())";
        $enrolResult =  mysqli_query($con, $enrolQuery) or die(mysqli_error($con));
        $enrolCount = mysqli_affected_rows($con);
        if($enrolCount > 0) {
            $response = '<p>Your enrolment was successful. <a href="students_enrolments.php">VIEW YOUR ENROLMENTS</a></p>';
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Class List</title>
    <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="style/classList.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/942fa82be2.js"></script>
     <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
     
    <script>
        function searchUser() {
                
                // var loading = document.getElementById('loading');
                var mainContent = document.getElementById('mainContent');
                // loading.style.display = 'inline';
                
                var searchTerm = $('#searchTerm').val();
                
                $.post('functions/search_user.php', {
                    searchTerm: searchTerm
                },
                function(data){
                    // loading.style.display = 'none';
                    mainContent.style.display = 'none';
                    $('#searchResult').html(data);
                });            
        }
    </script>

    <style>
        .user{
            margin: 10px;
            padding: 5px;
        }

        .user a{
            text-decoration: none;
            padding: 10px;
        }

        .user a:hover{
            background: #ccc;
        }
    </style>
    
</head>

<body>
    <?php
        if($_SESSION["role"] == "student") {
            include('fragments/students_header.php'); 
        } else if($_SESSION["role"] == "teacher") {
            include('fragments/teachers_header.php'); 
        }
       
    ?>

    <div id="main">
        <section>
            <?php
                if(isset($response)) {
                    echo $response;
                }
            ?>
            
            <div option-nav>
                <h4 style="float:left;">
                    <form method="post">
                        <input type="text" placeholder="who do you want to message?" style="padding: 8px; width: 150%;" id="searchTerm" name="searchTerm" onkeyup="searchUser()" />
                        
                        <!-- <span id="loading" style="display:none;">
                            <img src="images/loading.gif" width="30px" height="30px"/> searching, Please wait . . .
                        </span> -->
                        
                    </form>
                </h4>
                
                <h4></h4>
            </div>
            
        <div id="searchResult"></div>
            
        <div id="mainContent">
            <?php
                $usersQuery = 'SELECT * FROM users WHERE user_id <> '.$_SESSION["userId"].'';
                $usersResult = mysqli_query($con, $usersQuery) or die(mysqli_error($con));
                $usersCount = mysqli_affected_rows($con);
                if($usersCount > 0) {
                    while($usersRow = mysqli_fetch_assoc($usersResult)) {
                        echo '
                        <div class="user">
                            <a href="chat_history.php?user_id='.$usersRow["user_id"].'">
                                '.$usersRow["firstname"].' '.$usersRow["lastname"].' ( '.$usersRow["role"].' ) 
                            </a>
                        </div>';
                    }
                } else {
                    echo '<h3>There are no users to message</h3>';
                }
            ?>
        </div>
            
        </section>
    </div>
    <div class ="vertical-space">

    </div>
    <footer>

    </footer>
    <script src="js/classList.js"></script>
    <script src="js/header.js"></script>
</body>

</html>