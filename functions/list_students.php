<?php
    session_start();

    error_reporting (1);
    include('connection.php');
    
    $class_id = intval($_GET['class_id']);
    $con = connect();
    header("Access-Control-Allow-Origin: *");

    $query_select = 'SELECT * FROM enrolment WHERE class_id = '.$class_id.'';
    $run_query_select = mysqli_query($con, $query_select);
    $student = array();


    $query_class_name = 'SELECT * FROM classes WHERE class_id = '.$class_id.'';
    $run_class_query = mysqli_query($con, $query_class_name);
    $class = mysqli_fetch_assoc($run_class_query);

  
    
    while($result = mysqli_fetch_assoc($run_query_select)){
        // select student details based on individually returned student_id
        $query_student ='SELECT `firstname`, `lastname` FROM users WHERE user_id='.$result['student_id'].'';
        $run_query_student = mysqli_query($con, $query_student);
        
        // // Add each student to an array 
        $students[] = mysqli_fetch_assoc($run_query_student);
      }
      
      foreach($students as $student){
        echo '<li class="student">'.$student['firstname'].' '.$student['lastname'].'</li>';
      };
  mysqli_close($con)

?>



