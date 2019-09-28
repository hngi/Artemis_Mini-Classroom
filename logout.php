<?php
session_start();
unset($_SESSION['fullname']);
unset($_SESSION['userId']);
unset($_SESSION['email']);
unset($_SESSION['role']);


session_destroy();

header("Location: index.php");
?>