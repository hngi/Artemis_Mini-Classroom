<?php
session_start();
   error_reporting (1);
   include('connection.php');
        
    $con = connect();
    
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$password = $_POST["password"];
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
	    echo 'Email address is already associated with an account';
	    
	} else {
	    
	    // email doest not exist
	    $query = "INSERT into users (firstname, lastname, email, password, role, activation_code, activated) VALUES ('".$firstName."', '".$lastName."', '".$email."',  '".$harshedPassword."', '".$role."', '".$activation_code."', 0)";
    	$result = mysqli_query($con,$query);
    	$count = mysqli_affected_rows($con);
    	 if($count > 0) { 
    	     
    	    // get user details
    	    $getDetailsQuery = "SELECT * FROM users WHERE email = '".$email."' ";
    	    $getDetailsResult = mysqli_query($con, $getDetailsQuery);
    	    $row = mysqli_fetch_assoc($getDetailsResult);
    	     
    	    $userId = $row["user_id"];
            $firstName = $row["firstname"];
            $lastName = $row["lastname"];
            $email = $row["email"];
            $role = $row["role"];
            $activated = $row["activated"];
    	    
    	    // create sessions
    	    // create sessions
            $_SESSION["userId"] = $userId;
            $_SESSION["fullname"] = $firstName . ' ' . $lastName;
            $_SESSION["email"] = $email;
            $_SESSION["role"] = $role;
            
            //header('Location: https://mini-classroom.000webhostapp.com/teachers-dashboard.php');
            
            //echo '<script>window.location.href= "https://mini-classroom.000webhostapp.com/teachers-dashboard.php"; </script>';
           
    	    echo '<p>Your registration was successful. You will be redirected to your dashboard.</p>';
    	    
    	    $message = '
			<b>Thank you for signing up!</b>
			<p>Your account has been created, you can login with the following credentials after you have activated your account by clicking the url below.</p>.
 
			<p>------------------------</p>
			<p>Email: '.$email.'</p>
			<p>Password: '.$password.'</p>
			<p>------------------------</p>';

			$to = $email;
			$subject = 'Account Activation';
			
             
			$header = "From:donoreply@mini-classroom.com \r\n";
		    //  $header .= "Cc:afgh@somedomain.com \r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";
			mail($to,$subject,$message,$header);
			
// 			echo '<script>
//                 window.location.href = "https://mini-classroom.000webhostapp.com/signin.php?role='.$role.'";
//             </script>';
            
            echo '<script>
                window.location.href = "http://artemis-mini-classroom.evapeaceful.com/signin.php?role='.$role.'";
            </script>';
            
    	    
    	    // redirect to dashbaord
    	   // if($role == "teacher") {
    	   //     echo '<script>
        //         window.location.href = "https://mini-classroom.000webhostapp.com/teachers-dashboard.php";
        //         </script>';
    	   // } else if($role == "student") {
    	   //     echo '<script>
        //         window.location.href = "https://mini-classroom.000webhostapp.com/students-dashboard.php";
        //         </script>';
    	   // } else {
    	   //     echo '<script>
        //         window.location.href = "https://mini-classroom.000webhostapp.com/error.php";
        //         </script>';
    	   // }
			 
			/*<p>Activation link : https://mini-classroom.000webhostapp.com/functions/activate_account.php?email='.$email.'&activation_code='.$activation_code.'</p>
			'*/
    	     
    	 } else {
    	     
    	     // secho 'error : ' . mysqli_error($con);
    	     echo '<p>Something went wront, Please try again</p>';
    	     
    	 }
    	 
	}


?>

