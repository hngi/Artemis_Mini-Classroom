<?php

   error_reporting (1);
   include('connection.php');
        
    $con = connect();

    $firstName = "";
    $lastName = "";
    $email = "";
    $password = "";
    $role = "";


    if(preg_match("/^([a-zA-Z' ]+)$/",$_POST['firstName'])){
        $firstName = $_POST['firstName'];
	}
	if(preg_match("/^([a-zA-Z' ]+)$/",$_POST['lastName'])){
        $lastName = $_POST['lastName'];
	}

	function valid_email($email) {
    	return !!filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	if(valid_email($_POST['email'])){
        $email = $_POST['email'];
	}
	if(count($_POST['password'])>7){
        $password = $_POST["password"];
	}
	
	$role = $_POST['role'];

	$harshedPassword = sha1($password); // encrypt password
	
	$code = rand(123456,654321);
    $activation_code = sha1($code);


	// check if email already exist
	$checkEmailQuery = "SELECT * FROM users WHERE email = '".$email."'";
	$result = mysqli_query($con,$checkEmailQuery);
	/*echo mysqli_affected_rows($con);
	die();*/
	if(mysqli_affected_rows($con) > 0) {
	    
	    // email already exist in db
	    echo 'email already exist';
	    
	} else {
	    
	    // email doest not exist
	    $query = "INSERT into users (firstname, lastname, email, password, role, activation_code, activated) VALUES ('".$firstName."', '".$lastName."', '".$email."',  '".$harshedPassword."', '".$role."', '".$activation_code."', 0)";
    	$result = mysqli_query($con,$query);
    	 if($result) { 
			 
			// send activation link to email address
			// $message .= "<h1>This is headline.</h1>";
			// $message = '<b>Hello '.$firstname.' '.$lastname.', your password is '.$plainPassword.'</b>';

			$message = '
			<b>Thank you for signing up!</b>
			<p>Your account has been created, you can login with the following credentials after you have activated your account by clicking the url below.</p>.
 
			<p>------------------------</p>
			<p>Email: '.$email.'</p>
			<p>Password: '.$password.'</p>
			<p>------------------------</p>

			<p>Activation link : http://localhost/artemis/functions/activate_account.php?email='.$email.'&activation_code='.$activation_code.'</p>
			';

			
             
		// 	$header = "From:help@amabox.com \r\n";
		//    //  $header .= "Cc:afgh@somedomain.com \r\n";
		// 	$header .= "MIME-Version: 1.0\r\n";
		// 	$header .= "Content-type: text/html\r\n";
		// 	$retval = mail ($to,$subject,$message,$header);

    	    echo 'An verification link has been sent your mail.
				Please click the button in the message to confirm your email address.';
    	     
    	 } else {
    	     
    	     // secho 'error : ' . mysqli_error($con);
    	     
    	 }
    	 
	}


?>

