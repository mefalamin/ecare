<?php



$uid= $_SESSION['uid'];

$sql="SELECT first_name AS fname,last_name AS lname,email,cell,pic FROM user WHERE userid={$uid} ";
$result=mysqli_query($connection,$sql);
$profile=mysqli_fetch_assoc($result);

//print_r($profile);




?>



<div id="main" class="tab-pane fade in active" >
    <br>
    <div class="content">

        <div class="col-md-2"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4"></div>
                    <span style="color: blue;text-align: center">
                        <?php
                        if(isset($_GET['upload'])){
                            if($_GET['upload']==true){
                                echo "Uploaded New Picture";

                            }
                            else{
                                echo "Upload picture fail";
                            }
                        }


                        if(isset($_GET['error'])){
                            if($_GET['error']==1){
                                echo "Picture file not valid";

                            }
                            if($_GET['error']==2){
                                echo "Picture file size exceed";

                            }

                        }
                        ?>
                    </span>

                </div>

                <br>
                <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-5 text-center" style="solid #404040;height: 100px;">
                    <img style="width:300px;height:120px" src="user_profile/user_pic/<?php echo $profile['pic'] ?>">
                </div>
            </div>
                <br>
                <br>


                    <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input  name="fname" id="fname"
                                        placeholder="First Name" class="form-control"  type="text" value="<?php echo $profile['fname'] ?>" >

                            </div>
                            <span style="color: red" id="error_fname"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input name="lname" id="lname" placeholder="Last Name" class="form-control"  type="text" value="<?php echo $profile['lname'] ?>" >
                            </div>
                            <span style="color: red" id="error_lname"></span>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input name="email" disabled placeholder="E-Mail Address" class="form-control"  type="text" value="<?php echo $profile['email'] ?>">
                            </div>
                        </div>
                    </div>




                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mobile#</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                <input name="mobile1" disabled placeholder="01XXXXXXXXX" id="mobile1" class="form-control" type="text" value="<?php echo $profile['cell'] ?>" >
                            </div>


                        </div>
                    </div>

           <!--    <div class="col-md-6">
                        <div class="form-group">
                            <label>Add Another Mobile#</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                <input type="text" name="mobile2"  placeholder="01XXXXXXXXX" id="mobile2" class="form-control" >
                            </div>
                            <span style="color: red" id="error_num"></span>

                        </div>
                    </div> -->
                </div>
                <span style="color: #0044cc"id="confirm_name_update" ></span>
                <button type="submit" class="btn btn-fill pull-right" onclick="validate_profile()">Save</button>

                <div class="clearfix"></div>
                <br>
                <h4 style="text-align: center">Change Your Password </h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Current Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
                                <input name="psw" id="current_pwd" placeholder="Current Password" class="form-control"  type="password">
                            </div>
                            <span style="color: red" id="current_error"></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>New Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
                                <input name="psw"  id="new_pwd" placeholder="New Password" class="form-control"   type="password" onkeyup="checkpassmatch();">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
                                <input name="psw"  id="confirm_passwd" placeholder="Confirm New Password" class="form-control"   type="password" onkeyup="checkpassmatch();">
                            </div>
                            <span style="color: red" id="match_error"></span>
                        </div>
                    </div>
                </div>
                <span style="color: #000099" id="success"><b></b></span>
                <br>
                <button type="submit" class="btn btn-small" onclick="change_pass()">Change Password</button>
                <div class="clearfix"></div>
                <br>

                <div class="row">
                <form enctype="multipart/form-data" action="action.php" method="post">
                    <div class="col-md-5" >
                        <div class="form-group">
                            <label>Upload Image</label>
                            <input type="hidden" name="uid" value="<?php if(isset($_SESSION['uid'])) echo $_SESSION['uid']  ?>" >
                            <input type='file'  name="photo" id="fileSelect" required>

                        </div>
                        <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 1 MB.</p>
                        <button name="upload" type="submit" class="btn btn-sm">Upload</button>

                    </div>
                </form>
                </div>
                <br>

                <br>


            </div>


        </div>


    </div>
</div>

