



<form method="get" action="">

    <div class="row">
           <div class="col-md-3">
               <label>Department</label>
               <select class="form-control" name="doc_sp"
                       id="doc_sp" onchange="fetch_doctor(this.value)">

                   <?php
                   while($row=mysqli_fetch_assoc($result)){
                       echo '<option>'.$row['speciality'].'</option>';

                   }
                   ?>
               </select>
           </div>
           <div class="col-md-3">
               <label>Doctor</label>
               <select class="form-control" name="name" id="doctors">
                  <option></option>
               </select>
           </div>

           <div class="col-md-3">
               <label>Date of Appointments</label>
               <input type="date" name="app_date" class="form-control">
           </div>

           <div class="col-md-3">
               <br>
               <button type="submit" class="btn btn-primary btn"  name="search" >Show</button>
           </div>

       </div>


</form>
<br>
<table id="rounded-corner">
    <thead>
    <tr>
        <th>#</th>
        <th>Patient Name</th>
        <th>Age</th>
        <th>Contact</th>
        <th>Chronological Diseases</th>
    </tr>
    </thead>

<?php
    if(isset($_GET['search'])){

$org_id = (int)$_SESSION['org_id'];
$speciality = $_GET['doc_sp'];
$name = $_GET['name'];
$date = $_GET['app_date'];
$sql = "SELECT s.schedule_id as sid from doctor d,schedule s
                WHERE d.doctor_id=s.doctor_id
                AND s.hospital_id={$org_id}
                AND d.name='{$name}'
                AND d.speciality='{$speciality}'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$sid = (int)$row['sid'];
$sql = "select patient_name as pat_name,TIMESTAMPDIFF (YEAR, dob, CURDATE()) AS age,asthma,cardiac_failure AS cf,
kidney_disease AS kd,diabetes,hyperlipidaemia AS chol,hypertension AS hyper, contact,@acount:=@acount+1 serial_number
              from (SELECT @acount:= 0) AS acount,appointment
              WHERE schedule_id={$sid}
              AND day_of_appointment='{$date}'
              order by time_of_creation";
$result = mysqli_query($connection, $sql);
$count = mysqli_num_rows($result);





?>
    <span style="color: #005580; font-size: medium">
            <?php
            if(isset($_GET['search'])){

                echo "Searched Results For: ";
                echo '<span style="padding-left: 10px">[' .$_GET['doc_sp']. ']  </span>';
                echo '<span style="padding-left: 10px">[' .$_GET['name']. ']    </span>';
                echo '<span style="padding-left: 10px">[Date: ' .date("d-m-Y", strtotime($_GET['app_date'])).'] </span>';
            }
            ?>
                    </span>
    <br>
    <br>


        <tbody>
        <?php
        if ($count > 0){
        while ($row = mysqli_fetch_assoc($result)) {

            $chronic=chronics_adder($row['asthma'],$row['cf'],$row['kd'],$row['diabetes'],$row['chol'],$row['hyper']);

            echo '<tr>';
            echo '<td>' . $row['serial_number'] . '</td>';
            echo '<td>' . $row['pat_name'] . '</td>';
            echo '<td>' . $row['age'] . '</td>';
            echo '<td>' . $row['contact'] . '</td>';
            echo '<td>' . "$chronic" . '</td>';
            echo '</tr>';
        }
        }
        }
        ?>
        </tbody>
    </table>



<br>
<div class="row">
    <div class="col-lg-4"></div>
    <span style="color: #005ce6">
    <?php if(isset($count) && $count==0) echo "No appointment found for this date" ?>
    </span>
</div>


<?php

    function chronics_adder($c1,$c2,$c3,$c4,$c5,$c6){
        $chronic="";
        if($c1=="yes")
            $chronic.="Asthma";
        if($c2=="yes")
            $chronic.=", Cardiac failure";
        if($c3=="yes")
            $chronic.=", kidney disease";
        if($c4=="yes")
            $chronic.=", Diabetes";
        if($c5=="yes")
            $chronic.=", Hyperlipidaemia";
        if($c6=="yes")
            $chronic.=", Hypertension";
        return $chronic;
    }

?>


