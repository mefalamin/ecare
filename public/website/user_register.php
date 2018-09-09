


<?php
require_once("../../includes/db_connection.php");
require("header.php");
?>





<div class="container">



    <form class="well form-horizontal" method="post"  id="user_form">
        <fieldset>

            <!-- Form Name -->
            <h3 style="text-align: center">Create Your Account</h3>

            <!-- Text input first name-->

            <div class="form-group">
                <label class="col-md-4 control-label">First Name</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input pattern="[A-Za-z]{3}"   name="first_name" id="first_name" placeholder="First Name" class="form-control"  type="text">

                    </div>


                </div>
            </div>

            <!-- Text input last-->

            <div class="form-group">
                <label class="col-md-4 control-label" >Last Name</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="last_name" placeholder="Last Name" class="form-control"  type="text">
                    </div>
                </div>
            </div>

            <!-- Text input email -->
            <div class="form-group">
                <label class="col-md-4 control-label">E-Mail</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
                    </div>
                </div>
            </div>
            <!-- Text input passwd -->
            <div class="form-group">
                <label class="col-md-4 control-label" >Password</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
                        <input name="psw" id="txt_passwd" placeholder="Create Password" class="form-control"  type="password">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" >Confirm Password</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
                        <input name="psw"  id="txt_confirm_passwd" placeholder="Confirm Password" class="form-control"   type="password" onkeyup="checkpassmatch();">
                    </div>
                    <div class="registrationFormAlert" style="color: green" id="divCheckPasswordMatch">
                    </div>
                </div>

            </div>


            <!-- Text input mobile-->

            <div class="form-group">
                <label class="col-md-4 control-label">Mobile #</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input name="mobile" placeholder="01XXXXXXXXX" id="mobile" class="form-control" type="text" onkeyup="validatenumber();">
                    </div>
                    <div class="registrationFormAlert" style="color: green" id="divChecknumber">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Register as a Blood Donor?</label>
                <div class="col-md-4">
                    <div class="radio">
                        <label>
                            <input type="radio" id=radio_yes name="rdonor" value="yes" /> Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" id=radio_no name="rdonor" value="no" checked="No" /> No
                        </label>
                    </div>
                </div>
            </div>


            <!-- Text input dob-->
            <div class="form-group" id="dob_on" style="display: none">
                <label class="col-md-4 control-label">Date Of Birth</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input name="dob" placeholder="Date Of Birth" class="form-control"  type="date" id="dobfield" onchange="getAge()">

                    </div>
                    <div class="registrationFormAlert" id="divCheckAge">
                    </div>
                </div>
            </div>


            <!-- Text input-->
            <div class="form-group" id=bg_on style="display: none">
                <label class="col-md-4 control-label">Blood Group</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="bloodgroup" class="form-control selectpicker" >
                            <option value=" " >Select your Blood Group </option>
                            <option>O+</option>
                            <option >O-</option>
                            <option >A+</option>
                            <option >A-</option>
                            <option >B+</option>
                            <option >B-</option>
                            <option >AB+</option>
                            <option >AB-</option>

                        </select>
                    </div>
                </div>
            </div>


            <!-- Text input google_loc -->

            <div class="form-group" id=location style="display: none;">
                <label class="col-md-4 control-label">Location</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input name="address" id="loc" placeholder="Enter your address " class ="form-control" type="text">
                    </div>

                </div>

                <div class="form-group" style="display: none">
                    <button data-target="#us6-dialog" data-toggle="modal" type="button" class="btn" >Give Location</button>
                </div>
            </div>


            <!-- Text input District-->

            <div class="form-group" id="district_on" style="display: none" >
                <label class="col-md-4 control-label">District</label>
                <div class="col-md-4 selectContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="district" class="form-control selectpicker" id="select_district_combo" onchange="fetch_select(this.value)"   >
                            <option value="" >Select your District </option>



                            <?php
                            $query = "SELECT id,name FROM district ORDER BY NAME ASC ";
                            $result = mysqli_query($connection,$query);
                            while($row=mysqli_fetch_assoc($result)){
                                echo "<option>".$row["name"]."</option>";
                            }

                            ?>


                        </select>
                    </div>
                </div>
            </div>

            <!-- Select Basic sub-dis -->

            <div class="form-group" id="sub_district_on" style="display: none">
                <label class="col-md-4 control-label">Sub-District/Thana</label>
                <div class="col-md-4 selectContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="sub_district" class="form-control selectpicker" id="sub_combo" >
                            <option value=" ">Select your Sub-District/Thana </option>





                        </select>
                    </div>
                </div>
            </div>





            <div class="form-group" id=last_donated_on style="display: none;">
                <label class="col-md-4 control-label">Date of Last Donation</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input name="last_donated" placeholder="Date Of Birth" class="form-control"  type="Date">


                    </div>
                    <div class="checkbox" id="forgot_donation">
                        <input type="checkbox" name="forgot">Not Remember<br>
                    </div>

                </div>



            </div>



            <!-- Button -->
            <div class="form-group" >
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button type="submit" id="button" class="btn" name="sign_up" >Sign-Up<span class="glyphicon glyphicon-send"></span></button>
                </div>
            </div>



        </fieldset>

    </form>
</div>
<!-- /.container -->
<!-- /.container -->



<?php
include "footer.php";
?>
