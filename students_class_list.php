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
        function searchClass() {
                
                var loading = document.getElementById('loading');
                var mainContent = document.getElementById('mainContent');
                loading.style.display = 'inline';
                
                var searchTerm = $('#searchTerm').val();
                
                $.post('functions/search_class.php', {
                    searchTerm: searchTerm
                },
                function(data){
                    loading.style.display = 'none';
                    mainContent.style.display = 'none';
                    $('#result').html(data);
                });            
        }
    </script>
    
</head>

<body>
    <?php include('fragments/students_header.php'); ?>
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
                        <input type="text" placeholder="what do you want to learn?" style="padding: 8px;" id="searchTerm" name="searchTerm" onkeyup="searchClass()" />
                        
                        <span id="loading" style="display:none;">
                            <img src="images/loading.gif" width="30px" height="30px"/> searching . . .
                        </span>
                        
                    </form>
                </h4>
                
                <h4></h4>
            </div>
            
            <div id="result"></div>
            
        <div id="mainContent">
            <?php
                $classesQuery = 'SELECT * FROM classes order by class_id desc';
                $classesResult = mysqli_query($con, $classesQuery);
                $classesCount = mysqli_affected_rows($con);
                if($classesCount > 0) {
                    while($row = mysqli_fetch_assoc($classesResult)) {
                        // get teachers details
                        $teacherQuery = 'SELECT * FROM users WHERE user_id = '.$row["teacher_id"].'';
                        $teacherResult = mysqli_query($con, $teacherQuery);
                        $teacherRow = mysqli_fetch_assoc($teacherResult);
                        $teacherName = $teacherRow["firstname"] .' '.$teacherRow["lastname"];
                        
                        // count class items
                        $itemsQuery = 'SELECT * FROM class_items WHERE class_id = '.$row["class_id"].'';
                        $itemsResult = mysqli_query($con, $itemsQuery);
                        $itemsCount = mysqli_affected_rows($con);
                        if($itemsCount > 1) { 
                            $addS = "s";
                        } else {
                            $addS = "";
                        }
                        
                        echo '
                        <div class="wrapper ">
                            <div class="videos">';
                            
                            if($row["has_pic"] == 1) {
                                // class has pic
                                echo '
                                <img src = "class_pics/'.$row["class_id"].'.jpg" width="230px" height="180px">';
                            } else {
                                // class has no pic
                                 echo '
                                <img src = "class_pics/no_image.jpg" width="230px" height="180px">';
                            }
                                
                            echo '
                            </div>
                            <div class="description">
                                <a id="course-link" href="">'.$row["class_name"].'</a>
                                <hr>
                                <p id="course_stats">Name of Teacher:  '.$teacherName.'</p>
                                <p id="date_created">Date Created : '.$row["date_created"].'</p>
                                
                                <p id="descText"> '.$row["class_desc"].'
                                </p>
                            </div>
                            <div class="space">
            
                            </div>
                            <div class="enroll_btn">
                                <a href="students_class_list.php?enroll=yes&classId='.$row["class_id"].'"><button>ENROLL</button></a>
                                <p id="participants"> '.$itemsCount.' Course Item'.$addS.'</p>
                            </div>
            
                        </div>';
                    }
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