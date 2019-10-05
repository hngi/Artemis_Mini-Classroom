<?php
    session_start();

    error_reporting (1);
    include('connection.php');

    $con = connect();

    $email = $_POST["signinEmail"];
    $password = $_POST["signinPassword"];
    $roleSelected = $_POST["role"];

    $hashedPassword = sha1($password);

    $loginQuery = 'SELECT * FROM users WHERE email="'.$email.'" AND password="'.$hashedPassword.'" ';
    $loginResult = mysqli_query($con, $loginQuery);
    $count = mysqli_affected_rows($con);

    if($count > 0) {
        // user exists
        // get user details
        $row = mysqli_fetch_assoc($loginResult);
        
        $userId = $row["user_id"];
        $firstName = $row["firstname"];
        $lastName = $row["lastname"];
        $email = $row["email"];
        $role = $row["role"];
        $activated = $row["activated"];

        if($role == $roleSelected) {
            // role is correct
            // create sessions
            $_SESSION["userId"] = $userId;
            $_SESSION["fullname"] = $firstName . ' ' . $lastName;
            $_SESSION["email"] = $email;
            $_SESSION["role"] = $role;

            // redirect to dashbaord
            // header("Location:../dashboard.php");
            
            // check if user is student or teacher
            if($role == "teacher") {
                echo '<script>
                window.location.href = "teachers-dashboard.php";
                </script>';
            } else if($role == "student") {
                 echo '<script>
                window.location.href = "students-dashboard.php";
                </script>';
            }
            

        } else {
            // role is wrong
            if($role == 'teacher') {
                echo '<h4>You cannot login as a Student</h4><br>';
            } else if($role == 'student') {
                echo '<h4>You cannot login as a Teacher</h4><br>';
            }
            
        }

    } else {
        // user doest not exist
        echo '<div class="errorMsg">Incorrect Username or password<br><br></div>';
        
    }
?>