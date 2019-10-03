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
    <title>My Enrolments</title>
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
                <h4 style="float: left;">My Enrolments</h4>
                <!--<div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn">durartion</button>
                    <div id="myDropdown2" class="dropdown-content">
                        <a href="#">10 Hours</a>
                        <a href="#">20 Hours</a>
                        <a href="#">30 Hours</a>
                    </div>
                </div>-->
                <!--<div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn">Participants</button>
                    <div id="myDropdown3" class="dropdown-content">
                        <a href="#">10 Hours</a>
                        <a href="#">20 Hours</a>
                        <a href="#">30 Hours</a>
                    </div>
                </div>-->
                
                <?php 
                
                    $enrolmentsQuery = 'SELECT * FROM enrolment WHERE student_id = '.$_SESSION["userId"].' order by enrolment_id desc';
                    $enrolmentsResult = mysqli_query($con, $enrolmentsQuery);
                    $enrolmentsCount = mysqli_affected_rows($con);
                ?>
                <h4><?php echo $enrolmentsCount; ?> Enrolments</h4>
            </div>
            
            <?php
                
                if($enrolmentsCount > 0) {
                    while($row = mysqli_fetch_assoc($enrolmentsResult)) {
                        // get class details
                        $classQuery = 'SELECT * FROM classes WHERE class_id = '.$row["class_id"].'';
                        $classResult = mysqli_query($con, $classQuery);
                        $classRow = mysqli_fetch_assoc($classResult);
                        $className = $classRow['class_name'];
                        $classDesc = $classRow["class_desc"];
                        $teacherId = $classRow["teacher_id"];
                        
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
                            <div class="videos">
                            ';
                            
                                if($classRow["has_pic"] == 1) {
                                    // class has pic
                                    echo '
                                    <img src = "class_pics/'.$classRow["class_id"].'.jpg" width="230px" height="180px">';
                                } else {
                                    // class has no pic
                                     echo '
                                    <img src = "class_pics/no_image.jpg" width="230px" height="180px">';
                                }
                                
                            echo '
                            </div>
                            <div class="description">
                            <a href="student_access_class.php?classId='.$row["class_id"].'">'.$className.'</a>
                                <hr>
                                
                                <p id="date_created">Date Enrolled : '.$row["date_enrolled"].'</p>
                                
                                <p id="descText"> '.$classDesc.'
                                </p>
                            </div>
                            <div class="space">
            
                            </div>
                            <div class="enroll_btn">
                                <a href="student_access_class.php?classId='.$row["class_id"].'"><button> >> Access class</button></a>
                                <p id="participants"> '.$itemsCount.' Course Item'.$addS.'</p>
                            </div>
            
                        </div>';
                    }
                }
            ?>
            
        </section>
    </div>
    <div></div>
    <footer>

    </footer>
    <script src="js/classList.js"></script>
    <script src="js/header.js"></script>
</body>

</html>