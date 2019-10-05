<?php  include('teachersconn.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <title>Update teachers Record</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Team Artemis Mini-classroom, an open source platform that seeks to connect learners to teachers from all over the world">
    <meta name="keywords" content="Opensource,Learning,HNGI,Flutterwave,Classsroom,HTML,PHP,JAVASCRIPT,">
    <meta name="author" content="Team-Artemis">
    <link rel="stylesheet" href="style/teacher-profile.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.js" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI=" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
</head>

<body>
<?php include('fragments/students_header.php'); ?>

<?php 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $name=$_POST['name'];
    $username=$_POST['username'];
    $email=$_POST['email'];    
    
    // checking empty fields
    if(empty($name) || empty($username) || empty($email)) {            
        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($username)) {
            echo "<font color='red'>username field is empty.</font><br/>";
        }
        
        if(empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }        
    } else {    
        //updating the table
        $result = mysqli_query($db, "UPDATE users SET name='$name',username='$username',email='$email' WHERE id=$id");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: teacher-profile.php");
    }
}
?>
<?php
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $info = $_POST['info'];


    mysqli_query($db, "INSERT INTO users (name, username, email, info) VALUES ('$name', '$username','$email','$info')"); 
    $_SESSION['message'] = "Information saved"; 
    header('location:teacher-profile.php');
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $firstname = $_POST['name'];
    $lastname = $_POST['username'];
    $email = $_POST['email'];
    $info = $_POST['info'];



    mysqli_query($db, "UPDATE users SET name='$name', username='$username' , email='$email', info='$info' WHERE id=$id");
    $_SESSION['message'] = "Profile updated!"; 
    header('location: teacher-profile.php');
}
?>
    <section>

        <div class="body">

            <div class="imgcontainer">
                <img src="data:image/png;base64,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"
                    alt="Avatar" class="avatar">
            </div>

            <ul class="top">
                <li><h1> Edit Your Profile</h1></li>            
            </ul>

            <form>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext" id="staticname" value="<?php echo $name;?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control-plaintext" id="staticusername" value="<?php echo $username;?>">
                    </div></div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext" id="staticEmail" value="<?php echo $email;?>">
                    </div>
                </div>
                <div class="boxed">
                                       <label>Information</label>
                      <input type="text" value=""class="form-control-plaintext">
                </div>
                </div>
                <div >
                <button class="btn btn-primary" type="submit" name="update" style=margin-left:auto;margin-right:auto;display:block; >update</button>
            </div>
            </form>
            
        </div>
	    </section>

    
</body>

</html>