<?php 
	session_start();
    $db = mysqli_connect('localhost', 'root', '', 'artemis');
    
	// initialize variables
	$name = "";
    $username = "";
    $email = "";
	$info = "";
	$id = 0;
	$update = false;

?>