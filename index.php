<!DOCTYPE html>
<html>

<head>
    <title>Welcome To Artemis Classroom App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.js" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md bg-light navbar-light ">
        <a class="navbar-brand" href="#">
            <img src="https://res.cloudinary.com/wpgroom-com/image/upload/v1569679306/logo_tlzipn.png" alt="Artemis classroom logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse  navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="signin.php?role=teacher">Teacher</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="signin.php?role=student">Student</a>
                </li>
            </ul>
        </div>
    </nav>
    <div>
        <!-- <div class="container-fluid"> -->
        <div class="welcome-banner-content row container-fluid">
            <div class="text col-12 col-md-7 col-lg-7">
                <h2>WELCOME</h2>
                <p class="desc">Artemis Mini classroom is an open source platform that seeks to connect teaches and students from various part of the world. We immerse students in a dynamic learning environment where classes are taught with an intention to help students reach their goals and pursue their dream. We believe we can improve the lives of others through learning!</p>
                <div class="row">
                    <!--					<a href="signin.php?role=teacher" class="w-btn col-sm-12 col-lg-5">GET STARTED AS A TEACHER</a>-->
                    <a href="signin.php?role=student" class="w-btn col-sm-12 col-lg-5">GET STARTED</a>
                </div>
            </div>

            <div class="w-b-img col-md-4 col-lg-4">
                <img style="width:100%" class="img-fluid" src="https://res.cloudinary.com/wpgroom-com/image/upload/v1569678455/1_whdigv.png" alt="artemis classroom">
            </div>
        </div>
    </div>


</body>

</html>
