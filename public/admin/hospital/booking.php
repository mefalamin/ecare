
<?php
    $hid=(int)$_SESSION['org_id'];
    $sql="SELECT
hr.icu_aval AS icu,
hr.ccu_aval AS ccu,
hr.single_aval AS single,
hr.share_aval AS share,
hr.male_ward_aval AS male_ward,
hr.female_ward_aval AS female_ward
 FROM hospitals_room hr WHERE hr.hospital_id={$hid}";
    $result=mysqli_query($connection,$sql);


?>


<form method="get" action="">

    <div class="row">
        <div class="col-md-3">
            <label>Category</label>
            <select class="form-control" name="cat"
                    id="cat" >

                <?php
                while($row=mysqli_fetch_assoc($result)){
                    if($row['icu']=="yes") {
                        echo '<option>ICU</option>';
                    }
                    if($row['ccu']=="yes"){
                        echo '<option>CCU</option>';
                    }
                    if($row['single']=="yes"){
                        echo '<option>Single Cabin</option>';
                    }
                   if($row['share']=="yes"){
                        echo '<option>Shared Cabin</option>';
                    }
                   if($row['male_ward']=="yes"){
                        echo '<option>Male Ward</option>';
                    }
                    if($row['female_ward']=="yes"){
                        echo '<option>Female Ward</option>';
                    }
                }
                ?>
            </select>
        </div>

        <div class="col-md-3">
            <label>Search in</label>
            <select class="form-control" name="search_in" id="search_in">
                <option>All</option>
                <option>Booked</option>
                <option>New Request</option>
                <option>Canceled</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Select Date</label>
            <input type="date" name="date" class="form-control">
        </div>

        <div class="col-md-1">
            <label>No Date</label>
            <input type="checkbox" name="no_date" class="form-control">
        </div>

        <div class="col-md-2">
            <br>
            <button type="submit" class="btn btn-primary btn"  name="search_booking" >Show</button>
        </div>

    </div>


</form>
<br>
<span style="color: #005580; font-size: medium">
            <?php
            if(isset($_GET['search_booking'])){

                echo "Searched Result For: ";
                echo '<span style="padding-left: 10px">[Category: ' .$_GET['cat']. ']  </span>';
                echo '<span style="padding-left: 10px">[Booking Status:' .$_GET['search_in']. ']    </span>';
                if(isset($_GET['no_date'])){
                    echo '<span style="padding-left: 10px">[Date: All] </span>';
                }
                else{
                    echo '<span style="padding-left: 10px">[Date: ' .date("d-m-Y", strtotime($_GET['date'])).'] </span>';
                }

            }
            ?>
                    </span>
<br>


<table id="rounded-corner">
    <thead>
    <tr>
        <th>#</th>
        <th>Patient Name</th>
        <th>Age</th>
        <th>Contact</th>
        <th>Time of Booking</th>
        <th>Reason</th>
        <th>Booking Status</th>
        <th>Action</th>

    </tr>
    </thead>

    <?php
    if(isset($_GET['search_booking'])) {

        $org_id = (int)$_SESSION['org_id'];
        $cat = $_GET['cat'];
        $date = $_GET['date'];
        $status= $_GET['search_in'];

       // echo print_r($_GET);

        $sql="SELECT * FROM booking b WHERE b.hospital_id={$org_id} AND b.category='{$cat}' ";
        if($status=="Booked"|| $status=="New Request"|| $status=="Canceled")
            $sql.=" AND b.status='{$status}'";

        if(isset($_GET['no_date'])){
            $sql.=" ORDER BY b.time_of_booking";
        }
        else{
            $sql.=" AND b.time_of_booking like '{$date}%' ORDER BY b.time_of_booking";
        }

      //  echo $sql;


        $result = mysqli_query($connection, $sql);
        $count_book=0;
        if($result!=null){
            $count_book = mysqli_num_rows($result);
        }
        $serial=1;


    ?>


    <tbody>
    <?php
    if ($count_book > 0){
        while ($row = mysqli_fetch_assoc($result)) {



            echo '<tr>';
            echo '<td>' . $serial . '</td>';
            echo '<td>' . $row['patient_name'] . '</td>';
            echo '<td>' . $row['age'] . '</td>';
            echo '<td>' . $row['contact'] . '</td>';
            echo '<td>' . $row['time_of_booking'] . '</td>';
            echo '<td>' . $row['reason_of_booking'] .'</td>';
            echo '<td>' . $row['status'] . '</td>';
            if($row['status']=='New Request'){
                echo '<td>
                        <button class="button">Cancel</button>
                        <button class="button">Book</button>
                         </td>';
            }
            if($row['status']=='Booked'){
                echo '<td>
                        <button class="button">Clear</button>
                         </td>';
            }


            echo '</tr>';
            $serial++;
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
    <?php if(isset($count_book) && $count_book==0) echo "No booking found for this date" ?>
    </span>
</div>