<?php

$sql=" SELECT * FROM  donor d WHERE d.userid={$uid}";
$donor_profile=mysqli_query($connection,$sql);
$count=0;
if($donor_profile){
    $count=mysqli_num_rows($donor_profile);

}
//echo $count;

?>


<div id="donor" class="tab-pane fade">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-2"></div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">

                            <h4 style="text-align: center">Donor Profile</h4>
                        </div>
                        <?php

                        if($count>0 || isset($_GET['become'])){
                                $donor=mysqli_fetch_assoc($donor_profile);
                               // print_r($donor);
                            ?>
                            <div class="content">
                                <form id="donor_form" method="post">

                                    <div class="donor">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date Of Birth</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    <input name="dob" style="height: 40px" placeholder="Date Of Birth" value="<?php if($count>0) echo $donor['date_of_birth'] ?>" class="form-control"  type="date" id="dobfield" required>

                                                </div>


                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Blood group</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                    <select name="bloodgroup" class="form-control selectpicker" required style="height: 40px">
                                                        <option value=" " >Select your Blood Group </option>
                                                        <option <?php if($count>0) if($donor['blood_group']=='O+' ) echo "selected" ?> >O+</option>
                                                        <option <?php if($count>0) if($donor['blood_group']=='O-' ) echo "selected" ?> >O-</option>
                                                        <option <?php if($count>0) if($donor['blood_group']=='A+' ) echo "selected" ?> >A+</option>
                                                        <option <?php if($count>0) if($donor['blood_group']=='A-' ) echo "selected" ?> >A-</option>
                                                        <option <?php if($count>0) if($donor['blood_group']=='B+' ) echo "selected" ?> >B+</option>
                                                        <option <?php if($count>0) if($donor['blood_group']=='B-' ) echo "selected" ?> >B-</option>
                                                        <option <?php if($count>0) if($donor['blood_group']=='AB+' ) echo "selected" ?> >AB+</option>
                                                        <option <?php if($count>0) if($donor['blood_group']=='AB-' ) echo "selected" ?> >AB-</option>

                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="donor">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Your Location</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                                    <input name="address" id="loc" placeholder="Enter your address " value="<?php if($count>0) echo $donor['area'] ?>" class ="form-control" type="text">
                                                </div>

                                            </div>



                                        </div>
                                    </div>

                                    <div class="donor">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>District</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                    <select style="height: 40px" name="district" class="form-control selectpicker" id="select_district_combo" onchange="fetch_select(this.value)" required   >
                                                        <option value="" >Select your District </option>



                                                        <?php




                                                            $query = "SELECT id,name FROM district ORDER BY NAME ASC ";
                                                            $result = mysqli_query($connection, $query);
                                                            while ($row = mysqli_fetch_assoc($result)) {

                                                                echo '<option>'.$row['name'].'</option>';

                                                            }


                                                        ?>


                                                    </select>
                                                </div>

                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sub-District/Thana</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                    <select name="sub_district" class="form-control selectpicker" id="sub_combo" required style="height: 40px">
                                                        <option value=" ">Select your Sub-District/Thana</option>
                                                        <?php

                                                        if($count>0){
                                                            echo '<option selected>'.$donor['area'].'</option>';
                                                        }
                                                        ?>




                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        document.getElementById('select_district_combo').value="<?php if($count>0)
                                                                echo $donor['district']; ?>";
                                        document.getElementById('sub_combo').value="<?php if($count>0)
                                                                echo $donor['area']; ?>";

                                    </script>


                                    <div class="row" style="padding-left: 15px">
                                        <div class="col-md-6">
                                            <label>Last Donated</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                <input value="<?php if($count>0) echo $donor['last_donated'] ?>"
                                                       max="<?php  $date = date('Y-m-d');echo $date; ?>" name="last_donated"
                                                       placeholder="Date Of Birth" class="form-control"   type="Date" required style="height: 40px;" >


                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                    <span id="donor_notify" style="color: #000099;padding-left: 10px"><b></b></span>
                                    <button type="submit" class="btn btn-sm btn-fill pull-right">Save</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>

                            <?php
                        }

                        else{
                            ?>
                            <br>
                           <div class="row">
                               <div class="col-md-4"></div>
                               <span style="color: #000099">Your have no Donor Profile</span>
                           </div>
                            <br>
                            <div class="row">

                                <div class="col-md-4"></div>
                                <button class="btn btn-fill" onclick="window.location='user_profile.php?become=true'">Become a Donor</button>
                            </div>

                        <?php

                        }
                        ?>
                    </div>

                    <br>

                </div>


            </div>
        </div>

    </div>
</div>



