<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("location:/project/public/admin/login/login.php");

}
echo $_SESSION['org_id']." ".$_SESSION['admin_id']." ".$_SESSION['admin_name']." ".$_SESSION['owner'];
$current_file = basename($_SERVER['PHP_SELF']);
include('header.php');
?>
<?php

        //getting website hospital infromation

        include('../../../includes/db_connection.php');
        $sql = "select * from hospital where hospital_id=".$_SESSION['org_id'];
        $run = mysqli_query($connection,$sql);
        confirm_query($run);
        $row = mysqli_fetch_array($run);
        $count = mysqli_num_rows($run);
        //var_dump($row);

        $name="";
        $speciality="";
        $address = "";
        $email="";
        $phone = "";
        $emergency="";
        $fax = "";
        $description = "";
        $geo="";

        if($count==1){
            $name=$row['name'];
            $speciality=$row['speciality'];
            $address = $row['address'];
            $description = $row['description'];
            $phone = $row['phone'];
            $emergency = $row['emergency'];
            $fax = $row['fax'];
            $email = $row['email'];

        }
        else {
            ?>
            <script type="text/javascript">

                alert("ops! No information.Add from update section")
            </script>

            <?php
        }




?>





    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Current Information</a></li>
        <li><a data-toggle="tab" href="#menu1">Update Or Modify Information</a></li>

    </ul>
    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                    <span style="color: #005580; font-size: large" class="blink_text"><?php
                        if(isset($_GET['success']))
                            echo "Updated Successfully";
                        if(isset($_GET['fail'])){
                            echo "!!Error!! Please try again later";
                        }
                        ?></span>
            </div>
            <br>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Information of Your Hospital</h4>
                                </div>
                                <div class="content">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Hospital Name</label>
                                                    <input type="text" class="form-control" placeholder="Name of your Hospital"
                                                           value="<?php echo $name ?> ">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Speciality</label>
                                                    <input type="text" class="form-control" placeholder="Speciality"
                                                           value="<?php echo $speciality ?>">
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Location</label>
                                                    <input type="text" class="form-control" placeholder="Your Hospital Location"
                                                           value="<?php echo $address ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="text" class="form-control" placeholder="Phones" value="<?php echo $phone ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Emergency</label>
                                                    <input type="text" class="form-control" placeholder="Emergency" value="<?php echo $emergency ?>">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fax</label>
                                                    <input type="text" class="form-control" placeholder="Fax" value="<?php echo $fax ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" placeholder="Email" value="<?php echo $email ?>">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description About Your Hospital in site</label>
                                                <textarea rows="5" class="form-control" placeholder="Here About Your Hospital"
                                                    ><?php echo $description ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Picture in Hospital Gallery</label>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>



        <div id="menu1" class="tab-pane fade">
            <br>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"></h4>
                                </div>
                                <div class="content">

                                    <form action="action.php" method="post">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Hospital Name</label>
                                                    <input type="text" class="form-control" placeholder="Name of your Hospital"
                                                           name="hospital" value="<?php echo $name ?> ">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Speciality</label>
                                                    <input type="text" class="form-control" placeholder="Speciality"
                                                           name="speciality" value="<?php echo $speciality ?>">
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Location</label>
                                                    <input type="text" class="form-control" placeholder="Your Hospital Location"
                                                           name="address" value="<?php echo $address ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="text" class="form-control" placeholder="Phones" name="phone" value="<?php echo $phone ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Emergency</label>
                                                    <input type="text" class="form-control" placeholder="Emergency" name="emergency" value="<?php echo $emergency ?>">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fax</label>
                                                    <input type="text" class="form-control" placeholder="Fax" name="fax" value="<?php echo $fax ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $email ?>">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description About Your Hospital in site</label>
                                                <textarea rows="5" class="form-control" placeholder="Here About Your Hospital" name="description"
                                                    ><?php echo $description ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Picture in Hospital Gallery</label>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="clearfix"></div>

                                        <button type="submit" class="btn btn-info btn-fill pull-right" name ="save">Save</button>


                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<?php

include "footer.php";
?>



