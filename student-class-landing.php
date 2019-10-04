<?php
session_start();
include('functions/connection.php');
$con = connect();

if ((!isset($_SESSION["userId"])) && ($_SESSION["role"] != 'student')) {
    header('Location:signin.php');
}

if (isset($_GET["classId"])) {
    $classId = $_GET["classId"];
} else {
    header("Location:error.php");
}

//check if student is already enrolled in selected class
    $studentId = $_SESSION["userId"];
    $checkQuery = "SELECT * FROM enrolment WHERE student_id = ".$studentId." AND class_id = ".$classId." ";
    $checkResult = mysqli_query($con, $checkQuery);
    $checkCount = mysqli_affected_rows($con);
    

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Class List</title>
    <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="style/student-class-landing.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.iconify.design/1/1.0.3/iconify.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.js" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI=" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&amp;display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/942fa82be2.js"></script>
    <link href="https://use.fontawesome.com/942fa82be2.css" media="all" rel="stylesheet">
</head>

<body>
    <?php include('fragments/students_header.php'); ?>
    <?php

    // get class details
    $classQuery = 'SELECT * FROM classes WHERE class_id = ' . $classId . '';
    $classResult = mysqli_query($con, $classQuery);
    $classCount = mysqli_affected_rows($con);
    if ($classCount > 0) {
        $classRow = mysqli_fetch_assoc($classResult);
        $className = $classRow["class_name"];
        $classDesc = $classRow["class_desc"];
    } else {
        header('Location:error.php');
    }
// get course details
    $classItemsQuery = 'SELECT * FROM class_items WHERE class_id = ' . $classId . ' order by class_id';
    $classItemsResult = mysqli_query($con, $classItemsQuery);
    $classItemsCount = mysqli_affected_rows($con);



    ?>
    <div class="container-fluid main-content">
        <div class="banner text-center">
            <div class="img">
                <!--<img width="50%" height="50%" src="https://res.cloudinary.com/jimmynewtron/image/upload/v1570121189/artemis/Title_lswjua.png">-->
                <h2 class="center-block" style="color:#fff"><?php echo $className; ?></h2>
            </div>
        </div>

        <div class="container">
            <div class=" row course-title">
                <h3 class="col-md-8">Course Title: <span class="courseTitle"> <?php echo $className; ?></span></h3>
                
                <div class="land-enroll_btn col-md-4"> <?php
                if ($checkCount == 1){
                    echo '
                    <a href="student_access_class.php?classId='.$classId.'"><button>CONTINUE CLASS</button></a>
                    
                ';
                }else{
                    echo ' 
                    <a href="student-class-landing.php?enroll=yes&classId='.$classId.'"><button >ENROLL NOW</button></a>';
                    $enrolQuery = "INSERT into enrolment (student_id, class_id, date_enrolled) VALUES ('".$studentId."', '".$classId."', now())";
                    $enrolResult =  mysqli_query($con, $enrolQuery) or die(mysqli_error($con));
                    $enrolCount = mysqli_affected_rows($con);
                    if($enrolCount > 0) {
                        $response = '<p>Your enrolment was successful. <a href="students_enrolments.php">VIEW YOUR ENROLMENTS</a></p>';
                    }
                }
                ?>
                </div>
               

            </div>


            <div class=" row overview">
                <h4 class="col-sm-12">Overview</h4>
                <div class="col-sm-11 offset-sm-0">
                    <ul>
                        <li><?php echo $classDesc; ?></li>
                    </ul>
                    <ul>
                        <li>
                            <h5>Why take this course</h5>
                        </li>
                        <li>Learning is essential to our existence. Just like food nourishes our bodies, information and continued learning nourishes our minds. Lifelong learning is an indispensable tool for every career and organisation. </li>
                    </ul>

                </div>
            </div>
            <div class="row content">
                <h4 class="col-sm-12">Content</h4>
                <div class="col-sm-11 offset-md-0 text-left">
                    <!-- <h5>Why take this course</h5>
	    			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam volutpat vitae in fringilla mauris massa, quam diam. Nunc venenatis id massa et ac luctus faucibus eleifend. Blandit quam tellus sapien dignissim nisl, non turpis. Accumsan massa eget eget sit. Sit neque, adipiscing eu elit. Nunc ullamcorper velit mauris id nunc facilisi dictum id orci.</p>
	    			<h5>Take Away skills</h5>
	    			<p>Dictum id in nunc at ante leo dignissim pulvinar pulvinar. Morbi augue massa dolor tristique quis est consequat. Ac, dolor ut lacus id convallis aenean mattis diam purus. Sed turpis tempor, arcu, proin tellus lectus. Viverra arcu nec porttitor porttitor nec, neque. Morbi diam id elit proin torto.</p> -->
                    <?php
                    if ($classItemsCount > 0) {
                        while ($row = mysqli_fetch_assoc($classItemsResult)) {
                            echo '<ol id="modules">
                    <li class="row text-capitalize">' . $row["item_title"] . ' <span class="iconify" data-inline="false"></span></li>
                    </ol>';
                        }
                    } else {
                        echo '<ul style=" list-style-type: none;">
                <li><h5 style="color:#000; font-family:Imprima, sans-serif;">This Class was added recently check back for course content</h5></li></ul>';
                    }

                    ?>
                </div>
            </div>
            <div class=" row requirement">
                <h4 class="col-sm-12">Requirements</h4>
               
                <div class="col-sm-11 offset-sm-0">
                    <ol>
                        <li>Basic Knowledge of Computer Operation</li>
                        <li>A laptop or just access to the internet</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
   
    <footer></footer>
    <script src="js/student-class-landing.js"></script>
    <script src="js/header.js"></script>
</body>

</html>