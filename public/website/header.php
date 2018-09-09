<?php
session_start();
$current_file = basename($_SERVER['PHP_SELF']);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>e-Care</title>
    <script type="text/javascript">
      /*  var scrl = "|| Online Hospital and Blood Bank Assist System ||";
        function scrlsts() {
            scrl = scrl.substring(1, scrl.length) + scrl.substring(0, 1);
            document.title = scrl;
            setTimeout("scrlsts()", 300);
        }*/
    </script>
    <link rel="icon" href="images/logo%201.png">
    <link rel="stylesheet prefetch" href="Bootstrap/bootstrap 3.2/bootstrap.min.css">
    <link rel="stylesheet prefetch" href="Bootstrap/bootstrap 3.2/bootstrap-theme.min.css">
    <link rel="stylesheet prefetch" href="Bootstrap/bootstrap 3.2/bootstrapValidator.min.css">

<!--   <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'>
    <link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css'>
-->

    <link rel='stylesheet prefetch' href='Bootstrap/bootstrap-theme.min.css.map'>
    <link rel='stylesheet prefetch' href='Bootstrap/bootstrap.min.css.map'>
    <link rel='stylesheet prefetch' href='Bootstrap/bootstrap-theme.css.map'>
    <link rel='stylesheet prefetch' href='Bootstrap/bootstrap.css.map'>




    <link href="Bootstrap/bootstrap.css" rel="stylesheet">
    <link href="Bootstrap/slidebar.css" rel="stylesheet">
    <link href="../admin/hospital/assets/css/table.css" rel="stylesheet">


    <link href="Bootstrap/layout/styles/error_modal.css" rel="stylesheet" type="text/css" media="all">
    <link href="Bootstrap/layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link href="Bootstrap/layout/styles/login_modal.css" rel="stylesheet" type="text/css" media="all">
    <link href="Bootstrap/layout/styles/divider.css" rel="stylesheet" type="text/css" media="all">
    <link href="Bootstrap/layout/styles/footer.css" rel="stylesheet" type="text/css" media="all">
    <link href="Bootstrap/layout/styles/fontawesome-4.5.0.min.css" rel="stylesheet" type="text/css" media="all">

    <script src="js/jquery-1.11.0.js"></script>
    <script src="Bootstrap/layout/scripts/jquery.min.js"></script>
    <script src="Bootstrap/js/bootstrap.min.js" ></script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <style type="text/css">
        .modal {
            overflow-y: auto;
        }

        .modal-open {
            overflow: auto;
        }

        .modal-open[style] {
            padding-right: 0px !important;
        }
    </style>


</head>
<body  id="top">

<div class="wrapper  row4">
    <div id="topbar" class="hoc clear">

        <?php

            if(isset($_SESSION['uid'])){
                echo '<div class="fl_right">
            <ul class="nospace inline pushright">
                <li class="drop"><i class="label"></i>
                    <span class="glyphicon glyphicon-user"></span>
                    <a href="#">
                        <strong>Hello '.$_SESSION['name'].$_SESSION['uid']. '</strong>

                    </a>
                    <ul>
                        <li><a href="user_profile.php">Profile</a></li>

                        <li><a  href="action.php?logout=true">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>';
            }
        else{
            echo '<div class="fl_right">
                <ul class="inline">
                    <li hidden><i class="label"></i><span class="glyphicon glyphicon-plus-sign"></span> <a href="user_register.php">Sign-Up</a></li>

                    <li><i class="label"></i><span class="glyphicon glyphicon-log-in"></span>  <a href="#login-modal"  data-toggle="modal" data-target="#login-modal">Sign-in</a></li>
                </ul>
            </div>';
        }
        ?>



                    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="loginmodal-container">
                                <h1>Login to Your Account</h1><br>
                                <form id="login_form" method="post">
                                    <input type="text" name="email" placeholder="Email" required>
                                    <input type="password" name="passwd" placeholder="Password" required>
                                    <span style="color: red" id="login_error"></span>
                                    <input type="submit" name="login" class="login loginmodal-submit"  value="Login">
                                </form>

                                <div class="login-help">
                                    <a href="user_register.php">Register</a> - <a href="#">Forgot Password</a>
                                </div>
                            </div>
                        </div>
                    </div>







    </div>
</div>

<div class="wrapper row0">
    <header id="header" class="hoc clear">

        <div id="logo">

            <div class="row" style="padding-left: 250px">

                <div class="col-md-3" style="padding-left: 80px">
                    <img style="width: 120px;height: 65px" src="images/logo%201.png">
                </div>
                <div class="col-md-3" style="padding-right: 25px">
                   <h7 style="font-size: 35pt"><a href="index.php">e-Care</a></h7>
                    <p>find doctor,donor,hospital</p>
                </div>
            </div>

        </div>

    </header>
</div>

<div class="wrapper row6">
    <nav id="mainav" class=" hoc clear">

        <ul class="clear">
            <li class="<?php if($current_file=="index.php") echo "active" ?>"><a href="index.php">Home</a></li>
            <li class="<?php if($current_file=="doctor_search.php") echo "active" ?>"><a class="" href="doctor_search.php">Find Doctor</a></li>
            <li class="<?php if($current_file=="donor_find.php") echo "active" ?>" ><a  class="drop" href="#">Need Blood?</a>
                <ul>
                    <li class="<?php if($current_file=="donor_find.php") echo "active" ?>"><a href="donor_find.php">Search Donor</a></li>

                    <li><a  href="">Search in Blood Banks</a></li>
                </ul>
            </li>
            <li class="<?php if($current_file=="hospital.php" || $current_file=="detail_hospital.php") echo "active" ?>"><a class="" href="hospital.php">HOSPITALS</a>
            </li>


            <li class="<?php if($current_file=="bloodbank.php") echo "active" ?>" ><a class="drop" href="bloodbank.php">BLOOD BANKS</a>
                <ul>
                    <li class="<?php if($current_file=="bloodbank.php") echo "active" ?>" ><a href="bloodbank.php">Blood Banks</a></li>
                    <li ><a href="#">Blood Donation Events</a></li>


                </ul>
            </li>


        </ul>

    </nav>
    </div>


    <br>







