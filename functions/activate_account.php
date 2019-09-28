<?php
session_start();
    error_reporting (1);
    include('connection.php');
        
    $con = connect();

    // check if parameters are set
    if(isset($_GET["email"])) {
        $email = $_GET["email"];
    } else {
        // invalid link
        echo 'Invalid Link';
        exit();
    }

    if(isset($_GET["activation_code"])) {
        $activation_code = $_GET["activation_code"];
    } else {
        // invalid link
        echo 'Invalid Link';
        exit();
    }
    
    // check if email exist
	$checkEmailQuery = "SELECT * FROM users WHERE email = '".$email."' AND activation_code = '".$activation_code."' ";
	$result = mysqli_query($con,$checkEmailQuery);
    $count = mysqli_affected_rows($con);
    
	if ($count > 0) {
        // user email exist
        // get user details
        $row = mysqli_fetch_assoc($result);
        $userId =  $row["user_id"];
        $firstName = $row["firstname"];
        $lastName = $row["lastname"];
        $email = $row["email"];
        $role = $row["role"];
        $activated = $row["activated"];

        // check if user has already activated account
        if($activated == 1) {
            // account is already activated
            echo 'You account is already activated';
            exit();
        } else {

            // update user details in db
            $updateQuery = 'UPDATE users SET activated=1 WHERE user_id = '.$userId.'';
            $updateResult = mysqli_query($con, $updateQuery) or die(mysqli_error($con));
            $updateCount = mysqli_affected_rows($con);
            
            if($updateCount > 0) {
                // account activated
                // create session and redirect to dashboard
                $_SESSION["userId"] = $userId;
                $_SESSION["fullname"] = $firstName . ' ' . $lastName;
                $_SESSION["role"] = $role;
                header("Location:../dashboard.php");
            } else {
                // activate account failed
                // redirect to 404 page
                echo 'failed';
            }

        }
        
    } else {
        // user email does not exist in db
        // invalid link
        echo 'Invalid Link';
        exit();
    }

?>