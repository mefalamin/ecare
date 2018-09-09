<?php

include("../../includes/db_connection.php");
if(isset($_POST['get_option'])){
    $district = $_POST['get_option'];



    $query = "SELECT id FROM district where name='$district' limit 1";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $did = $row["id"];



    $query = "SELECT sub_thana FROM subdistrict_thana where id='$did' ORDER BY sub_thana asc";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option>" . $row['sub_thana'] . "</option>";

    }

    exit;
}

session_start();
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['passwd'];
    $sql = "SELECT * from user where email ='$email'";
    $run = mysqli_query($connection,$sql);
    confirm_query($run);
    $count = mysqli_num_rows($run);
    $row = mysqli_fetch_array($run);
    $hash = $row['passwd'];

    if ($count > 0) {
        if(password_verify($password,$hash)) {

            $_SESSION["uid"] = $row["userid"];
            $_SESSION["name"] = $row["first_name"];
            echo json_encode("true");



        }
        else{
            echo json_encode("fail");
            exit;
        }

    }
    else{
        echo json_encode("fail");
        exit;
    }


}



if(isset($_POST['check_schedule'])){



    $data = array();
    $data['sid'] = $_POST['sid'];
    $data['sid']=(int)$data['sid'];
    $data['date'] = $_POST['app_date'];
    $data['max_day'] =$_POST['day_max'];

    $sql = "SELECT {$data['max_day']} as max_patient from schedule WHERE schedule_id={$data['sid']} ";
    $result=mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($result);
    $max = $row['max_patient'];



    $sql = "SELECT COUNT(*) AS count FROM appointment WHERE day_of_appointment= '{$data['date']}' AND schedule_id={$data['sid']}";
    $result=mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($result);
    $count=$row['count'];
    $count=(int)$count;
    $max=(int)$max;

    $data_res = array();
    $data_res['count'] = $count;
    $data_res['max'] = $max;

    if($count>=$max){
        echo json_encode("full");

    }
    else{
        echo json_encode("slot");

    }






    exit;
}


if(isset($_POST['profile'])){

    $uid =$_POST['uid'];
    $uid = (int)$uid;
    $sql = "SELECT first_name,last_name,cell from user WHERE userid={$uid}";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['first_name']." ".$row['last_name'];
    $cell = $row['cell'];
    $data = array();
    $data['name'] = $name;
    $data['cell'] = $cell;
    echo json_encode($data);
}


if(isset($_POST['appointment'])){


    $patient_name = $_POST['name'];
    $dob = $_POST['dob'];
    $app_date = $_POST['app_date'];
    $contact = $_POST['contact'];
    $sid = $_POST['sid'];
    $sid =(int)$sid;
    $uid = $_POST['uid'];
    $uid = (int)$uid;
    $max = $_POST['max'];

    $asthma="no";
    $cardiac="no";
    $kidney="no";
    $diabetes="no";
    $hyperlipidaemia="no";
    $hypertension ="no";

    if(isset($_POST['asthma'])) {
        $asthma = "yes";
    }
    if(isset($_POST['cardiac'])) {
        $cardiac = "yes";
    }
    if(isset($_POST['chronic_kidney'])) {
        $kidney= "yes";
    }
    if(isset($_POST['diabetes'])) {
        $diabetes= "yes";
    }
    if(isset($_POST['hyperlipidaemia'])) {
        $hyperlipidaemia= "yes";
    }
    if(isset($_POST['hypertension'])) {
        $hypertension="yes";
    }


    /*$sql = "SELECT {$max} as max_pat from schedule WHERE schedule_id={$sid}";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($result);
    $maximum = $row['max_pat'];
    $maximum = (int)$maximum;*/
    $sql = "SELECT COUNT(*) AS count FROM appointment WHERE schedule_id={$sid} AND day_of_appointment='{$app_date}'";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($result);
    $count=$row['count'];
    $count =(int)$count;
    $count++;
    $app_id =app_id_maker($sid,$app_date,$count);
    $app_id=(int)$app_id;

    $sql="INSERT INTO appointment
(
                  appoint_id
                 ,schedule_id
                 ,userid
                 ,patient_name
                 ,day_of_appointment
                 ,time_of_creation
                 ,dob
                 ,contact
                 ,asthma
                 ,cardiac_failure
                 ,kidney_disease
                 ,diabetes
                 ,hyperlipidaemia
                 ,hypertension
                 ,serial

                )
                VALUES
                (
                  {$app_id} -- appoint_id - BIGINT(20) NOT NULL
                 ,{$sid} -- schedule_id - INT(11) NOT NULL
                 ,{$uid} -- userid - INT(11) NOT NULL
                 ,'{$patient_name}' -- patient_name - VARCHAR(50)
                 ,'{$app_date}' -- day_of_appointment - DATE
                 ,NOW() -- time_of_creation - TIMESTAMP NOT NULL
                 ,'{$dob}' -- dob - DATE
                 ,'$contact' -- contact - VARCHAR(255)
                 ,'$asthma' -- asthma - VARCHAR(255)
                 ,'$cardiac' -- cardiac_failure - VARCHAR(255)
                 ,'$kidney' -- kidney_disease - VARCHAR(255)
                 ,'$diabetes' -- diabetes - VARCHAR(255)
                 ,'$hyperlipidaemia' -- hyperlipidaemia - VARCHAR(255)
                 ,'$hypertension' -- hypertension - VARCHAR(255)
                 ,'{$count}'
                );";

    mysqli_query($connection,$sql);
    $affected=mysqli_affected_rows($connection);
    $app_data = array();
    $app_data['affected']=$affected;
    $app_data['serial']=$count;
    echo json_encode($app_data);




}


