<?php




    session_start();
    session_unset();
    session_destroy();
    header("location: /project/public/admin/login/login.php");
    exit();



?>