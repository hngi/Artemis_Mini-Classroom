<?php
session_start();
include('functions/connection.php');
$con = connect();

if( (!isset($_SESSION["userId"])) && ($_SESSION["role"] != 'student') ) {
    header('Location:signin.php');
}

if(isset($_GET["classId"])) {
    $classId = $_GET["classId"];
} else {
    header("Location:error.php");
}

if(isset($_GET["enroll"]) && isset($_GET["classId"])) {
    $studentId = $_SESSION["userId"];
    $classId = $_GET["classId"];
    
    
    // $enrolQuery = 'INSERT INTO enrolment (student_id, class_id, date_enrolled) VALUES('.$studentId.', "'.$classId.'", now())';
    $enrolQuery = "INSERT into enrolment (student_id, class_id, date_enrolled) VALUES ('".$studentId."', '".$classId."', now())";
    $enrolResult =  mysqli_query($con, $enrolQuery) or die(mysqli_error($con));
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Access Class</title>
    <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="style/classList.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/942fa82be2.js"></script>
</head>

<body>
    <?php include('fragments/students_header.php'); ?>
    <div id="main">
        <section>
            <div class="dropdown">
                <!--<button onclick="myFunction()" id="dropbutton" class="dropbtn">Classes</button>-->
                <!--<div id="myDropdown" class="dropdown-content">
                    <a href="#">Maths</a>
                    <a href="#">English</a>
                    <a href="#">Commerce</a>
                    <a href="#">smile</a>
                    <a href="#">Jesus</a>
                    <a href="#">Loves you!</a>
                </div>-->
            </div>
            <div option-nav>

                <?php 
                    // get class details
                    $classQuery = 'SELECT * FROM classes WHERE class_id = '.$classId.'';
                    $classResult = mysqli_query($con, $classQuery);
                    $classCount = mysqli_affected_rows($con);
                    if($classCount > 0) {
                        $classRow = mysqli_fetch_assoc($classResult);
                        $className = $classRow["class_name"];
                        $classDesc = $classRow["class_desc"];
                    } else {
                        header('Location:error.php');
                    }
                    
                    $classItemsQuery = 'SELECT * FROM class_items WHERE class_id = '.$classId.' order by class_id';
                    $classItemsResult = mysqli_query($con, $classItemsQuery);
                    $classItemsCount = mysqli_affected_rows($con);
                ?>
                <h4 style="float: left; line-height:1.2em"><?php echo $className; ?> <br><span style="font-size:13px"> <?php echo $classDesc; ?> </span></h4>
                <h4 style="float: right; line-height:1.2em"><?php echo $classItemsCount; ?> Items in Class</h4>
            </div>
            
            <?php
                
                if($classItemsCount > 0) {
                    while($row = mysqli_fetch_assoc($classItemsResult)) {
                        echo '
                        <div class ="access">
                        <div class="wrapper ">
                       
                            
                            <div class="description">
                                <a id="course-link" href="">'.$row["item_title"].'</a>
                                <hr>
                                
                                <p id="descText"> '.$row["item_content"].'
                                </p>
                            </div>
                            </div>
                           
            
                        </div>';
                    }
                } else {
                    echo '<h3>There are no items in this class</h3>';
                }
            ?>
            
        </section>
    </div>
    <script src="js/classList.js"></script>
    <script src="js/header.js"></script>
</body>

</html>