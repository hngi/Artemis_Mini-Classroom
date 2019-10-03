<?php
session_start();
include('functions/connection.php');
$con = connect();

if( (!isset($_SESSION["userId"])) && ($_SESSION["role"] != 'teacher') ) {
    header('Location:signin.php?role=student');
}

// get teacher classes
$classQuery = 'SELECT * FROM classes WHERE teacher_id = '.$_SESSION["userId"].'';
$classResult = mysqli_query($con, $classQuery);
$classCount = mysqli_affected_rows($con);
if($classCount > 1) {
    $addS = "ES";
} else {
    $addS = " ";
}

// get students enrolled in classes
$totalEnrolments = 0;
if($classCount > 0) {
    while($classRow = mysqli_fetch_assoc($classResult)) {
        $countEnrolmentsQuery = 'SELECT * FROM enrolment WHERE class_id = '.$classRow["class_id"].'';
        $countEnrolmentsResult = mysqli_query($con,$countEnrolmentsQuery);
        $countEnrolments = mysqli_affected_rows($con);
        if($countEnrolments > 0) {
            // students exists
            while($enrolmentsRows = mysqli_fetch_assoc($countEnrolmentsResult)) {
                $totalEnrolments++;
            }
        } else {
            // no student exist
        }
    }
}

if($totalEnrolments > 1) {
    $addS2 = "S";
} else {
    $addS2 = " ";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/teachers-dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/942fa82be2.js"></script>
    <style>
        h4{
            color: #000;
        }
    </style>
</head>

<body>
    
    <?php include('fragments/teachers_header.php'); ?>
    
    <div class="wrapper">
        <div class="db-box">
            <div class="class-header">
                <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569397784/team%20artemis/Layer_x0020_1_e8xcik.svg" class="icons" alt="class">
                <div class="content-header">
                    <h4>YOUR RECENT CLASSES</h4>
                </div>
            </div>
            <div class="content">
                <table>
                    <!--<tr>-->
                    <!--    <td colspan="3">Your Recent Classes</td>-->
                    <!--</tr>-->
                    <?php
                        // get recent classes
                        $recentQuery = 'SELECT * FROM classes WHERE teacher_id = '.$_SESSION["userId"].' ORDER BY class_id DESC LIMIT 4';
                        $recentResult = mysqli_query($con,$recentQuery);
                        $recentCount = mysqli_affected_rows($con);
                        if($recentCount > 0) {
                            // classes exist
                            while ($recentRow = mysqli_fetch_assoc($recentResult)) {
                                // get students per class
                               echo ' 
                                <tr>
                                    <td>
                                        <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569704826/icons8-class-80_1_jozusq.png" class="medium" alt="">
                                    </td>
                                    <td>
                                        <h4 style="padding: 0px 3px">'.$recentRow["class_name"].'</h4>
                                    </td>
                                    <td style="padding-left:3px">
                                        <a href="teacher_add_item.php?class_id='.$recentRow["class_id"].' "> 
                                            <i class="fa fa-edit fa-lg edit"></i>
                                        </a>
                                    </td>
                                </tr>';
                                
                            }
                        } else {
                            // classes do not exist
                        }
                    ?>
                    
                    
                    
                </table>
            </div>

        </div>
        <div class="db-box">
            <div class="students-header">
                <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569397785/team%20artemis/Students_2_i5xq84.svg" class="icons" alt="class">
                <div class="content-header">
                    <h4>YOUR STUDENTS ( <?php echo $totalEnrolments; ?> )</h4>
                </div>
            </div>
            <div class="content">
                <table>
                    <!--<tr>-->
                    <!--    <td colspan="3">Your Recent Classes</td>-->
                    <!--</tr>-->
                    <?php
                        // get recent classes
                        $recentQuery = 'SELECT * FROM classes WHERE teacher_id = '.$_SESSION["userId"].' ORDER BY class_id DESC LIMIT 4';
                        $recentResult = mysqli_query($con,$recentQuery);
                        $recentCount = mysqli_affected_rows($con);
                        if($recentCount > 0) {
                            // classes exist
                            while ($recentRow = mysqli_fetch_assoc($recentResult)) {
                                // get students count
                              $studentsCount = 0;
                              $studentsQuery = 'SELECT * FROM enrolment WHERE class_id = '.$recentRow["class_id"].'';
                              $studentsResult = mysqli_query($con, $studentsQuery);
                              while($studentsRow = mysqli_fetch_assoc($studentsResult)) {
                                $studentsCount++;
                              }
                              
                               echo ' 
                                <tr>
                                    <td>
                                        <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569705144/icons8-students-64_1_e0xmna.png" class="medium" alt="">
                                    </td>
                                    <td>
                                        <h4 style="padding: 0px 3px">'.$recentRow["class_name"].'</h4>
                                    </td>
                                    <td style="padding-left:3px">
                                        <h4>'.$studentsCount.'</h4>
                                    </td>
                                </tr>';
                                
                            }
                        } else {
                            // classes do not exist
                        }
                    ?>
                    
                    
                    
                </table>
            </div>
        </div>

        <!--<div class="db-box ">-->

        <!--    <div class="assignment-header">-->
        <!--        <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569397784/team%20artemis/Layer_x0020_1_e8xcik.svg" class="icons" alt="class">-->
        <!--        <div class="content-header">-->
        <!--            <h4>ASSIGNMENT</h4>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="content">-->
        <!--        <table>-->
        <!--            <tr>-->
        <!--                <td>-->
        <!--                    <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569420810/team%20artemis/Ellipse_2_etowzs.png" class="medium" alt="">-->
        <!--                </td>-->
                        
        <!--                <td>-->
        <!--                    <h5>CLASS NAME</h5>-->
        <!--                    <p>0 assignments </p>-->
        <!--                </td>-->
        <!--                <td style="padding-left:25%">-->
        <!--                    <a href="#"><i class="fa fa-upload fa-lg edit" aria-hidden="true"></i></a>-->
        <!--                </td>-->
        <!--            </tr>-->
        <!--        </table>-->


        <!--    </div>-->

        <!--</div>-->
        <div class="db-box">

            <div class="c-class-header">
                <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569397784/team%20artemis/Layer_x0020_1_s6rnnd.png" class="icons small" alt="class">
                <div class="content-header">
                    <h4> CREATE CLASS</h4>
                </div>
            </div>
            <div class="content">
                <h5>Create Class Form</h5>
                <p>

                    Adding Content to a site has never been this easy and rewarding, click on the button below to create a class!

                </p>

                <div class="create-btn">
                    <button><a href="createclass.php">Create Class</a></button>

                </div>
            </div>
        </div>

        <footer>
            
        </footer>
        <script src="js/header.js"></script>


</body>

</html>