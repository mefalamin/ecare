
<div id="doctor" class="tab-pane fade <?php if(isset($_GET['search_doctor']) ) echo "in active" ?> ">


    <div class="content">
        <br>
        <div class="row">


            <form method="get">
                <div class="row">
                    <div class="col-md-3 "></div>
                    <div class="col-md-4">
                        <label for="sel1">Select Speciality</label>
                        <select name="doc_sp" class="form-control selectpicker" id="doc_sp" required>

                            <option disabled selected value ></option>
                            <?php
                            $query ="SELECT d.speciality from doctor d,schedule s WHERE d.doctor_id=s.doctor_id AND s.hospital_id={$_SESSION['hid_seeing']} GROUP BY d.speciality";
                            $result = mysqli_query($connection,$query);
                            while($row=mysqli_fetch_assoc($result)){
                                echo "<option>".$row["speciality"]."</option>";
                            }

                            ?>
                        </select>
                    </div>

                    <?php // echo $_SESSION['hid_seeing'] ?>

                    <div class="col-md-2 "><br>
                        <button type="submit" style="padding: 8.5px 32px;" class="btn" name="search_doctor">Search</button>
                    </div>


                </div>
            </form>



        </div>
        <input type="hidden" name="hid" id="hid" class="form-control" value="<?php $_SESSION['hid_seeing'];?>">


        <?php

        if(isset($_GET['search_doctor']) ){
            $doc_sp = $_GET['doc_sp'];
            $hid=(int)$_SESSION['hid_seeing'];


            $sql = "SELECT * FROM project.doctor where speciality='$doc_sp' order by name;";
            $result = mysqli_query($connection,$sql);
            $count_row = mysqli_num_rows($result);

            if ($count_row > 0){
                while ($row = mysqli_fetch_assoc($result)){

                    ?>

                    <br><br>

                    <div class="row">
                        <div class="col-md-3 text-left" style="border-right: 1px solid #404040;height: 170px;">
                            <img style="width:150px;height:150px;border-radius: 70%;" src="../admin/hospital/doctor_pic/13.png">
                        </div>
                        <div class="col-md-6 text-left" style="border-right: 1px solid #404040;height: 170px;">
                            <p id='a' style="color:#001a00;font-size: 25px;"><b><?php echo $row['name']; ?></b></p>

                            <p class="u-amount " style="color: #005ce6;font-family:consolas;font-size: 19px; "><span
                                    class="glyphicon glyphicon-info-sign"></span> <b><?php echo $row['speciality']; ?></p>

                            <p style="color:#001a00 ;font-family: consolas;font-size: 16px;"><?php echo $row['qualification']; ?></p>

                            <br>

                            <p></p>
                        </div>
                        <br>

                        <div class="col-md-3 text-left">

                            <p class="u-amount " style="font-size=6px; "><span
                                    class="glyphicon glyphicon-earphone "></span> <?php echo $row['contact']; ?></p>
<!--
                            <p><span class="glyphicon glyphicon-hand-right "></span> <b>Fees</b></p>

                            <p>Tk.<?php //echo $row['fee']; ?></p>

-->

                            <button class = "button right" style="margin-right: 8px; background-color:black ;color: white"
                                    data-toggle="modal" data-target="#schedule_modal"
                                    data-id="<?php echo $row['doctor_id']; ?>">Schedule</button>
                        </div>
                    </div>
                    <hr style="height:2px;border:none;color:#cccccc;background-color:#cccccc;">
                    <br>
                    <?php
                }
                echo '<br> <br>';
            }
        }
        ?>

    </div>



</div>