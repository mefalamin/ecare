<?php
//saving the modified version
session_start();
include('../../../includes/db_connection.php');
if (isset($_POST['save'])) {

    //  print_r($_POST);

    $name = $_POST['hospital'];
    $speciality = $_POST['speciality'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $emergency = $_POST['emergency'];
    $fax = $_POST['fax'];
    $description = $_POST['description'];


    $sql = "UPDATE project.hospital
  SET
  admin_id = " . $_SESSION['admin_id'] . " -- admin_id - INT(11) NOT NULL
 ,name = '$name' -- name - VARCHAR(50) NOT NULL
 ,address = '$address' -- address - VARCHAR(255) NOT NULL
 ,speciality = '$speciality' -- speciality - VARCHAR(255) NOT NULL
 ,description = '$description' -- description - TEXT NOT NULL
 ,phone = '$phone' -- phone - VARCHAR(255)
 ,emergency = '$emergency' -- emergency - VARCHAR(255)
 ,fax = '$fax' -- fax - VARCHAR(255)
 ,email = '$email' -- email - VARCHAR(50)
WHERE
  hospital_id = " . $_SESSION['org_id'] . " -- hospital_id - INT(11) NOT NULL";

    $result = mysqli_query($connection, $sql);
    if ($result) {

        header('Location: hospital_section.php?success=true');
    }
    else{
        header('Location: hospital_section.php?fail=true');
    }
    exit();
}


if (isset($_POST['add_doctor'])) {

    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {

        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

        $filename = $_FILES["photo"]["name"];

        $filetype = $_FILES["photo"]["type"];

        $filesize = $_FILES["photo"]["size"];

        $error = array();
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $error = 0;
        if (!array_key_exists($ext, $allowed)) {
            echo "Please select a valid file format";
            $error = 1;

        }


        // Verify file size - 5MB maximum

        $maxsize = 2 * 1024 * 1024;

        if ($filesize > $maxsize) {

            echo 'File size is larger than the allowed limit.';
            header('location: doctor_section.php?error=' . $error);
        }


        if ($error == 0) {

            $name = $_POST['doc_name'];
            $gender = $_POST['doc_gender'];
            $qualification = $_POST['doc_degree'];
            $doc_speciality = $_POST['doc_speciality'];
            $fee = $_POST['fee'];
            $contact = $_POST['contact'];
            $pic = '';
            $sql = "SELECT * from doctor d WHERE d.name='{$name}' AND d.speciality='{$doc_speciality}' AND d.contact='{$contact}'";
            $result = mysqli_query($connection, $sql);
            $count = mysqli_num_rows($result);

            if ($count == 0) {
                $sql = "INSERT INTO project.doctor
                    (

                     name
                     ,speciality
                     ,qualification
                     ,pic
                     ,gender
                     ,contact
                     ,fee
                    )
                    VALUES
                    (

                     '{$name}' -- name - VARCHAR(50) NOT NULL
                     ,'{$doc_speciality}' -- speciality - VARCHAR(255) NOT NULL
                     ,'{$qualification}' -- qualification - TEXT NOT NULL
                     ,'{$pic}' -- pic - VARCHAR(255)
                     ,'{$gender}' -- gender - VARCHAR(255)
                     ,'{$contact}' -- contact_asst - VARCHAR(255)
                    ,'{$fee}' -- fee - VARCHAR(255)
                    )";

                $result = mysqli_query($connection, $sql);

                if ($result) {

                    $doc_id = mysqli_insert_id($connection);
                    $org_id = $_SESSION['org_id'];
                    $sql = "insert into schedule VALUES
                    (
                      Null -- schedule_id - INT(11) NOT NULL
                     ,{$doc_id} -- doctor_id - INT(11) NOT NULL
                     ,{$org_id} -- hospital_id - INT(11) NOT NULL
                     ,'{$contact}' -- doctor_contact - VARCHAR(255)
                     ,'' -- doctor_asst_contact - VARCHAR(255)
                     ,'{$fee}' -- fee - VARCHAR(255)
                     ,'yes' -- availability - VARCHAR(255)
                     ,'' -- sat_aval - VARCHAR(255)
                     ,'' -- sat_from - VARCHAR(255)
                     ,'' -- sat_to - VARCHAR(255)
                     ,0 -- sat_max - INT(11)
                     ,'' -- sun_aval - VARCHAR(255)
                     ,'' -- sun_from - VARCHAR(255)
                     ,'' -- sun_to - VARCHAR(255)
                     ,0 -- sun_max - INT(11)
                     ,'' -- mon_aval - VARCHAR(255)
                     ,'' -- mon_from - VARCHAR(255)
                     ,'' -- mon_to - VARCHAR(255)
                     ,0 -- mon_max - INT(11)
                     ,'' -- tues_aval - VARCHAR(255)
                     ,'' -- tues_from - VARCHAR(255)
                     ,'' -- tues_to - VARCHAR(255)
                     ,0 -- tues_max - INT(11)
                     ,'' -- wed_aval - VARCHAR(255)
                     ,'' -- wed_from - VARCHAR(255)
                     ,'' -- wed_to - VARCHAR(255)
                     ,0 -- wed_max - INT(11)
                     ,'' -- thur_aval - VARCHAR(255)
                     ,'' -- thur_from - VARCHAR(255)
                     ,'' -- thur_to - VARCHAR(255)
                     ,0 -- thur_max - INT(11)
                     ,'' -- fri_aval - VARCHAR(255)
                     ,'' -- fri_from - VARCHAR(255)
                     ,'' -- fri_to - VARCHAR(255)
                     ,0 -- fri_max - INT(11)
                     ,'' -- will_join - VARCHAR(255)
                     ,''
                    )";
                    $result = mysqli_query($connection, $sql);

                    $name = $doc_id . "." . $ext;
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "doctor_pic/" . $name);
                    $sql = "UPDATE doctor SET pic='{$name}' where doctor_id={$doc_id}";
                    mysqli_query($connection, $sql);


                    header('location: doctor_section.php?new_add=true');
                    exit;
                }
            } else {
                header('location: doctor_section.php?duplicate_entry=true');
                exit;
            }


        } else {

            header('location: doctor_section.php?error=' . $error);
            exit;


        }

    } else {

        $error = 3;
        header('location: doctor_section.php?error=' . $error);
        exit;
    }


}


