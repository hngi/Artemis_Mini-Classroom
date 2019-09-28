<?php
session_start();
include('functions/connection.php');
$con = connect();

if( (!isset($_SESSION["userId"])) && ($_SESSION["role"] != 'teacher') ) {
    header('Location:signin.php');
}

if(isset($_GET["class_id"])) {
    $classId = $_GET["class_id"];
} else {
    header('Location: error.php');
}

if(isset($_POST["upload"])) {
    
    $filename = $classId .'.jpg';
    move_uploaded_file($_FILES["image"]["tmp_name"], "class_pics/" . $filename);
    // update has_pic
    $updateQuery = 'UPDATE classes SET has_pic = 1 WHERE class_id = '.$classId.'';
    $updateResult = mysqli_query($con, $updateQuery);
    
    header('Location: teacher_classes.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Class Picture</title>
    <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="style/classList.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/942fa82be2.js"></script>
</head>

<body>
    <?php include('fragments/teachers_header.php'); ?>
    
    <div id="main">
        <section>
            <div class="dropdown">
                <a href="createclass.php" style="text-decoration:none;"><button id="dropbutton" class="dropbtn">+ New Class</button></a>
            </div>
            <div option-nav>
                <!--<button>Filter</button>-->
                <!--<div class="dropdown">-->
                <!--    <button onclick="myFunction()" class="dropbtn">durartion</button>-->
                <!--    <div id="myDropdown2" class="dropdown-content">-->
                <!--        <a href="#">10 Hours</a>-->
                <!--        <a href="#">20 Hours</a>-->
                <!--        <a href="#">30 Hours</a>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="dropdown">-->
                <!--    <button onclick="myFunction()" class="dropbtn">Participants</button>-->
                <!--    <div id="myDropdown3" class="dropdown-content">-->
                <!--        <a href="#">10 Hours</a>-->
                <!--        <a href="#">20 Hours</a>-->
                <!--        <a href="#">30 Hours</a>-->
                <!--    </div>-->
                <!--</div>-->
                <h4 style="float: left;">Choose a Class Picture</h4>
            </div>
            
            <div class="wrapper ">
                
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="image" required/>
                    <br>
                    <br>
                    <button type="submit" name="upload">Upload</button>
                </form>
               
                <div class="space">
                </div>
                
            </div>
            
        </section>
    </div>
    <script src="js/classList.js"></script>
    <script src="js/header.js"></script>
</body>

</html>