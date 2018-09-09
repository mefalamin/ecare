<?php

    include("../../../includes/db_connection.php");


    if(isset($_POST['submit'])){

            $pic=true;

// Check if the form was submitted

    // Check if file was uploaded without errors

    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){

        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

        $filename = $_FILES["photo"]["name"];

        $filetype = $_FILES["photo"]["type"];

        $filesize = $_FILES["photo"]["size"];

        $error = array();
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if(!array_key_exists($ext, $allowed)){
            $pic= "Please select a valid file format";

        }




        // Verify file size - 5MB maximum

        $maxsize = 2 * 1024 * 1024;

        if($filesize > $maxsize)
        {

            $pic.='<br>'.'File size is larger than the allowed limit.';

        }






        if(in_array($filetype, $allowed) && $pic==true){

            // Check whether file exists before uploading it

            $sql = "INSERT INTO details
            (
             name
             ,address
             ,phone
             ,email
            )
            VALUES
            (

             'me' -- name - VARCHAR(50) NOT NULL
             ,'dhaka' -- address - VARCHAR(100) NOT NULL
             ,'018' -- phone - VARCHAR(15) NOT NULL
             ,'x@gmail.com' -- email - VARCHAR(40)
            )";
            $result=mysqli_query($connection,$sql);
            $id=mysqli_insert_id($connection);
            $name = $id.".".$ext;
            move_uploaded_file($_FILES["photo"]["tmp_name"], "doctor/" . $name);

                echo "Your file was uploaded successfully.";



        } else{

           echo $pic;



        }

    } else{

            echo $pic;
    }



}




?>