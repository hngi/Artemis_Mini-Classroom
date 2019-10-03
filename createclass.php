<?php
session_start();
include('functions/connection.php');
$con = connect();

if( (!isset($_SESSION["userId"])) && ($_SESSION["role"] != 'teacher') ) {
    header('Location:signin.php');
}


    if(isset($_POST["createClass"])) {
        $className = "";
        $classDesc = "";
        
        
        $className = $_POST['className'];
        $classDesc = $_POST['classDesc'];
    	
    	if($className == "" || $classDesc == "") {
    	    $response = '<div class="errorResponse">Please enter valid data.</div>';
    	} else {
    	     $query = "INSERT into classes (class_name, class_desc, teacher_id, date_created, has_pic) VALUES ('".$className."', '".$classDesc."', '".$_SESSION["userId"]."', now(), 0 )";
    	     $result = mysqli_query($con, $query) or die(mysqli_error($con));
    	     $count = mysqli_affected_rows($con);
    	     if($count > 0) {
    	         // created
    	         header("Location: teacher_classes.php");
    	     } else {
    	         // error occurred
    	         $response = '<div class="errorResponse">An error occurred.</div>';
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
    <title>Create a Class</title>
    <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="style/teachers-dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/942fa82be2.js"></script>
    
    <style>
        .errorResponse{
            color: red;
        }
        .successResponse{
            color: green;
        }
    </style>
</head>

<body>
    
    <?php include('fragments/teachers_header.php'); ?>
    
    <div class="form-container">
        <div id="c-class-form">
            <div class="c-class-form-header">
                <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569397784/team%20artemis/Layer_x0020_1_s6rnnd.png" class="icons" alt="class">
                <div class="content-header">
                    <h4> Create Class</h4>
                </div>
            </div>
            <div>
                <!--<h1>Create Class Form</h1>-->

                <form method="post" form>
                    <?php
                        if(isset($response)) {
                            echo $response;
                        }
                    ?>
                    <input class="form-input" id="class-name" name="className" type="text" placeholder="Class name" required />
                    <!--<input class="form-input" id="duration" name="duration" type="text" placeholder="Est. time of completion" required />-->
                    <textarea id="class-description" name="classDesc" placeholder="Short description (less than 100 words)" required></textarea>
                    <!--<textarea id="class-content" placeholder="Class content" required></textarea>-->
                    <input type="submit" name="createClass" value="Create">
                </form>
            </div>
        </div>
    </div>

    <footer>
    </footer>
    <script src="js/header.js"></script>


</body>


</html>