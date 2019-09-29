<?php
session_start();
include('functions/connection.php');
$con = connect();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Class List</title>
    <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="style/classList.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/942fa82be2.js"></script>
</head>

<body>
    <?php include('fragments/teachers_header.php'); ?>
    <?php
        $query = 'SELECT * FROM classes WHERE teacher_id = '.$_SESSION["userId"].' order by class_id desc';
        $result = mysqli_query($con,$query);
        $count = mysqli_affected_rows($con);
    ?>
    <div id="main">
        <section>
            <div class="dropdown">
                <a href="createclass.php" style="text-decoration:none;"><button id="dropbutton" class="dropbtn">+ New Class</button></a>
            </div>
            <div option-nav>
                <h4>You have <?php echo $count; ?> Classes</h4>
            </div>
            <?php
                if($count > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        // get class items
                        $itemsQuery = 'SELECT * FROM class_items WHERE class_id = '.$row["class_id"].'';
                        $itemsResult = mysqli_query($con,$itemsQuery);
                        $itemsCount = mysqli_affected_rows($con);
                        echo '
                    <div class="wrapper ">
                        <div class="videos">';
                            
                            if($row["has_pic"] == 0) {
                                // no picture
                                echo '
                                <img src="class_pics/no_image.jpg" width="200px" height="150px">
                                <a href="upload_class_picture.php?class_id='.$row["class_id"].'">
                                <button class ="thumbnail_btn">Upload Class Picture</button>
                                </a>';
                            } else {
                                // picture exist
                                echo '
                                <a href="upload_class_picture.php?class_id='.$row["class_id"].'">
                                <img src="class_pics/'.$row["class_id"].'.jpg" width="200px" height="150px">
                                <button class ="thumbnail_btn">Change Picture</button>
                                </a>';
                            }
                            
                         echo '  
                        </div>
                        <div class="description">
                            <b><a id="course-link" href="">'.$row["class_name"].'</a></b>
                            <hr>
                            <p id="date_created">Date Created : '.$row["date_created"].'</p>
                            <p id="course_stats"></p>
                            <p id="descText">'.$row["class_desc"].'
                            </p>
                        </div>
                        <div class="space">
                        </div>
                        <div class="enroll_btn">
                            <button><a href="teacher_add_item.php?class_id='.$row["class_id"].'"> + Add Item</a></button>
                            <p id="participants">'.$itemsCount.' class items</p>
                        </div>
                    </div>';
                    }
                    
                } else {
                    echo '<h4>You have not created any class</h4>';
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