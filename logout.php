<?php
session_start();
unset($_SESSION['fullname']);

session_destroy();

header("Location: index.php");
?>