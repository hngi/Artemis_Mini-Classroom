<?php
 include("functions/connection.php");
 $con = connect();

 if( (!isset($_SESSION["userId"])) && ($_SESSION["role"] != 'teacher') ) {
    header('Location:signin.php');
}
if(isset($_GET["class_id"])) {
    $classId = $_GET["class_id"];   
} else {
    header('Location:error.php');
}

 if(isset($_POST["createAssignment"])) {
        $assignmentName = "";
        $assignmentDesc = "";
        
        
        $assignmentName = $_POST['assignmentName'];
        $assignmentDesc = $_POST['assignmentDesc'];
    	
    	if($assignmentName == "" || $assignmentDesc == "") {
    	    $response = '<div class="errorResponse">Please enter valid data.</div>';
    	} else {
    	     $query = "INSERT into assignment(assignment_title, assignment_desc, date_created, teacher_id, class_id) VALUES ('".$assignmentName."', '".$assignmentDesc."',now(),".$_SESSION['user_id']."','".$classId."')"; 
    	     $result = mysqli_query($con, $query) or die(mysqli_error($con));
    	     $count = mysqli_affected_rows($con);
    	     if($count > 0) {
    	         // created
    	         header("Location: assignment.php");
    	     } else {
    	         // error occurred
    	         $response = '<div class="errorResponse">An error occurred.</div>';
    	     }
    	}
        
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="style/teachers-dashboard.css">
</head>
<body>
	 <?php include('teachers_header.php'); ?>
	    <div class="form-container">
        <div id="c-class-form">
            <div class="c-class-form-header">
                <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569397784/team%20artemis/Layer_x0020_1_s6rnnd.png" class="icons" alt="class">
                <div class="content-header">
                    <h4> Create Assignment</h4>
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
                    <input class="form-input" id="assignment-name" name="assignmentName" type="text" placeholder="Assignment Title" required />
                    <!--<input class="form-input" id="duration" name="duration" type="text" placeholder="Est. time of completion" required />-->
                    <textarea id="assignment-description" name="assignmentDesc" placeholder="Assignment description" required></textarea>
                    <!--<textarea id="class-content" placeholder="Class content" required></textarea>-->
                    <input type="submit" name="createAssignment" value="Create">
                </form>
            </div>
        </div>
    </div>


</body>
</html>