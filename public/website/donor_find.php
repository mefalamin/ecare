<?php
include "header.php";
include "../../includes/db_connection.php";


$sql="SELECT st.sub_thana AS ps FROM subdistrict_thana st order by ps ";
$combo=mysqli_query($connection,$sql);



?>


<div class="container-fluid" style="min-height: 350px">


    <div class="col-md-2"></div>

    <div class="col-md-8" style="background-color: #e5e5e5">
        <br>

        <h2 style="text-align: center">Find Blood Donor</h2>
        <br>

        <form>
            <div class="col-md-1"></div>
            <div class="row">
                <div class="col-md-4 ">
                    <label>Blood Group</label>
                    <select class="form-control" id="group" name="group">
                        <option>Select Blood group</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    </select>
                </div>


                <div class="col-md-4">

                    <label for="sel1">Area</label>
                    <select class="form-control" id="area" name="area">
                        <option>Select Area</option>
                        <option>All</option>
                        <?php
                        while ($ps = mysqli_fetch_assoc($combo)) {
                            echo '<option>' . $ps['ps'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-2 "><br>
                    <button type="submit" style="padding: 8.5px 32px;" class="btn" name="search_donor">Search</button>
                </div>


            </div>
        </form>

        <br>
        <br>

        <?php
        if(isset($_GET['search_donor'])){
            $area = $_GET['area'];
            $group = $_GET['group'];
            $sql="SELECT u.first_name AS f_name,u.last_name AS l_name,u.cell,d.blood_group as blood,area,d.district,u.email
            FROM user u, donor d WHERE
            d.userid=u.userid  AND ";
            if($area=='All'){
                $sql.=" d.blood_group='{$group}' AND d.last_donated <= NOW() - INTERVAL 3 MONTH ORDER BY u.first_name  ";
            }
            else{

                $sql.= "  area LIKE = '%{$area}%' AND  d.blood_group='{$group}' AND d.last_donated <= NOW() - INTERVAL 3 MONTH ORDER BY u.first_name   ";
            }

            $search_result = mysqli_query($connection, $sql);
            //echo $sql;
            $count=0;
            if($search_result)
                $count=mysqli_num_rows($search_result);
            //echo $count;

           if($count>0){

            while ($row = mysqli_fetch_assoc($search_result)) { ?>
            <div class="row" style="padding-left: 100px">
                <div class="col-md-3 text-center" style="border-right: 1px solid #404040;height: 140px;padding-right: 40px">
                    <img style="width:250px;height:120px;border-radius: 100%;" src="images/user.png">
                </div>
                <div class="col-md-4 text-left" style="border-right: 1px solid #404040;height: 140px;">
                    <p id='a' class="u-amount" style="color:#001a00;font-size: 25px;">
                        <b><?php echo $row['f_name']." ".$row['l_name']; ?></b></p>

                    <p class="u-amount " style="font-size=6px; "><span class="glyphicon glyphicon-map-marker "></span>
                        <b><?php echo $row['area'].", ".$row['district']; ?></p>

                    <p class="u-amount " style="font-size=6px; "><span
                            class="glyphicon glyphicon-earphone "></span> <?php echo $row['cell']; ?></p>

               <!--     <p style="color:#001a00;font-family: consolas;font-size: 16px;"><span
                            class="glyphicon glyphicon-envelope "></span> <?php //echo $row['email']; ?></p>
-->

                </div>
                <br>

                <div class="col-md-5 text-left">

                    <br>

                    <p style="color:#001a00">Blood Group: <?php echo '<span style="color: darkred;font-size: medium">'.$row['blood'].'</span>' ?></p>


                </div>
            </div>
            <hr style="height:2px;border:none;color:#cccccc;background-color:#cccccc;">
            <br>
        <?php
            }
           }

           else{

               echo '<div class="col-md-4"></div>';
               echo '<span style="color: #0A246A;font-size: medium;"><b>Sorry :( No Donor Found</b></span>';
           }
        }





        ?>


    <br><br>

    </div>


</div>


<script type="text/javascript">


    document.getElementById('group').value = "<?php if(isset($_GET['search_donor'])) echo $_GET['group'] ;?>";
    document.getElementById('area').value = "<?php if(isset($_GET['search_donor'])) echo $_GET['area'] ;?>";

</script>



<?php

include('footer.php');
?>

