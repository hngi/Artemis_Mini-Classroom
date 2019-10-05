<?php
session_start();
include('functions/connection.php');
$con = connect();

if( (!isset($_SESSION["userId"])) && (!isset($_SESSION["role"])) ){
    header('Location:signin.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inbox</title>
    <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="style/classList.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/942fa82be2.js"></script>
    <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
     
    <script>
        function searchClass() {
                
                var loading = document.getElementById('loading');
                var mainContent = document.getElementById('mainContent');
                loading.style.display = 'inline';
                
                var searchTerm = $('#searchTerm').val();
                
                $.post('functions/search_class.php', {
                    searchTerm: searchTerm
                },
                function(data){
                    loading.style.display = 'none';
                    mainContent.style.display = 'none';
                    $('#result').html(data);
                });            
        }
    </script>

    <script>
        function reloadInbox() {
            $.post('functions/load_inbox.php', {
            },
            function(data){
                $('#reloadInboxResult').html(data);
            });   
            setTimeout(reloadInbox, 2000);
        }
        reloadInbox();
    </script>

    <style>
        .user{
            margin: 10px;
            padding: 5px;
        }

        .user a{
            text-decoration: none;
            padding: 10px;
        }

        .user a:hover{
            background: #ccc;
        }
    </style>
    
</head>

<body>
    <?php
        if($_SESSION["role"] == "student") {
            include('fragments/students_header.php'); 
        } else if($_SESSION["role"] == "teacher") {
            include('fragments/teachers_header.php'); 
        }
       
    ?>
    <div id="main">
        <section>
            <?php
                if(isset($response)) {
                    echo $response;
                }
            ?>
            
            <div option-nav>
                <h4 style="float:left;">
                    Your Inbox
                </h4>
                
                <h4></h4>
            </div>
            
            <div id="result"></div>
            
        <div id="mainContent">
            <div id = "reloadInboxResult"></div>
        </div>
            
        </section>
    </div>
    <div class ="vertical-space">

    </div>
    <footer>

    </footer>
    <script src="js/classList.js"></script>
    <script src="js/header.js"></script>
</body>

</html>