<?php
if( (isset($_SESSION["userId"])) && ($_SESSION["role"] != 'student') ) {
    header('Location:students-dashboard.php');
}elseif((isset($_SESSION["userId"])) && ($_SESSION["role"] != 'teacher')){
    header('Location:teachers-dashboard.php');
}

?>
<?php
    if(isset($_GET['role'])){
        $role = $_GET['role'];
    } else {
        $role = "";
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
    <title>Artemis_Mini-Classroom</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://kit.fontawesome.com/1b74471b9a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.js" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">

    <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>

	<script>
        function callSignin() {
                
                var signinLoading = document.getElementById('signinLoading');
                signinLoading.style.display = 'inline';
                
                var signinEmail = $('#signinEmail').val();
                var signinPassword = $('#signinPassword').val();
                var role = $('#role').val();
                
                $.post('functions/signin.php', {
                    signinEmail: signinEmail,
                    signinPassword: signinPassword,
                    role: role
                },
                function(data){
                    signinLoading.style.display = 'none';
                    $('#signinResult').html(data);
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
            <button id="backBtn" onClick="javascript:history.go(-1)"><i class="fas fa-arrow-left">&nbsp;Back</i></button>
            <section class="login">

                <?php
                if ($role == "teacher"){
                    echo "<h1>TEACHER SIGN IN</h1>";
                }else{
                    echo "<h1>STUDENT SIGN IN</h1>";
                }

                ?>
                <!--<h1> WELCOME BACK! </h1>
                <h1> WELCOME BACK! STUDENT </h1>-->
                
                <!-- <button id="teacher_signin">Teacher?</button> -->
                <form method="post">
                    <!--<h1>Sign up</h1>-->
                    
                    <label class="form-label" for="email"></label>
                    <br>
                    <p><input class="form-input" id="signinEmail" name="signinEmail" type="email" placeholder="Email" required onchange="signinValidateEmail()" />
                    <div class="errorMsg" id="signinEmailError" style="visibility: hidden;">&nbsp;</div></p>
                    <!--                input 1-->
<br>
                    <label for="password"></label>
                    <p><input id="signinPassword" name="signinPassword" type="password" pattern=".{8,}" placeholder="Password" required onkeyup="signinValidatePassword()" />
                    <div class="errorMsg" id="signinPasswordError" style="visibility: hidden;">&nbsp;</div></p></p>
                    
                    <input type="hidden" name="role" id="role" value="<?php echo $role; ?>" />
                    
                    <?php
                    if ($role == "teacher"){
                        echo "<a href='signin.php?role=student' id='signLink'><b><h4>Student Sign in</h4></b></a>";
                    }else{
                        echo "<a href='signin.php?role=teacher' id='signLink'><b><h4>Teacher Sign in</h4></b></a>";
                    }


                    ?>

                    <a href="forgot_password.php" style="float:right; display:none">Forgot Password?</a>
                    <br><br>
                    <!--                input 1-->
                    <!-- <input type="submit" value="Login"> -->

                    <div id="signinResult"></div>

                    <button type="button" id="signinSubmitBtn" disabled onclick="callSignin()">
                        <img src="images/loading.gif" width="20px" height="20px" id="signinLoading" style="display: none;">
                        Login
                    </button>
                    <br>
                    <p class="message"> Don't have an account? <a href="#" id="show_register">sign up here</a></p>
                </form>
            </section>
            <section class="signup" id="signup">
                <h1>Join the network</h1>
                <!-- <button id="teacher_signin">Teacher?</button> -->
                
                <form method="">
                    <!--<h1>Sign up</h1>-->
                    <!--                input 1-->
                    <label for="firstname"></label>
                    <p><input id="firstName" name="firstName" type="text" placeholder="Firstname" required onchange="validateFirstName()"/>
                    <div class="errorMsg" id="firstNameError" style="visibility: hidden;">&nbsp;</div>
                    </p>
                    
                    <!--                input 1-->
                    <label for="lastname"></label>
                    <p><input id="lastName" name="lastName" type="text" placeholder="Lastname" required onchange="validateLastName()" />
                    <div class="errorMsg" id="lastNameError" style="visibility: hidden;">&nbsp;</div>
                    </p>
                    
                    <!--                input 1-->
                    <label for="email"></label>
                    <p><input id="email" name="email" type="email" placeholder="Email" required onchange="validateEmail()" />
                    <div class="errorMsg" id="emailError" style="visibility: hidden;">&nbsp;</div></p>
                    
                    <!-- <p><input id="username" name="username" type="text" placeholder="Username" required /></p> -->
    
                    <!--                input 1-->
                    <label for="password">Password:</label>
                    <p><input id="password" name="password" type="password" placeholder="password" pattern=".{8,}" required onkeyup="validatePassword()" />
                    <div class="errorMsg" id="passwordError" style="visibility: hidden;">&nbsp;</div></p>
                    
                    <!--                input 1-->
                    <label for="confirm_password">Confirm Password:</label>

                    <p><input id="confirmPassword" name="confirmPassword" type="password" placeholder=" Confirm Password" pattern=".{8,}" required onkeyup="validateConfirmPassword()" />
                    <div class="errorMsg" id="confirmPasswordError" style="visibility: hidden;">&nbsp;</div>
                    </p>
                    

                    <p>
                        <select name="role" id="role" style="padding: 10px;">
                            <option value="teacher" <?php  if($role == "teacher") { ?> selected <?php } ?> >Teacher</option>
                            <option value="student" <?php  if($role == "student") { ?> selected <?php } ?>>Student</option>
                        </select>
                    </p>
                    <br>
                    <!--                input 1-->
                    <!-- <button type="button" disabled id="submitBtn" onclick="callCreateAccount()">Create Account</button> -->
                    <div id="result"></div>
                    <button type="button" id="submitBtn" disabled onclick="callCreateAccount()">
                        <img src="images/loading.gif" width="20px" height="20px" id="loading" style="display: none;">
                        Create Account
                    </button>

                    <br>
                    <p class="message">Already have an account? <a href="#" id="show_login">Log in</a></p>
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