function app_id_maker($sid,$date,$counter){

    $final_id =  str_replace("-", "", $date).$sid.$counter;
    $final_id = substr($final_id, 2);
    return $final_id;
}


if(isset($_POST['sign_up'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $passwd = $_POST['psw'];
    $hashed_password = password_hash($passwd, PASSWORD_DEFAULT);
    $mobile = $_POST['mobile'];

    if ($_POST['rdonor'] == "yes") {

        $dob = $_POST['dob'];
        $blood_grp = $_POST['bloodgroup'];
        $location = $_POST['address'];
        $district = $_POST['district'];
        $sub = $_POST['sub_district'];
        $last_donated=$_POST['last_donated'];
    } else {
        $dob = "";
        $blood_grp = "";
        $location = "";
        $district = "";
        $sub = "";
        $last_donated="";

    }


    $check_email = $connection->query("SELECT email FROM user WHERE email='$email'");
    $count = $check_email->num_rows;

    if ($count == 0) {

        $insert=("INSERT INTO user (first_name,last_name,email,cell,passwd) VALUES('$first_name','$last_name','$email','$mobile','$hashed_password')");
        $result = mysqli_query($connection,$insert);


        if ($result) {


            if($_POST['rdonor']=="yes"){


                $select = "select userid from user where email='$email'";
                $result = mysqli_query($connection,$select);
                $row = mysqli_fetch_assoc($result);
                $id = $row['userid'];
                $insert ="INSERT INTO project.donor
                                (
                                  donor_id
                                 ,date_of_dirth
                                 ,blood_group
                                 ,last_donated
                                 ,thana_sub
                                 ,district
                                 ,location
                                 ,realtime_location
                                 ,`last updated`
                                )
                                VALUES
                                (
                                  '$id' -- donor_id - INT(11) NOT NULL
                                 ,'$dob' -- date_of_dirth - VARCHAR(30) NOT NULL
                                 ,'$blood_grp' -- blood_group - VARCHAR(10) NOT NULL
                                 ,'$last_donated' -- last_donated - VARCHAR(30) NOT NULL
                                 ,'$sub' -- thana - VARCHAR(255)
                                 ,'$district' -- district - VARCHAR(255)
                                 ,'$location' -- geolocation - VARCHAR(255)
                                 ,'' -- realtime_location - VARCHAR(255)
                                 ,'' -- last updated - VARCHAR(30)
                                )";
                $exec=mysqli_query($connection,$insert);


            }




            echo "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered :) Redirecting !
     </div>";
            header( "refresh:4;url=index.php" );

        } else {

            echo "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Something went wrong :(...Try again !
    </div>";

            header( "refresh:4;url=user.php" );
        }



    }
    else
    {

        echo "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Email is already registered...Try with new!
    </div>";

        header( "refresh:4;url=user.php" );

    }


}


if(isset($_GET['logout'])){
    session_start();
    session_unset();
    session_destroy();
    /*unset($_SESSION["uid"]);
    unset($_SESSION["name"]);*/
    header("location:index.php");
    exit();
}

/*
if(isset($_POST['search_doctor'])){
    $doc_sp=$_POST['doc_sp'];

$query = "SELECT * FROM project.doctor where speciality='$doc_sp' order by name;";
$result = mysqli_query($connection, $query);
$count_row = mysqli_num_rows($result);


while ($row=mysqli_fetch_assoc($result)){


    $string='<br><br>';

    $string.='<div class="row">';
    $string.='<div class="col-md-3 text-left" style="border-right: 1px solid #404040;height: 170px;" >
    <img style="width:150px;height:150px;border-radius: 70%;" src="../admin/hospital/doctor_pic/'.$row['pic'].'" >
    </div>';

    $string.=  '<div class="col-md-6 text-left" style="border-right: 1px solid #404040;height: 170px;">';
    $string= '<p id="a" style="color:#001a00;font-size: 25px;"><b>'.$row['name'].'</b>'.'</p>';

    $string.= '<p class="u-amount " style="color: #005ce6;font-family:consolas;font-size: 19px; " >';
    $string.= '<span class="glyphicon glyphicon-info-sign"></span>';
    $string.= '<b>'.$row['speciality'].'</p>';
    $string.='<p style="color:#001a00 ;font-family: consolas;font-size: 16px;">'.$row['qualification'].'</p>';

    $string.='<br>';
    $string.= '<p></p>';
    $string.= '</div>';
    $string.= '<br>';


    $string.= '<div class="col-md-3 text-left">';

    $string.= '<p class="u-amount " style="font-size=6px; ">';
    $string.= '<span class="glyphicon glyphicon-earphone "></span> '.$row['contact'].'</p>';

    $string.= '<p><span class="glyphicon glyphicon-hand-right "></span><b>Fees</b></p>';
    $string.= '<p>Tk.'.$row['fee'].'</p>';
    $string.= '<button class="btn-info pull-right" data-toggle="modal" data-target="#schedule_modal"';
    $string.= 'data-id="'.$row['doctor_id'].'">';
    $string.= 'Chambers & Schedule';
    $string.= '</button>';

    $string.= '</div>';
    $string.= '</div>';
    $string.= '<hr style="height:2px;border:none;color:#cccccc;background-color:#cccccc;">';
    $string.= '<br>';


}
    echo $string;
    die();


}*/

if(isset($_POST['booking_check'])){


    $uid=$_POST['uid'];
    $sql="SELECT COUNT(*) AS count FROM booking b WHERE b.userid={$uid} AND b.status='processing' ";
    $result=mysqli_query($connection,$sql);
    $row=mysqli_fetch_assoc($result);
    $count=$row['count'];
    echo json_encode($count);



}

if(isset($_POST['booking'])){
    $name=$_POST['pat_name'];
    $age=$_POST['pat_age'];
    $contact=$_POST['pat_contact'];
    $category = $_POST['booking_cat'];
    $hid=$_POST['hid'];
    $uid = $_POST['uid'];
    $reason = $_POST['reason'];

    $sql="INSERT INTO booking
(
 userid
 ,hospital_id
 ,patient_name
 ,age
 ,category
 ,contact
 ,time_of_booking
 ,reason_of_booking
 ,status
)
VALUES
(
 {$uid} -- userid - INT(11) NOT NULL
 ,{$hid} -- hospital_id - INT(11) NOT NULL
 ,'{$name}' -- patient_name - VARCHAR(50)
 ,'{$age}' -- age - VARCHAR(25)
 ,'{$category}' -- category - VARCHAR(50) NOT NULL
 ,'{$contact}' -- contact - VARCHAR(255)
 ,NOW() -- time_of_booking - TIMESTAMP
 ,'{$reason}' -- reason_of_booking - VARCHAR(255)
 ,'New Request' -- status - VARCHAR(50)
)";
    mysqli_query($connection,$sql);
    $affected=mysqli_affected_rows($connection);

    if($affected==1){
       echo json_encode("booked");
    }
    else{
      echo  json_encode("failed");
    }
}

if(isset($_POST['edit'])){

    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $uid=(int)$_POST['uid'];
    $sql="UPDATE user
                  SET
          first_name = '{$fname}' -- first_name - VARCHAR(25) NOT NULL
         ,last_name = '{$lname}' -- last_name - VARCHAR(25) NOT NULL

        WHERE
          userid = {$uid} -- userid - INT(11) NOT NULL";

    mysqli_query($connection,$sql);
    $saved=mysqli_affected_rows($connection);
    if($saved){
        echo json_encode("updated");
    }
    else{
        echo json_encode("failed");
    }

}
if(isset($_POST['pass_change'])){

    $current=$_POST['current'];
    $new=$_POST['new'];
    $uid=(int)$_POST['uid'];
    $sql="SELECT passwd from user WHERE userid={$uid}";
    $result=mysqli_query($connection,$sql);
    $row=mysqli_fetch_assoc($result);
    if(password_verify($current,$row['passwd'])){

        $hashed_password=password_hash($new, PASSWORD_DEFAULT);
        $sql="UPDATE user SET passwd='{$hashed_password}' WHERE userid={$uid}";
        mysqli_query($connection,$sql);
        if(mysqli_affected_rows($connection)){
            echo json_encode("success");
            exit();
        }
        else{
            echo json_encode("fail");
            exit();
        }

    }
    else{
        echo json_encode("mismatched");
        exit();
    }


}


if(isset($_POST['upload'])) {

    $uid=$_POST['uid'];

    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {

        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

        $filename = $_FILES["photo"]["name"];

        $filetype = $_FILES["photo"]["type"];

        $filesize = $_FILES["photo"]["size"];


        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $error = 0;
        if (!array_key_exists($ext, $allowed)) {

            $error=1;
            header('location: doctor_section.php?error=1');

        }


        // Verify file size - 5MB maximum

        $maxsize = 1 * 1024 * 1024;

        if ($filesize > $maxsize) {

            $error=2;
            //echo 'File size is larger than the allowed limit.';
            header('location: doctor_section.php?error=2');
        }
    }
    if($error==0){
        $name = $uid.".".$ext;
        move_uploaded_file($_FILES["photo"]["tmp_name"], "user_profile/user_pic/" . $name);
        $sql="UPDATE user SET pic='{$name}' WHERE userid={$uid}";
        mysqli_query($connection,$sql);
        if(mysqli_affected_rows($connection)){
            mysqli_close($connection);
            header('location: user_profile.php?upload=true');
        }
        else{
            header('location: user_profile.php?upload=false');
        }

    }

}

if(isset($_POST['donor_update'])){
    $become=$_POST['become'];
    $dob=$_POST['dob'];
    $bloodgroup=$_POST['bloodgroup'];
    $address=$_POST['address'];
    $district=$_POST['district'];
    $area=$_POST['sub_district'];
    $last_donated=$_POST['last_donated'];
    $uid=$_POST['uid'];

    if($become=="0"){
        $sql="UPDATE donor
                SET
                  date_of_birth = '{$dob}' -- date_of_birth - VARCHAR(30) NOT NULL
                 ,blood_group = '{$bloodgroup}' -- blood_group - VARCHAR(10) NOT NULL
                 ,district = '{$district}' -- district - VARCHAR(50)
                 ,last_donated = '{$last_donated}' -- last_donated - DATE NOT NULL
                 ,area = '{$area}' -- area - VARCHAR(255)
                 ,lat = 0 -- lat - FLOAT(10, 6)
                 ,lng = 0 -- lng - FLOAT(10, 6)
                WHERE
                  userid = {$uid} -- userid - INT(11) NOT NULL";
    }
    if($become=="1"){
         $sql="INSERT INTO donor
(
              userid
             ,date_of_birth
             ,blood_group
             ,district
             ,last_donated
             ,area
             ,lat
             ,lng
            )
            VALUES
            (

              {$uid} -- userid - INT(11) NOT NULL
             ,'{$dob}' -- date_of_birth - VARCHAR(30) NOT NULL
             ,'{$bloodgroup}' -- blood_group - VARCHAR(10) NOT NULL
             ,'{$district}' -- district - VARCHAR(50)
             ,'{$last_donated}' -- last_donated - DATE
             ,'{$area}' -- area - VARCHAR(255)
             ,0 -- lat - FLOAT(10, 6)
             ,0 -- lng - FLOAT(10, 6)
            );";
    }
    mysqli_query($connection,$sql);
    $affected=mysqli_affected_rows($connection);
    if($affected==1 && $become=="0"){
        echo json_encode("updated");
        exit;
    }
    elseif($affected==1 && $become=="1"){
        echo json_encode("congratz");
        exit;
    }

}

mysqli_close($connection);

?>