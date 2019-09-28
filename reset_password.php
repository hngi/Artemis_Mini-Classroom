<?php
    if(isset($_GET["code"])) {
        $code = $_GET['code'];
    } else {
        header('Location: error.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Team Artemis Mini-classroom, an open source platform that seeks to connect learners to teachers from all over the world">
    <meta name="keywords" content="Opensource,Learning,HNGI,Flutterwave,Classsroom,HTML,PHP,JAVASCRIPT,">
    <meta name="author" content="Team-Artemis">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png"> 
    <title>Artemis_Mini-Classroom - Reset Password</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.js" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">

    <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>

	<script>
        function callResetPassword() {
                
                var signinLoading = document.getElementById('signinLoading');
                signinLoading.style.display = 'inline';
                
                var password = $('#password').val();
                var confirmPassword = $('#confirmPassword').val();
                var code = $('#code').val();
                
                $.post('functions/reset_password.php', {
                    password: password,
                    confirmPassword: confirmPassword,
                    code: code
                },
                function(data){
                    signinLoading.style.display = 'none';
                    $('#result').html(data);
                });            
        }
    </script>

    <script>
        function callCreateAccount() {

            var loading = document.getElementById('loading');
            loading.style.display = 'inline';
            // body...
            var firstName = $('#firstName').val();
            var lastName = $('#lastName').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var role = $('#role').val();
            
            $.post('functions/signup.php', {
                firstName: firstName,
                lastName: lastName,
                email: email,
                password: password,
                role: role
            },
            function(data){
                loading.style.display = 'none';
                $('#result').html(data);
            });            
        }
    </script>


    
</head>

<body>
    <div class="container student">
        <div class ="inner-container">
        <main class="logon">
              <img src="https://res.cloudinary.com/dcvf3txt9/image/upload/v1569353958/Artemis_logo_mkukw1.svg" class="form-logo"alt="team artemis logo">
            <section class="login">
                <h1> RESET YOUR PASSWORD</h1>
                
                <!-- <button id="teacher_signin">Teacher?</button> -->
                <form method="post">
                    <div id="result"></div>
                    <!--<h1>Sign up</h1>-->
                    
                    <label class="form-label" for="email"></label>
                    <br>
                    <p><input class="form-input" id="password" name="password" type="password" placeholder="Your Password" required /><br>
                    </p>
                    
                    <label class="form-label" for="email"></label>
                    <br>
                    <p><input class="form-input" id="confirmPassword" name="confirmPassword" type="password" placeholder="confirm Your Password" required /><br>
                    </p>
                    
                    <input type="hidden" name="code" id="code" value="<?php echo $code; ?>" />
                    
                    <br><br>

                    <button type="button" id="signinSubmitBtn" onclick="callResetPassword()">
                        <img src="images/loading.gif" width="20px" height="20px" id="signinLoading" style="display: none;">
                        Reset
                    </button>
                    <br>
                </form>
            </section>
            
        </main>
        
        <aside >
            <div class="logo">
                <a href="index.php"><img src="https://res.cloudinary.com/dcvf3txt9/image/upload/v1569353958/Artemis_logo_mkukw1.svg" alt="team artemis logo"></a>
                
            </div>
            <section class="slogan">
                
                <p>Join the world of knowledge!</p>
                <p class="message"> Don't have an account? <a href="#" id="show_register">sign up here</a></p>
            </section>
            <section class="image">
                <img src="https://res.cloudinary.com/dcvf3txt9/image/upload/v1569354047/reg_image_f39mc7.svg" alt="background img">
            </section>
        </aside>


        </div>

        
    </div>



    <!--  -->
    <!--  -->
    <script type="text/javascript">
        $(function() {
            $('#show_register').click(function() {
                $('.login').hide();
                $('.signup').show();
                return false;
            });
            $('#show_login').click(function() {
                $('.login').show();
                $('.signup').hide();
                return false;
            });
        });
        $(function() {
            $('#teacher_signin').click(function() {
                $('.teacher').show();
                $('.student').hide();
                return false;
            });
            $('#student_signin').click(function() {
                $('.student').show();
                $('.teacher').hide();

                return false;
            });

        });
    </script>

<script src="js/signup_validation.js"></script> 
<script src="js/signin_validation.js"></script>
</body>

</html>
