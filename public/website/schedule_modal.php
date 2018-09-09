
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>

    <!-- Bootstrap Core CSS -->

    <link href="../admin/hospital/assets/css/table.css" rel="stylesheet">
    <style>
        .button {
            line-height: 1;
            display: inline-block;
            font-size: 1.2rem;
            text-decoration: none;
            border-radius: 5px;
            color: #1DC7EA;
            padding: 6px;
            background-color: #0e0e0e;
            font-size: inherit;
        }

    </style>

</head>
<body>


<?php
include("../../includes/db_connection.php");
        if(isset($_GET['id'])){

            $id = $_GET['id'];
            $id=(int)$id;
            $sql = "SELECT
                      d.name AS doc_name,
                      h.name AS h_name,
                      h.address AS address,
                      s.doctor_asst_contact AS asst,
                      s.schedule_id AS s_id,
                      d.speciality AS sp,
                      d.qualification AS q,
                      s.availability,
                      s.will_join,
                      s.sat_aval,
                      s.sat_from,
                      s.sat_to,
                      s.sat_max,
                      s.sun_aval,
                      s.sun_from,
                      s.sun_to,
                      s.sun_max,
                      s.mon_aval,
                      s.mon_from,
                      s.mon_to,
                      s.mon_max,
                      s.tues_aval,
                      s.tues_from,
                      s.tues_to,
                      s.tues_max,
                      s.wed_aval,
                      s.wed_from,
                      s.wed_to,
                      s.wed_max,
                      s.thur_aval,
                      s.thur_from,
                      s.thur_to,
                      s.thur_max,
                      s.fri_aval,
                      s.fri_from,
                      s.fri_to,
                      s.fri_max


                      FROM hospital h, schedule s,doctor d
                      WHERE
                      s.doctor_id={$id} AND
                      h.hospital_id=s.hospital_id AND
                      d.doctor_id=s.doctor_id";
            if(isset($_GET['this_hid_only'])){
                $hid=(int)$_GET['hid'];
                $sql="SELECT
                      d.name AS doc_name,
                      h.name AS h_name,
                      h.address AS address,
                      s.doctor_asst_contact AS asst,
                      s.schedule_id AS s_id,
                      d.speciality AS sp,
                      d.qualification AS q,
                      s.availability,
                      s.will_join,
                      s.sat_aval,
                      s.sat_from,
                      s.sat_to,
                      s.sat_max,
                      s.sun_aval,
                      s.sun_from,
                      s.sun_to,
                      s.sun_max,
                      s.mon_aval,
                      s.mon_from,
                      s.mon_to,
                      s.mon_max,
                      s.tues_aval,
                      s.tues_from,
                      s.tues_to,
                      s.tues_max,
                      s.wed_aval,
                      s.wed_from,
                      s.wed_to,
                      s.wed_max,
                      s.thur_aval,
                      s.thur_from,
                      s.thur_to,
                      s.thur_max,
                      s.fri_aval,
                      s.fri_from,
                      s.fri_to,
                      s.fri_max,



                      FROM hospital h, schedule s,doctor d
                      WHERE
                      s.doctor_id={$id} AND
                      s.hospital_id={$hid} AND
                      h.hospital_id=s.hospital_id AND
                      d.doctor_id=s.doctor_id";
            }
            $doc=mysqli_query($connection,$sql);
            $doc_name = mysqli_fetch_assoc($doc);
            $result=mysqli_query($connection,$sql);
            $count=mysqli_num_rows($result);




?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="memberModalLabel" align="center"><?php echo $doc_name['doc_name'].'<br>'.$doc_name['sp']; ?></h4>
</div>
<div class="dash">

    <div class="modal-body">

        <?php
        while($row = mysqli_fetch_assoc($result)){

            $table=true;
        if($row['availability']=="no" && $row['will_join']==null){
            $table=false;

        }
            ?>

        <div class="row" align="center">

            <label><?php echo $row['h_name'].'<br>'.$row['address'] ?></label>
            <br>
            <span style="color: #005580; font-size: medium"><?php if(!$table) echo "Sorry No Schedule Found for this Hospital" ?></span>
        </div>



        <table id="gradient-style" <?php if($table==false) echo "hidden" ?> >







    </div>

    <thead>

        <th rowspan="2" style="text-align: center"><b>Day</b></th>
        <th colspan="2" style="text-align: center"><b>Time</b></th>

    <tr>
        <th style="text-align: center">From</th>
        <th style="text-align: center">To</th>

    </tr>
    </thead>


    <?php
    if($row['sat_aval']=="yes"){
        echo '<tr>';
        echo '<td>sat</td>';
        echo '<td style="text-align: center">'.date("g:i a", strtotime($row['sat_from'])).'</td>';
        echo '<td style="text-align: center">'.date("g:i a", strtotime($row['sat_to'])).'</td>';
    }

    ?>

    <?php
    if($row['sun_aval']=="yes"){
        echo '<tr>';
        echo '<td>sun</td>';
        echo '<td style="text-align: center">'.date("g:i a", strtotime($row['sun_from'])).'</td>';
        echo '<td style="text-align: center">'.date("g:i a", strtotime($row['sun_to'])).'</td>';
    }

    ?>

    <?php
        if($row['mon_aval']=="yes"){
            echo '<tr>';
            echo '<td>Mon</td>';
            echo '<td style="text-align: center">'.date("g:i a", strtotime($row['mon_from'])).'</td>';
            echo '<td style="text-align: center">'.date("g:i a", strtotime($row['mon_to'])).'</td>';
        }

    ?>


    <?php
    if($row['tues_aval']=="yes"){
        echo '<tr>';
        echo '<td>tues</td>';
        echo '<td style="text-align: center">'.date("g:i a", strtotime($row['tues_from'])).'</td>';
        echo '<td style="text-align: center">'.date("g:i a", strtotime($row['tues_to'])).'</td>';
    }

    ?>

    <?php
    if($row['wed_aval']=="yes"){
        echo '<tr>';
        echo '<td>wed</td>';
        echo '<td style="text-align: center">'.date("g:i a", strtotime($row['wed_from'])).'</td>';
        echo '<td style="text-align: center">'.date("g:i a", strtotime($row['wed_to'])).'</td>';
    }

    ?>

    <?php
    if($row['thur_aval']=="yes"){
        echo '<tr>';
        echo '<td>thur</td>';
        echo '<td style="text-align: center">'.date("g:i a", strtotime($row['thur_from'])).'</td>';
        echo '<td style="text-align: center">'.date("g:i a", strtotime($row['thur_to'])).'</td>';
    }

    ?>

    <?php
    if($row['fri_aval']=="yes"){
        echo '<tr>';
        echo '<td>fri</td>';
        echo '<td style="text-align: center">'.date("g:i a", strtotime($row['fri_from'])).'</td>';
        echo '<td style="text-align: center">'.date("g:i a", strtotime($row['fri_to'])).'</td>';
    }

    ?>

        </table>

    <div class="row" align="center">
        <button class="button" style="display: <?php
        if($table==false){
            echo "none";
        }
        ?>"
                onclick=window.open('appointment.php?<?php echo "sid=".$row['s_id']; ?>','_blank')>Take Appointment</button>

    </div>



        <br>
        <br>

       <?php } ?>

    </div>


<?php




}
?>

    <div class="modal-footer">


        <button type="button" class="btn btn-default" data-dismiss="modal"">Close</button>
    </div>

</body>

</html>