
<?php
    session_start();
    if(!isset($_SESSION['bank_id'])){
        header("location:/project/public/admin/login/login.php");
    }
    //echo $_SESSION['admin_id']." ";
  //  echo $_SESSION['bank_id']." ";
  //  echo $_SESSION['owner'];
    $current_file=basename($_SERVER['PHP_SELF']);

?>

<head>

    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/new_logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Admin</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../hospital/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../hospital/assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="../hospital/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <link href="../hospital/assets/css/table.css" rel="stylesheet">

    <link href="../hospital/assets/css/animation.css" rel="stylesheet">



    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../hospital/assets/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <script src="../hospital/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../hospital/assets/modals/jquery.min.js" type="text/javascript"></script>
    <script src="../hospital/assets/modals/bootstrap.min.js" type="text/javascript"></script>

</head>

<body>

<div class="wrapper">
    <div class="sidebar" data-color="red" data-image="assets/img/sideb">

        <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="" class="simple-text">
                    Blood Bank Admin
                </a>
            </div>

            <ul class="nav">
                <li <?php if($current_file=="dashboard.php") echo 'class="active"' ?> >
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li <?php if($current_file=="bank_info.php") echo 'class="active"' ?> >
                    <a href="bank_info.php">
                        <i class="pe-7s-portfolio"></i>
                        <p>Bank info</p>
                    </a>
                </li>

                <li <?php if($current_file=="update_stock.php") echo 'class="active"' ?>  >
                    <a href="update_stock.php">
                        <i class="pe-7s-note2"></i>
                        <p>Blood Stock</p>
                    </a>
                </li>

                <li <?php if($current_file=="add_event.php") echo 'class="active"' ?> >
                    <a href="add_event.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Add Event</p>
                    </a>
                </li>



            </ul>
        </div>
    </div>


    <div class="main-panel">

        <?php
        include 'uppernav.php';
        ?>





