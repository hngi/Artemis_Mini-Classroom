<?php
session_start();
   error_reporting (1);
   include('connection.php');
        
    $con = connect();
    
    $password = $_POST['password'];
    $confirmPassword = $_POST["confirmPassword"];
    $code = $_POST["code"];

	$harshedPassword = sha1($password); // encrypt password
	
	if(empty($password) || empty($confirmPassword)) {
	    // email is empty
	    echo '<h4>All fields are required</h4>';
	} else if($password != $confirmPassword) {
	    // email is valid
	    echo '<h4>Your password do not match</h4>';
	} else {
	    
	    // get user email from reset password table
	    $getEmailQuery = 'SELECT * FROM reset_password WHERE code = '.$code.' ';
	    $getEmailResult = mysqli_query($con, $getEmailQuery);
	    $getEmailCount = mysqli_affected_rows($con);
	    if($getEmailCount > 0) {
	        $row = mysqli_fetch_assoc($getEmailResult);
	        $email = $row['email'];
	        
	        // update password
	        $updateQuery = "UPDATE users SET password = '".$harshedPassword."' WHERE email = '".$email."' ";
	        $updateResult = mysqli_query($con, $updateQuery);
	        $updateCount = mysqli_affected_rows($con);
	        if($updateCount > 0) {
	            // password updated
	            echo '<h4>You have successfully updated Your password</h4>';
	        } else {
	            // error
	            echo '<h4>something went wrong, please try again.</h4>';
	        }
	        
	    } else {
	        echo '<h4>You have not been authorized to reset your password</h4>';
	    }
	
	}

?>

