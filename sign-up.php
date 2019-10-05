<?php
	
	$first_name = $_POST['firstname'];
	$last_name = $_POST['lastname'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$pw = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$servername = "localhost";
	$username = "root";
	$password = "";

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=artemis", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    #create the database
	    //     $sql_create = "CREATE TABLE TeacherTable (
	    // 	firstname VARCHAR(30) NOT NULL,
	    // 	lastname VARCHAR(30) NOT NULL,
	    // 	email VARCHAR(50),
	    //     gender VARCHAR(30),
	    // 	password VARCHAR(30),
	    // 	confirm_password VARCHAR(30)
	    // )";
	    // $conn->exec($sql_create);



	    // $sql_insert = "INSERT INTO TeacherTable (firstname, lastname, email, gender, password, confirm_password)
	    // VALUES ('$first_name', '$last_name', '$email', '$gender', '$pw', '$confirm_password')";
	    // $conn->exec($sql_insert);

	    echo "New record created successfully";
	    
	    }
	catch(PDOException $e)
	    {
	    echo $sql_insert . "<br>" . $e->getMessage();
	    }





?>