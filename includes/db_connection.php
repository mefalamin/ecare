<?php


define("DB_SERVER","localhost");
define("DB_USER" , "root");
define("DB_PASS","secret");
define("DB_NAME","project");

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if(mysqli_connect_error()){
    die("Database Connection failed".mysqli_connect_error()." ".mysqli_connect_errno()." ");
}


function confirm_query($result_set){

    if(!$result_set){
        die("Database query failed");
    }
}




?>