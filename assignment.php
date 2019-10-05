<?php
 session_start();
 include("functions/connection.php")
 $con= connect();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Assignment list</title>
  <link rel="stylesheet" href="style/classList.css">
  <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">
  <script src="https://use.fontawesome.com/942fa82be2.js"></script>


</head>
<body> 
<?php include('fragments/teachers_header.php'); ?>
 <?php
  //get all the assignments the teacher has given 
  $query= 'SELECT * FROM assignment WHERE teacher_id ='. $_SESSION["userId"].'';
  $result = mysqli_query($con,$query);
  $count = mysqli_affected_rows($con);
 ?>
<div id="main">
        <section>
            <div class="dropdown">
                
            </div>
            <div option-nav>
                <h4>You have given <?php echo $count; ?> Assignment(s)</h4>
            </div>
            <?php
                if($count > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="wrapper ">
                                <div class="">';
                         echo '  
                        </div>
                        <div class="description">
                            <b><a id="course-link" href="">'.$row["assignment_title"].'</a></b>
                            <hr>
                            <p id="date_created">Date Created : '.$row["date_created"].'</p>
                            <p id="course_stats"></p>
                            <p id="descText">'.$row["assignment_desc"].'
                            </p>
                        </div>
                        <div class="space">
                        </div>
                    </div>';
                    }
                    
                } else {
                    echo '<h4>You have not given any assignment</h4>';
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