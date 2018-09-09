<style>
    .table_custom{
        text-align: center
    }
    .mymeter{
        width: 200px; height: 20px
    }
    th{
        text-align: center;
        background-color: black;
    }
    td{
        text-align: center;
        color: black;
        padding: 10px;

    }
</style>
<?php
//echo $uid;
$sql="SELECT d.name as doc_name,h.name as h_name,h.address,a.day_of_appointment as app_date,serial,s.room FROM
  appointment a,schedule s,doctor d,hospital h
  WHERE s.hospital_id=h.hospital_id
  AND a.schedule_id=s.schedule_id
  AND d.doctor_id=s.doctor_id
  AND  a.userid={$uid}
  ORDER BY a.day_of_appointment DESC";
    $result=mysqli_query($connection,$sql);
    $count=0;
    if($result){
       $count=mysqli_num_rows($result);
    }

    //echo " ".$count;
?>



<div id="appointment" class="tab-pane fade">
    <br>
    <div class="content">
        <br>
        <div class="row">
            <div class="col-md-5">  </div>

                <div class="header">
                    <h4 class="title">Your Appointments</h4>
                </div>
                <br>
                <br>
        </div>

        <?php
        if($count>0){
            echo '<table>
                    <thead>
                    <th>Appointment Date</th>
                    <th>Doctor</th>
                    <th>Hospital</th>
                    <th>Room</th>
                    <th>Appointment Serial</th>
                    </thead>';

            while($app=mysqli_fetch_assoc($result)){
                echo '<tr>';
                echo '<td>'.date("d-M-Y", strtotime($app['app_date'])).'</td>';
                echo '<td>'.$app['doc_name'].'</td>';
                echo '<td>'.$app['h_name']." , ".$app['address'].'</td>';
                echo '<td>'.$app['serial'].'</td>';
                echo '<td>'.$app['room'].'</td>';
                echo '</tr>';
            }


             echo   '</table>';
        }
        else{
            echo '<div class="col-md-4" ></div>';
            echo '<span style="color: blue"><b>You Have not made any appointment yet</b></span>';
        }
        ?>



    </div>
</div>