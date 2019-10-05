<?php
    session_start();

    error_reporting (1);
    include('connection.php');

    
    
    
    
    $con = connect();
    
    function students_enroled($class_id)
    {
        global $con;
        $query_enrolments = "SELECT * FROM enrolment WHERE class_id ='$class_id'";
        $run_query = mysqli_query($con, $query_enrolments);

        $total_enrolments = mysqli_num_rows($run_query);
        if($total_enrolments > 1){
            return "<p class='total-enrolment'>$total_enrolments students enroled for this course</p>";
        }elseif($total_enrolments === 1){
            return "<p class='total-enrolment'>$total_enrolments other student enroled for this course</p>";
        }else{
            return "<p class='total-enrolment'>Be the first to enrol for this course</p>";
        }
    }

    $searchTerm = $_POST["searchTerm"];
    
    $display = '';

    $searchQuery = "SELECT * FROM classes WHERE class_name LIKE '%".$searchTerm."%' ORDER BY class_id DESC";
    $searchResult = mysqli_query($con, $searchQuery);
    $count = mysqli_affected_rows($con);
    if($count > 0) {
        // match found
        
        while($row = mysqli_fetch_assoc($searchResult)) {
            // get teachers details
            $teacherQuery = 'SELECT * FROM users WHERE user_id = '.$row["teacher_id"].'';
            $teacherResult = mysqli_query($con, $teacherQuery);
            $teacherRow = mysqli_fetch_assoc($teacherResult);
            $teacherName = $teacherRow["firstname"] .' '.$teacherRow["lastname"];
            
            // count class items
            $itemsQuery = 'SELECT * FROM class_items WHERE class_id = '.$row["class_id"].'';
            $itemsResult = mysqli_query($con, $itemsQuery);
            $itemsCount = mysqli_affected_rows($con);
            if($itemsCount > 1) { 
                $addS = "s";
            } else {
                $addS = "";
            }
            
            $display .= '
            <div class="wrapper ">
                <div class="videos">';
                
                    if($row["has_pic"] == 1) {
                        // has picture
                        $display .= '<img src = "class_pics/'.$row["class_id"].'.jpg" width="230px" height="180px">';
                    } else {
                        // no picture
                        $display .= '<img src = "class_pics/no_image.jpg" width="230px" height="180px">';
                    }
                    
            
            $display .='
                </div>
                <div class="description">
                    <a id="course-link" href="">'.$row["class_name"].'</a>
                    <hr>
                    <p id="course_stats">Name of Teacher:  '.$teacherName.'</p>
                    <p id="date_created">Date Created : '.$row["date_created"].'</p>
                    
                    <p id="descText"> '.$row["class_desc"].'
                    <p>'.students_enroled($row["class_id"]).'</p>
                    </p>
                </div>
                <div class="space">
    
                </div>
                <div class="enroll_btn">
                    <a href="students_class_list.php?enroll=yes&classId='.$row["class_id"].'"><button>ENROLL</button></a>
                    <p id="participants"> '.$itemsCount.' Course Item'.$addS.'</p>
                </div>
    
            </div>';
        }
    
    } else {
        // no match found
        $display = '<p>No Class found</p>';
    }
    
    echo $display;
            
?>
