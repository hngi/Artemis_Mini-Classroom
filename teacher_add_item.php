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
    header('Location:error.php');
}


    if(isset($_POST["addItem"])) {
        $itemTitle = "";
        $itemContent = "";

            $itemTitle = $_POST['itemTitle'];

            $itemContent = $_POST['itemContent'];
    	
    	if($itemTitle == "" || $itemContent == "") {
    	    $response = '<div class="errorResponse">Please enter valid data.</div>';
    	} else {
    	     $query = "INSERT into class_items (class_id, item_title, item_content, date_created) VALUES ('".$classId."', '".$itemTitle."', '".$itemContent."', now() )";
    	     $result = mysqli_query($con, $query) or die(mysqli_error($con));
    	     $count = mysqli_affected_rows($con);
    	     if($count > 0) {
    	         // created
    	         $response = '<div class="successResponse">Class Item added Successfully.</div>';
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
    <title>Teacher Add Item</title>
    <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="style/teachers-dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/942fa82be2.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    
    <style>
        .errorResponse{
            color: red;
            padding-left:40%;
        }
        .successResponse{
            color: green;
            padding-left:30%;
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
                    <h4> Add an Item to Class</h4>
                </div>
            </div>
            <div>

                <form method="post" form>
                    <?php
                        if(isset($response)) {
                            echo $response;
                        }
                    ?>

                    <input class="form-input" id="class-name" name="itemTitle" type="text" placeholder="Item Title" required />
                    <!--<input class="form-input" id="duration" name="duration" type="text" placeholder="Est. time of completion" required />-->
                    <textarea id="class-description" name="itemContent" required>Item Content</textarea>
                    <script>
                        CKEDITOR.replace( 'itemContent' );
                    </script>
                    <!--<<textarea id="class-content" placeholder="Class content" required></textarea>-->
                    <input type="submit" name="addItem" value="Add Item">
                </form>
            </div>
        </div>
    </div>

    <footer>
    </footer>
    <script src="js/header.js"></script>


</body>

</html>