if (isset($_POST['add__from_registered'])) {

    $id = $_POST['id'];
    $id = (int)$id;
    $hospital_id = $_SESSION['org_id'];
    $hospital_id = (int)$hospital_id;
    $contact = $_POST['contact'];

    $sql = "INSERT INTO project.schedule
                    (
                      doctor_id
                     ,hospital_id
                     ,doctor_contact


                    )
                    VALUES
                    (
                      $id -- doctor_id - INT(11) NOT NULL
                     ,$hospital_id -- hospital_id - INT(11) NOT NULL
                    ,'$contact'

                    )";

    $result = mysqli_query($connection, $sql);
    if ($result) {
        header('location: doctor_section.php');
    }
    else{
        header('location: doctor_section.php?is_already=true');
    }
    exit;
}

if (isset($_POST['doc_sp'])) {

    $speciality = $_POST['doc_sp'];
    $sql = "SELECT name FROM doctor where speciality='$speciality' ORDER by name ASC ";
    $result = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option>' . $row['name'] . '</option>';

    }

    exit;

}
//if select button is presssed after chosing
if (isset($_GET['select'])) {

    $name = $_GET['doctors'];
    $speciality = $_GET['doc_sp'];
    $sql = "SELECT doctor_id FROM doctor where name='$name' and speciality='$speciality'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row['doctor_id'];

    header("location: doctor_section.php?id=$id&add=1");

}

