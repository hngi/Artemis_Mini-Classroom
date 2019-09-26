<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569387265/team%20artemis/Artemis_logo2_dp6b6u.png" sizes="16x16" type="image/png">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/teachers-dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/942fa82be2.js"></script>

</head>

<body>
<?php include('teacher-header.php'); ?>

    <div class="wrapper">
        <div class="db-box">
            <div class="class-header">
                <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569397784/team%20artemis/Layer_x0020_1_e8xcik.svg" class="icons" alt="class">
                <div class="content-header">
                    <h4>CLASSES</h4>
                </div>
            </div>
            <div class="content">
                <table>
                    <tr>
                        <td>
                            <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569420810/team%20artemis/Ellipse_2_etowzs.png" class="medium" alt="">
                        </td>
                        <td>
                            <h5>CLASS NAME</h5>
                            <p>0 courses Available</p>
                        </td>
                        <td style="padding-left:14%">
                            <a href="#"> <i class="fa fa-edit fa-lg edit"></i></a>

                        </td>
                    </tr>
                </table>
            </div>

        </div>
        <div class="db-box">
            <div class="students-header">
                <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569397785/team%20artemis/Students_2_i5xq84.svg" class="icons" alt="class">
                <div class="content-header">
                    <h4>STUDENTS</h4>
                </div>
            </div>
            <div class="content">
                <table>
                    <tr>
                        <td>
                            <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569420810/team%20artemis/Ellipse_2_etowzs.png" class="medium" alt="">
                        </td>
                        <td class="center">
                            <h5>CLASS NAME</h5>
                            <p>0 students Enrolled</p>

                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="db-box ">

            <div class="assignment-header">
                <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569397784/team%20artemis/Layer_x0020_1_e8xcik.svg" class="icons" alt="class">
                <div class="content-header">
                    <h4>ASSIGNMENT</h4>
                </div>
            </div>
            <div class="content">
                <table>
                    <tr>
                        <td>
                            <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569420810/team%20artemis/Ellipse_2_etowzs.png" class="medium" alt="">


                        </td>


                        <td>
                            <h5>CLASS NAME</h5>
                            <p>0 assignments </p>


                        </td>
                        <td style="padding-left:25%">
                            <a href="#"><i class="fa fa-upload fa-lg edit" aria-hidden="true"></i></a>


                        </td>
                    </tr>
                </table>


            </div>



        </div>
        <div class="db-box">

            <div class="c-class-header">
                <img src="https://res.cloudinary.com/oluwamayowaf/image/upload/v1569397784/team%20artemis/Layer_x0020_1_s6rnnd.png" class="icons small" alt="class">
                <div class="content-header">
                    <h4> CREATE CLASS</h4>
                </div>
            </div>
            <div class="content">
                <h5>Create Class Form</h5>
                <p>

                    Adding Content to a site has never been this easy and rewarding, click on the button below to create a class!

                </p>

                <div class="create-btn">
                    <button><a href="createclass.html">Create CLass</a></button>

                </div>
            </div>
        </div>

        <footer>
        </footer>
        <script src="js/header.js"></script>


</body>

</html>