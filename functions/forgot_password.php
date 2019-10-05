<?php
session_start();
   error_reporting (1);
   include('connection.php');
        
    $con = connect();
    
    $email = $_POST['email'];

	$harshedPassword = sha1($password); // encrypt password
	
	if(empty($email)) {
	    // email is empty
	    echo '<h4>Please enter an email address</h4>';
	} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    // email is valid
	    echo '<h4>Please enter a valid Email address</h4>';
	} else {
	    
	    // check if email already exist
    	$checkEmailQuery = "SELECT * FROM users WHERE email = '".$email."'";
    	$result = mysqli_query($con,$checkEmailQuery);
	
    	if(mysqli_affected_rows($con) > 0) {

    	    // email exist
    	    
    	    $code = rand(123456,654321);
            $resetCode = sha1($code);
    	    
    	    $resetLink = "https://mini-classroom.000webhostapp.com/reset_password.php?code=".$resetCode."";
    	    
    	    $message = '
			<b>Reset your password</b>
			<p>Click on the url below to reset your password</p>.
 
			<p>------------------------</p>
			<p>Reset URL: '.$resetLink.'</p>
			<p>------------------------</p>';

			$to = $email;
			$subject = 'Reset Password';
			
			$header = "From:donoreply@artemis-mini-classroom.com \r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";
			mail($to,$subject,$message,$header);
			
			// insert code to db
			$insertQuery = "INSERT INTO reset_password (email, code) VALUES ('".$email."', '".$resetCode."') ";
			$insertResult = mysqli_query($con, $insertQuery);
			$insertCount = mysqli_affected_rows($con);
			if($insertCount > 0) {
			    echo '<h4>A password reset link has been sent. You will receive this email within 5 minutes. Be sure to check your spam folder too.</h4>';
			} else {
			    echo '<h4>Something went wrong, Please try again</h4>';
			}
			
    	    
    	} else {
    	    // email does not exist
    	    echo '<h4>There is no account associated with your email</h4>'; 
    	}
	
	}

?>

