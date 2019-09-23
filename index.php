<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Artemis_Mini-Classroom</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.js" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI="
  crossorigin="anonymous"></script>
</head>
<body>
   <div class="container">
    <main class="logon">
            <section class="login">
                    <h1>WELCOME BACK!</h1>
                        <h1>Sign in to your account</h1>
                        <select name="cars">
                            <option value="volvo">Teacher</option>
                            <option value="saab">Student</option>
                          </select>
                        <form action="" method="">
                            <!--<h1>Sign up</h1>-->
                            <label for="email">Email</label>
                            <p><input id="email" name="email" type="email" placeholder="example@xyz.com" required /></p>
                            <!--                input 1-->
                            <label for="password">Password</label>
                            <p><input id="password" name="password" type="password" placeholder="minimum of 8 characters" pattern=".{8,}" required /></p>
                                <!--                input 1-->
                            <input type="submit" value="Login">
                                <p class="message"> Don't have an account? <a href="#" id="show_register">sign up here</a></p>
                        </form>
                </section>
        <section class="signup">
                <h1>Sign up to get Started</h1>
                <select name="cars">
                    <option value="volvo">Teacher</option>
                    <option value="saab">Student</option>
                  </select>
                <form action="" method="">
                    <!--<h1>Sign up</h1>-->
                    <!--                input 1-->
                    <label for="firstname">First Name</label>
                    <p><input id="firstname" name="firstname" type="text" placeholder="First Name" required /></p>
                    <!--                input 1-->
                    <label for="lastname">Last Name</label>
                    <p><input id="lastname" name="lastname" type="text" placeholder="lastname" required /></p>
                    <!--                input 1-->
                    <label for="email">Email</label>
                    <p><input id="email" name="email" type="email" placeholder="example@xyz.com" required /></p>
                    <!--                input 1-->
                    <label for="gender"></label>Gender:</label>
                    <input type="radio" name="gender" value="male" checked> Male
                     <input type="radio" name="gender" value="female">Female
                    <!--                input 1-->
                    <!--                input 1-->
                    <label for="password">Password</label>
                    <p><input id="password" name="password" type="password" placeholder="minimum of 8 characters" pattern=".{8,}" required /></p>
                        <!--                input 1-->
                        <label for="confirm_password">Confirm Password</label>
                        <p><input id="confirm_password" name="confirm_password" type="password" placeholder="minimum of 8 characters" pattern=".{8,}" required /></p>
                        <!--                input 1-->
                        <input type="submit" value="Create Account">
                        <p class="message">Already have an account? <a href="#" id="show_login">Log in</a></p>
                </form>
        </section>
        
        
    </main>
<aside class="logo">
<section class="slogan">
    <h1>TEAM ARTEMIS</h1>
    <P>...learn, share, collaborate</P>
</section>
</aside>
   </div> 
   <script type="text/javascript">
    $(function(){
$('#show_register').click(function(){
      $('.login').hide();
      $('.signup').show();
      return false;
  });
$('#show_login').click(function(){
      $('.login').show();
      $('.signup').hide();
      return false;
  });
});
//   $(function(){
//   $('#show_forgot_password').click(function(){
//       $('.forget_password_email').show();
//       $('.loginbox').hide();
//       return false;
//   });
//       $('#goback_login').click(function(){
//       $('.loginbox').show();
//       $('.forget_password_email').hide();
      
//     return false;
//   });
      
//       });
  </script>
</body>
</html>
