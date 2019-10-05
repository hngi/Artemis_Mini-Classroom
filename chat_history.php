<?php
session_start();
include('functions/connection.php');
$con = connect();

if (!isset($_SESSION["userId"]))  {
    header('Location:signin.php');
}

if(isset($_GET["user_id"])) {
    $userId = $_GET["user_id"];
    // get name of receiver
    $recQuery = 'SELECT * FROM users WHERE user_id = '.$userId.'';
    $recResult = mysqli_query($con,$recQuery) or die(mysqli_error($con));
    $recRow = mysqli_fetch_assoc($recResult);
    $recName = $recRow['firstname'] . ' ' . $recRow['lastname'];
} else {
    header('Location:error.php');
}

// which dashbaord?
if($_SESSION["role"] == "teacher") {
    $dashbaord = "teachers-dashboard.php";
} else {
    $dashbaord = "students-dashboard.php";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat Window</title>
    <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png">
    <!--<link rel="stylesheet" href="style/classList.css">-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/942fa82be2.js"></script>
    <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
    
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->

    <!-- Latest compiled JavaScript -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
     
    <script>
        function sendMessage() {
                
                // var loading = document.getElementById('loading');
                // var mainContent = document.getElementById('mainContent');
                // loading.style.display = 'inline';
                
               
                
                var message = $('#message').val();
                var rec_id = $('#rec_id').val();
                
                $.post('functions/send_message.php', {
                    message: message,
                    rec_id: rec_id
                },
                function(data){
                    // loading.style.display = 'none';
                    // mainContent.style.display = 'none';
                    //document.getElementById("myform").reset();
                    //$("#myform").trigger('reset');
                    document.getElementById('message').value = '';
                    scrollToBottom();
                    $('#result').html(data);
                });            
        }

        function loadMessages() {
            $.post('functions/load_messages.php?id=<?php echo $userId; ?>', {
            },
            function(data){
                $('#chatResult').html(data);
            });   
            setTimeout(loadMessages, 2000);
        }
        loadMessages();
        
        function scrollToBottom2() {
            var objDiv = document.getElementById("mainContent");
            objDiv.scrollTop = objDiv.scrollHeight;
            // setTimeout(scrollToBottom, 2000);
        }
        

    </script>


    <style>
        .user{
            margin: 10px;
            padding: 5px;
        }

        .me{
            float: right; 
            background: #D8DBEE;
            padding: 10px;
            margin: 3px;
            border-radius: 20px;
        }

        .you{
            float: left; 
            background: #ECDAF6;
            padding: 10px;
            margin: 3px;
            border-radius: 20px;
        }

    </style>
    
</head>

<body id="mybody">
<?php
    // if($_SESSION["role"] == "student") {
    //     include('fragments/students_header.php'); 
    // } else if($_SESSION["role"] == "teacher") {
    //     include('fragments/teachers_header.php'); 
    // }
?>

    
    <div class="container">
        
        <nav class="navbar navbar-inverse" style="background: #603996; !important; border: none !important; ">
          <div class="container-fluid">
            <div class="navbar-header">
              <!--<a class="navbar-brand" href="#">WebSiteName</a>-->
              <div class="dash-logo">
                    <a href=""><img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569396996/Artemis_wh3le6.svg"></a>
                </div>
            </div>
            <!--<ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#">Page 1</a></li>
              <li><a href="#">Page 2</a></li>
            </ul>-->
            <ul class="nav navbar-nav navbar-right">
              <li><a href="inbox.php"><span class="glyphicon glyphicon-envelope"></span> Back to Inbox</a></li>
              <li><a href="<?php echo $dashbaord; ?>"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
            </ul>
          </div>
        </nav>
        
        <!--<div class="row">
            <nav class="navbar navbar-inverse">
              <div class="container-fluid">
                <div class="navbar-header">
                  <a class="navbar-brand" href="#">WebSiteName</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-inbox"></span> Inbox</a></li>
                </ul>
              </div>
            </nav>
        </div>-->
            
        <div>
            <h4>
                Your chat with <?php echo $recName; ?>
            </h4>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div id="mainContent" style="overflow-y:scroll; overflow-x: hidden; height:290px; padding: 5px;">
                    <div id="chatResult" style="padding-bottom: 80px;"></div>            
                </div>
            </div>
        </div> 
        
        <div style="clear: both;"></div>
        
        <div class="row">
            <div class="col-md-12" style="position: fixed; left: 0; bottom: 10px; width: 100%; text-align: center; margin-top: 4px; ">
                 <div class="col-md-12" style="padding-left: 50px; padding-right: 50px
                    
                    <form method="post" id="myform">
                       <textarea autofocus class="form-control" name="message" id="message" rows="1" style="width: 100%;" placeholder="Message <?php echo $recName; ?>"></textarea>
                       <input type="hidden" name="rec_id" id="rec_id" value="<?php echo $userId; ?>" />
                       <button class="btn btn-primary" type="button" name="send" onclick="sendMessage()" style="margin-top: 5px;">Send</button>
                    </form>
                </div>
            </div>
        </div>

 
        
    </div>


    <script>
         function scrollToBottom() {
            var objDiv = document.getElementById("mainContent");
            objDiv.scrollTop = objDiv.scrollHeight;
            // setTimeout(scrollToBottom, 2000);
        }
        
        
        var input = document.getElementById("message");
        input.addEventListener("keyup", function(event) {
          if (event.keyCode === 13) {
           event.preventDefault();
           sendMessage();
          }
        });
    
       
        
    </script>
    
    
</body>

</html>