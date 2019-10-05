<style>
.badge{
    background: #E72E55;
    padding: 5px;
    color: white;
    border-radius: 5px;
    font-size: 12px;
    font-weight: bold;
}
</style>
<script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
<script>
    function countInbox() {
        $.post('functions/count_inbox.php', {
        },
        function(data){
            $('#inboxResult').html(data);
        });   
        setTimeout(countInbox, 2000);
    }
    countInbox();
</script>



<div class="header">
        <header class="dash-header">
            <div class="dash-logo">
                <a href=""><img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569396996/Artemis_wh3le6.svg"></a>
            </div>

            <div class="dash-profile">
                <span class="name">
                    <div id="username">
                        <p>Hi!</p>
                        <h1><?php echo $_SESSION["fullname"]; ?> </h1>
                    </div>
              
            </span>
                <span class="image-container" style="display:none">
              <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1568767225/Team%20Heroes%20Log%20In/Vector_x5kb7p.png" id="image">
               <div class="drop-down">
                  <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569485655/team%20artemis/arrow_ltdhmt.png" id="arrow">
                  <ul id="nav-menu">
                    <li><a href="#">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                  </ul>  
               </div>
               
            </span>
            </div>
        </header>

        <div class="extra-bg">
            <div class="topnav" id="myTopnav">
                <a href="students-dashboard.php">Dashboard</a>
                <a href="students_enrolments.php">My Classes</a>
                <a href="students_class_list.php">Class List</a>
                <a href="show_users.php">Search Users</a>
                <a href="inbox.php">Inbox <span id="inboxResult"></span> </a>
                <a href="logout.php">Logout</a>
                
                <a href="javascript:void(0);" class="icon" onclick="showMenu()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>




        </div>

    </div>


<!--<div class="header">-->
<!--        <header class="dash-header">-->
<!--            <div class="dash-logo">-->
<!--                <a href=""><img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569396996/Artemis_wh3le6.svg"></a>-->
<!--            </div>-->

<!--            <div class="dash-profile">-->
<!--                <span class="name">-->
<!--                  <p>Welcome</p>-->
<!--                  <h1></h1>-->
<!--                </span>-->
<!--                <span class="image-container">-->
<!--                  <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1568767225/Team%20Heroes%20Log%20In/Vector_x5kb7p.png" id="image">-->
<!--                   <div class="drop-down">-->
<!--                      <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569485655/team%20artemis/arrow_ltdhmt.png" id="arrow">-->
<!--                      <ul id="nav-menu">-->
<!--                        <li><a href="#">Home</a></li>-->
<!--                        <li><a href="">Profile</a></li>-->
<!--                        <li><a href="">Logout</a></li>-->
<!--                      </ul>  -->
<!--                   </div>-->
                   
<!--                </span>-->
<!--            </div>-->
<!--        </header>-->

<!--        <div class="extra-bg">-->
<!--            <i class="fa fa-bars" id="mb-nav-icon"></i>-->



<!--        </div>-->

<!--    </div>-->