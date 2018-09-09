<?php


include '../../../includes/db_connection.php';


    if(isset($_POST['bank_update'])){

        $bid=(int)$_POST['bank_id'];
        $name=$_POST['name'];
        $adress=$_POST['address'];
        $email=$_POST['contact'];
        $contact=$_POST['email'];

        $sql=" UPDATE blood_bank
                SET

                 name = '{$name}' -- name - VARCHAR(100) NOT NULL
                 ,address = '{$adress}' -- address - VARCHAR(255)
                 ,phone = '{$contact}' -- phone - VARCHAR(255)
                 ,email = '{$email}' -- email - VARCHAR(50)

                WHERE
                  blood_bank_id = {$bid} -- blood_bank_id - INT(11) NOT NULL
                 ";
        mysqli_query($connection,$sql);
        $affected=mysqli_affected_rows($connection);
        if($affected==1){
            echo json_encode("updated");

        }
        else{
            echo json_encode("failed");
        }



    }




?>