?>
<?php
if ((isset($_POST['update']))) {


    $doctor_id = $_POST['doctor_id'];
    $doctor_id = (int)$doctor_id;
    $schedule_id = $_POST['schedule_id'];
    $schedule_id = (int)$schedule_id;
    $doctor_contact = $_POST['doctor_contact'];
    $doctor_asst_contact = $_POST['doctor_asst_contact'];

    $room=$_POST['room'];
    $fee=$_POST['fee'];
    $availability='no';
    $will_join=null;
    if (isset($_POST['availability'])) {

        $availability = 'yes';

    }
    if(!isset($_POST['availability'])){
        $will_join=$_POST['will_join'];
    }


    if (isset($_POST['sat_aval'])) {

        $sat_aval = 'no';
        $sat_from = "";
        $sat_to = "";
        $sat_max = 0;
    } else {

        $sat_aval = 'yes';
        $sat_from = $_POST['sat_from'];
        $sat_to = $_POST['sat_to'];
        $sat_max = $_POST['sat_max'];
        $sat_max = (int)$sat_max;


    }
    if (isset($_POST['sun_aval'])) {

        $sun_aval = 'no';
        $sun_from = "";
        $sun_to = "";
        $sun_max = 0;
    } else {

        $sun_aval = 'yes';
        $sun_from = $_POST['sun_from'];
        $sun_to = $_POST['sun_to'];
        $sun_max = $_POST['sun_max'];
        $sun_max = (int)$sun_max;


    }
    if (isset($_POST['mon_aval'])) {

        $mon_aval = 'no';
        $mon_from = "";
        $mon_to = "";
        $mon_max = 0;
    } else {

        $mon_aval = 'yes';
        $mon_from = $_POST['mon_from'];
        $mon_to = $_POST['mon_to'];
        $mon_max = $_POST['mon_max'];
        $mon_max = (int)$mon_max;


    }
    if (isset($_POST['tues_aval'])) {

        $tues_aval = 'no';
        $tues_from = "";
        $tues_to = "";
        $tues_max = 0;
    } else {

        $tues_aval = 'yes';
        $tues_from = $_POST['tues_from'];
        $tues_to = $_POST['tues_to'];
        $tues_max = $_POST['tues_max'];
        $tues_max = (int)$tues_max;


    }
    if (isset($_POST['wed_aval'])) {

        $wed_aval = 'no';
        $wed_from = "";
        $wed_to = "";
        $wed_max = 0;
    } else {

        $wed_aval = 'yes';
        $wed_from = $_POST['wed_from'];
        $wed_to = $_POST['wed_to'];
        $wed_max = $_POST['wed_max'];
        $wed_max = (int)$wed_max;


    }
    if (isset($_POST['thur_aval'])) {

        $thur_aval = 'no';
        $thur_from = "";
        $thur_to = "";
        $thur_max = 0;
    } else {

        $thur_aval = 'yes';
        $thur_from = $_POST['thur_from'];
        $thur_to = $_POST['thur_to'];
        $thur_max = $_POST['thur_max'];
        $thur_max = (int)$thur_max;


    }

    if (isset($_POST['fri_aval'])) {

        $fri_aval = 'no';
        $fri_from = "";
        $fri_to = "";
        $fri_max = 0;
    } else {

        $fri_aval = 'yes';
        $fri_from = $_POST['fri_from'];
        $fri_to = $_POST['fri_to'];
        $fri_max = $_POST['fri_max'];
        $fri_max = (int)$fri_max;


    }


    $sql = "update schedule set availability='{$availability}'
                             ,doctor_asst_contact='{$doctor_asst_contact}'
                             ,doctor_contact='{$doctor_contact}'
                             ,fee='{$fee}'
                             ,sat_aval='{$sat_aval}'
                             ,sat_from='{$sat_from}'
                             ,sat_to = '{$sat_to}'
                             ,sat_max = '{$sat_max}'
                             ,sun_aval='{$sun_aval}'
                             ,sun_from='{$sun_from}'
                             ,sun_to = '{$sun_to}'
                             ,sun_max = '{$sun_max}'
                             ,mon_aval='{$mon_aval}'
                             ,mon_from='{$mon_from}'
                             ,mon_to = '{$mon_to}'
                             ,mon_max = '{$mon_max}'
                             ,tues_aval='{$tues_aval}'
                             ,tues_from='{$tues_from}'
                             ,tues_to = '{$tues_to}'
                             ,tues_max = '{$tues_max}'
                             ,wed_aval='{$wed_aval}'
                             ,wed_from='{$wed_from}'
                             ,wed_to = '{$wed_to}'
                             ,wed_max = '{$wed_max}'
                             ,thur_aval='{$thur_aval}'
                             ,thur_from='{$thur_from}'
                             ,thur_to = '{$thur_to}'
                             ,thur_max = '{$thur_max}'
                             ,fri_aval='{$fri_aval}'
                             ,fri_from='{$fri_from}'
                             ,fri_to = '{$fri_to}'
                             ,fri_max = '{$fri_max}'
                             ,will_join = '{$will_join}'
                             ,room = '{$room}'
                             where doctor_id=$doctor_id and schedule_id=$schedule_id";

    mysqli_query($connection, $sql);
    echo json_encode(array('success' => true));
    exit;

}

if (isset($_POST['see_list'])) {
    $speciality = $_POST['sp'];
    $org_id = (int)$_POST['org_id'];
    $sql = "SELECT d.name from doctor d,schedule s
            WHERE d.speciality='{$speciality}'
             AND s.hospital_id={$org_id}
             AND d.doctor_id=s.doctor_id
             ORDER BY d.name ";
    $result = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option>' . $row['name'] . '</option>';

    }

    exit;
}


