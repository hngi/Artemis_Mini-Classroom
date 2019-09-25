<?php
    session_start();

    error_reporting (1);
    include('connection.php');

    $con = connect();

    $email = $_POST["signinEmail"];
    $password = $_POST["signinPassword"];

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

        if($activated == 1) {
            // account is activated
            // create sessions
            $_SESSION["userId"] = $userId;
            $_SESSION["fullname"] = $firstName . ' ' . $lastName;
            $_SESSION["email"] = $email;
            $_SESSION["role"] = $role;

            // redirect to dashbaord
            // header("Location:../dashboard.php");
            echo '<script>
                window.location.href = "http://localhost/artemis/dashboard.php";
                </script>';

        } else {
            // account is not activated
            echo '<h2>You have not activated your account</h2>';
        }

    } else {
        // user doest not exist
        echo 'Incorrect Username or password';
        
    }
?>