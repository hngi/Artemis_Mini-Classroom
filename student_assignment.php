<?php  
session_start();
include('functions/connection.php');
$con = connect();


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assignments</title>
    <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="style/classList.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/942fa82be2.js"></script>
    <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
</head>
<body>
	<?php  include('fragments/students_header.php');?>
	<?php
	  //get the classses the student is enrolled for
	  $query ='SELECT * FROM enrolment WHERE student_id ='.$_SESSION["userId"].'';
	  $result = mysqli_query($con,$query);
	  $count = mysqli_affected_rows($con);
	  $row = mysqli_fetch_assoc($result);


	  //get the assignment for the classes the student has enrolled for
	  $query_1= 'SELECT * FROM assignment WHERE class_id = '.$row["class_id"].'';
	  $result_1 = mysqli_query($con,$query_1);
	  $count_1 = mysqli_affected_rows($con);
	  
	?>
<div id="main">
        <section>
            <div class="dropdown">
         
            </div>
            <div option-nav>
                <h4>You have <?php echo $count_1; ?> Assignment(s)</h4>
            </div>
        
            <?php
                if($count > 0) {
                    while($row_1 = mysqli_fetch_assoc($result_1)); {

                    	    //get the name of the class the student has enrolled for
                    	    $query_2= 'SELECT * FROM classes WHERE class_id= '.$row_1["class_id"].'';
                    	    $result_2= mysqli_query($con,$query_2);
                    	    $row_2 = mysqli_fetch_assoc($result_2);

                    	    if ($count_1 > 0) {
                    	    	echo '
		                            <div class="wrapper ">
		                                <div class="">';
		                        echo '  
		                        </div>
		                        <div class="description">
		                            <b><a id="course-link" href="">'.$row_1["assignment_title"].'</a></b>
		                            <hr>
		                            <p id="date_created">Date Created : '.$row_1["date_created"].'</p>
		                            <p id="date_created">Class title : '.$row_2["class_name"].'</p>
		                            <p id="course_stats"></p>
		                            <p id="descText">'.$row_1["assignment_desc"].'
		                            </p>
		                        </div>
		                        <div class="space">
		                        </div>
		                        </div>';
		                	}
		                    else{
		                    	echo "<h4>You do not have any assignment</h4>";
		                    }  
		                }
		            } else {
                    echo '<h4>You have not enrolled for any course</h4>';
                }
            ?>
           
             
        </section>
        
      
    </div>
    <div class="space">
        
        </div>
    
    
    <footer>

    </footer>
    <script src="js/classList.js"></script>
    <script src="js/header.js"></script>

</body>
</html>