if (isset($_POST['room_set'])) {

    $org_id = (int)$_POST['org_id'];
    $icu_aval = "no";
    $ccu_aval = "no";
    $single_aval = "no";
    $share_aval = "no";
    $male_ward_aval = "no";
    $female_ward_aval = "no";

    if (isset($_POST['icu_check'])) {

        $icu_aval = "yes";
        $icu_quantity =(int)$_POST['icu_quantity'];
        $icu_rate =(int) $_POST['icu_rate'];

    } else {

        $icu_quantity =(int)$_POST['icu_quantity'];
        $icu_rate =(int) $_POST['icu_rate'];
    }

    if (isset($_POST['ccu_check'])) {

        $ccu_aval = "yes";
        $ccu_quantity = (int)$_POST['ccu_quantity'];
        $ccu_rate =(int)$_POST['ccu_rate'];

    } else {

        $ccu_quantity = (int)$_POST['ccu_quantity'];
        $ccu_rate =(int)$_POST['ccu_rate'];
    }
    if (isset($_POST['single_check'])) {

        $single_aval = "yes";
        $single_quantity = (int)$_POST['single_quantity'];
        $single_rate = (int)$_POST['single_rate'];

    } else {

        $single_quantity = (int)$_POST['single_quantity'];
        $single_rate = (int)$_POST['single_rate'];
    }
    if (isset($_POST['share_check'])) {

        $share_aval = "yes";
        $share_quantity =(int)$_POST['share_quantity'];
        $share_rate =(int)$_POST['share_rate'];

    } else {

        $share_quantity =(int)$_POST['share_quantity'];
        $share_rate =(int)$_POST['share_rate'];

    }

    if (isset($_POST['male_ward_check'])) {

        $male_ward_aval = "yes";
        $male_ward_quantity =(int)$_POST['male_ward_quantity'];
        $male_ward_rate = (int)$_POST['male_ward_rate'];

    } else {

        $male_ward_quantity =(int)$_POST['male_ward_quantity'];
        $male_ward_rate = (int)$_POST['male_ward_rate'];
    }

    if (isset($_POST['female_ward_check'])) {

        $female_ward_aval = "yes";
        $female_ward_quantity =(int)$_POST['female_ward_quantity'];
        $female_ward_rate = (int)$_POST['female_ward_rate'];

    } else {

        $female_ward_quantity =(int)$_POST['female_ward_quantity'];
        $female_ward_rate = (int)$_POST['female_ward_rate'];
    }

    $sql = "UPDATE hospitals_room
SET
  icu_aval = '{$icu_aval}' -- icu_aval - VARCHAR(10)
 ,icu_quantity = {$icu_quantity} -- icu_quantity - SMALLINT(6)
 ,icu_rate = {$icu_rate} -- icu_rate - SMALLINT(6)
 ,ccu_aval = '{$ccu_aval}' -- ccu_aval - VARCHAR(10)
 ,ccu_quantity = {$ccu_quantity} -- ccu_quantity - SMALLINT(6)
 ,ccu_rate = {$ccu_rate} -- ccu_rate - SMALLINT(6)
 ,single_aval = '{$single_aval}' -- single_aval - VARCHAR(10)
 ,single_quantity = {$single_quantity} -- single_quantity - SMALLINT(6)
 ,single_rate = {$single_rate} -- single_rate - SMALLINT(6)
 ,share_aval = '{$share_aval}' -- share_aval - VARCHAR(10)
 ,share_quantity = {$share_quantity} -- share_quantity - SMALLINT(6)
 ,share_rate = {$share_rate} -- share_rate - SMALLINT(6)
 ,male_ward_aval = '{$male_ward_aval}' -- male_ward_aval - VARCHAR(10)
 ,male_ward_quantity = {$male_ward_quantity} -- male_ward_quantity - SMALLINT(6)
 ,male_ward_rate = {$male_ward_rate} -- male_ward_rate - SMALLINT(6)
 ,female_ward_aval = '{$female_ward_aval}' -- female_ward_aval - VARCHAR(10)
 ,female_ward_quantity = {$female_ward_quantity} -- female_ward_quantity - SMALLINT(6)
 ,female_ward_rate = {$female_ward_rate} -- female_ward_rate - SMALLINT(6)
WHERE
  hospital_id={$org_id} ";
    $result= mysqli_query($connection,$sql);
    $count=mysqli_affected_rows($connection);

    if($count==1){
        echo json_encode("updated");
    }
    else{
        echo json_encode("failed");
    }

}

?>
