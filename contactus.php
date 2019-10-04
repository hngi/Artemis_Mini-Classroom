<?php

include('functions/connection.php');
$con = connect();

    if(isset($_POST["submit"])) {
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

        $query = "INSERT into contact_messages (fullname, email, subject, message, date_time) VALUES ('".$fullname."', '".$email."', '".$subject."', '".$message."', now() )";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $count = mysqli_affected_rows($con);
        if($count > 0) {
            // message sent
            $response = '<div class="alert alert-success" role="alert">We have received your message. We will get back to you as soon as possible.</div>';
        } else {
            // error occurred
            $response = '<div class="alert alert-danger" role="alert">An error occurred.</div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">    <link rel="stylesheet" href="style/index.css">
    <title>Contact Us</title>
    <style>
    body{
        font-family: 'Roboto', sans-serif;
        background: none;
        }   
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-md bg-light navbar-light ">
        <a class="navbar-brand" href="index.php">
            <img src="https://res.cloudinary.com/wpgroom-com/image/upload/v1569679306/logo_tlzipn.png" alt="Artemis classroom logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse  navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="signin.php?role=teacher">Teacher</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="signin.php?role=student">Student</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="faq.html">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="contactus.php">Contact Us</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
        <div class="contact-form col-md-5 col-xs-12" style="float-left;">
            <div class="page-header p-5">
                <h1>Contact Us</h1>
            </div>
        <form method="post">
                <?php
                    if(isset($response)) {
                        echo $response;
                    }
                ?>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Full name" name="fullname" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email address" name="email" required>
                </div>
                <div clas="form-group">
                    <label>Subject</label>
                    <input type="text" class="form-control" name="subject">
                </div><br>
                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" placeholder="Type your message" rows="4" name="message" required></textarea>
                </div>
                <div class ="row">
                    <div class="col text-center">
                        <button type="submit" name="submit" class="btn" style="color:white; background-color:#57489D; width:100%;" a href="#">SEND</button>
                    </div>
                </div>
            </form>
        </div>
                <div class="col-md-7">
                    <div id="map" style="height: 400px; margin:180px auto 0px 50px;">
                    <iframe src="https://maps.google.com/maps?q=hotels.ng&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0"  width="600" height="300" style="border:0" allowfullscreen></iframe>
                </div>
       

         <!--Contact Buttons-->
                <div class="row text-center">
                    <div class="col-md-4">
                        <a class="btn btn-lg" style="color:white; background-color:#57489D; margin-bottom:20px; border-radius:50%;" href="#"><i class="fa fa-map-marker"></i></a><br>
                        <p>Yaba, 100001</p>
                        <p>Nigeria</p> 
                    </div>
        
                    <div class="col-md-4">
                        <a class="btn btn-lg" style="color:white; background-color:#57489D; margin-bottom:20px; border-radius:50%;" href="#"><i class="fa fa-phone"></i></a><br>
                        <p>0700 880 8800</p>
                        <p>Mon - Fri, 8:30-17:30</p>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-lg" style="color:white; background-color:#57489D; margin-bottom:20px; border-radius:50%;" href="mailto:support@hotels.ng"><i class="fa fa-envelope"></i></a>
                        <p>support@hotels.ng</p>
                    </div>
                </div>
            </div>
    </div>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCd0_SVCDS0Eph4Ql6l0n5FQck9eU1l7ns"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.25/gmaps.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>