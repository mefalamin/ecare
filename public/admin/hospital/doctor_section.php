<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("location:/project/public/admin/login/login.php");

}
echo $_SESSION['org_id']." ".$_SESSION['admin_id']." ".$_SESSION['admin_name']." ".$_SESSION['owner'];
$current_file = basename($_SERVER['PHP_SELF']);
?>

<?php
$name = "";
$gender = "";
$qualification = "";
$doc_speciality = "";
$fee= "";
$contact = "";
$pic = "";
$id='';
include('../../../includes/db_connection.php');
$add_new=1;
if(isset($_GET['add'])) {
    $id = $_GET['id'];
    $sql = "SELECT
                      doctor_id,
                      name,
                      speciality,
                      qualification,
                      pic,
                      gender,
                      contact

                    FROM project.doctor WHERE doctor_id='$id'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $doc_speciality = $row['speciality'];
    $qualification  =$row['qualification'];
    $gender = $row['gender'];
    //$fee = $row['fee'];
    $contact = $row['contact'];
    $add_new=0;
}

$sql = "SELECT speciality FROM doctor GROUP BY speciality  ";
$result = mysqli_query($connection,$sql);

?>


<body>

<?php
include 'header.php';
?>







        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Add Doctor</a></li>
            <li><a data-toggle="tab" href="#menu1">Manage Doctor</a></li>

        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <span style="color: #005580; font-size: large" class="blink_text"><?php
                        if(isset($_GET['new_add']))
                            echo "Doctor Has been Added, Please go to the Manage Section for Schedule Management";
                        if(isset($_GET['duplicate_entry'])){
                            echo "!!Error!! Doctor is already in the registered list";
                        }
                        if(isset($_GET['is_already'])){
                            echo "!!Error!! This Doctor has already a schedule in your hospital";
                        }
                        ?></span>
                </div>
                <br>
                <div class="content">
                    <div id="home" class="tab-pane fade in active">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Add Doctor to Your Hospital</h4>
                                        </div>

                                        <div class="content">
                                            <form action="action.php" method="GET">
                                                <label>Search Doctor In Registered List</label>
                                                <div class="row">
                                                    <div class=col-md-5>
                                                        <div class="form-group">

                                                            <select class="form-control" name="doc_sp"
                                                                    id="doc_sp" onchange="fetch_doctor(this.value)">
                                                                <option>Select Speciality</option>
                                                                <?php
                                                                while($row=mysqli_fetch_assoc($result)){
                                                                    echo '<option>'.$row['speciality'].'</option>';

                                                                }
                                                                ?>
                                                            </select>

                                                        </div>

                                                    </div>
                                                    <div class=col-md-5>
                                                        <div class="form-group">

                                                            <select class="form-control" name="doctors"
                                                                    id="doctors">
                                                                <option>Select Doctor</option>

                                                            </select>

                                                        </div>

                                                    </div>

                                                    <div class=col-md-2>
                                                        <button class="btn btn-info btn-fill" type="submit"
                                                                name="select">Select
                                                        </button>
                                                    </div>

                                                </div>

                                            </form>

                                            <form method="post" action="action.php" enctype="multipart/form-data">
                                                <div class="col-md-4"></div>
                                                <span style="color: red;"><?php
                                                        if(isset($_GET['error'])){
                                                            if($_GET['error']==1){
                                                                echo "!!Please select a valid file format!!";
                                                            }
                                                            elseif($_GET['error']==2){
                                                                echo "!!File size is larger than the allowed limit!!";
                                                            }
                                                            else{
                                                                 echo "!!Error uploading the picture!!";
                                                            }
                                                        }

                                                    ?></span>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="Doctor's Full Name"
                                                                   name="doc_name" <?php if($add_new===0) echo 'readonly=true'; ?>
                                                                   value="<?php echo $name ?>">
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Gender</label>
                                                            <select name="doc_gender" class="form-control selectpicker" <?php if($add_new===0) echo 'readonly=true'; ?>>
                                                                <option value="">Select Gender</option>
                                                                <option <?php if($gender==='Male') echo "selected" ?>>Male</option>
                                                                <option <?php if($gender==='Female') echo "selected" ?>>Female</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Speciality</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="Doctor's Speciality" <?php if($add_new===0) echo 'readonly=true'; ?>
                                                                   name="doc_speciality" value="<?php echo $doc_speciality ?>">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Doctor's Qualifications</label>
                                                                    <textarea rows="5" class="form-control" <?php if($add_new===0) echo 'readonly=true'; ?>
                                                                              placeholder="Degrees" value="Mike"
                                                                              name="doc_degree"><?php echo $qualification ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                          <!--          <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Doctor's Fee</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="In Taka" name="fee"
                                                                   value="<?php  echo $fee ?>">
                                                        </div>
                                                    </div>  -->
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Contact no.</label>
                                                            <input type="text" class="form-control"
                                                                   name="contact" placeholder="phone" value="<?php  echo $contact ?>">
                                                        </div>
                                                    </div>

                                                    <input type="text" hidden name="id" value="<?php echo $id ?>">
                                                </div>

                                                <div class="form-group">

                                                    <div class="input-group">
                                                        <label>Upload File</label>
                                                        <br>
                                                        <label for="fileSelect">Filename:</label>

                                                        <input type="file" name="photo" id="fileSelect">
                                                        <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 2 MB.</p>

                                                    </div>


                                                </div>
                                                <button type="submit" class="btn btn-info btn-fill pull-right"
                                                        name="add__from_registered" style="display: <?php if($add_new===1) echo "none" ?>">Add from Registered Doctor list
                                                </button>
                                                <button type="submit" class="btn btn-info btn-fill pull-right"
                                                        name="add_doctor" style="display: <?php if($add_new===0) echo "none" ?>">Add Doctor
                                                </button>

                                                <button type="reset" class="btn btn-info btn-fill pull-left" onclick="window.location.href='doctor_section.php'">Reset</button>

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


            <?php




            $org_id=(int)$_SESSION['org_id'];
            $sql = "SELECT d.speciality from doctor d,schedule s WHERE d.doctor_id=s.doctor_id AND s.hospital_id={$org_id} GROUP BY d.speciality";
            $result = mysqli_query($connection,$sql);



            ?>



            <div id="menu1"  class="tab-pane fade">
                <br>
                <div class="container-fluid">
                    <form>
                    <div class="row">

                        <div class="col-md-3">
                            <label>Show by Department</label>
                            <select class="form-control" name="doc_sp_manage"
                                    id="doc_sp_manage">

                                <?php

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option>' . $row['speciality'] . '</option>';

                                    }

                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <button type="submit" class="btn btn-primary btn"  name="search_manage" >Show</button>
                        </div>

                    </div>
                    </form>


                    <span style="color: #005580; font-size: medium">
                        <?php
                        if(isset($_GET['search_manage'])){
                            echo "Showing Department : ".$_GET['doc_sp_manage'];
                        }
                        ?>
                    </span>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="newspaper-b">

                            <thead>
                            <tr>

                                <th scope="col">Name</th>
                                <th scope="col">Speciality</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Assistant no.</th>
                                <th scope="col">Fee</th>
                                <th scope="col">Availablity</th>
                                <th scope="col"></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $hid = (int) $_SESSION['org_id'];
                            $sql = "SELECT d.name,d.speciality,s.fee,s.availability,s.doctor_asst_contact,s.schedule_id,doctor_contact
                                          FROM doctor d,schedule s
                                          WHERE s.hospital_id=1 AND
                                          d.doctor_id=s.doctor_id
                                          ORDER BY d.name";
                            if(isset($_GET['search_manage'])){
                                $doc_speciality=$_GET['doc_sp_manage'];
                                $sql="SELECT d.name,d.speciality,s.fee,s.availability,s.doctor_asst_contact,s.schedule_id,doctor_contact
                                          FROM doctor d,schedule s
                                          WHERE s.hospital_id={$hid} AND
                                          d.doctor_id=s.doctor_id AND
                                          d.speciality='{$doc_speciality}'
                                          ORDER BY d.name";
                            }
                            $result = mysqli_query($connection,$sql);
                            while($row=mysqli_fetch_assoc($result)){
                                $schedule_id=$row['schedule_id'];
                                $schedule_id=(int)$schedule_id;
                                echo '<tr>';
                                echo '<td>'.$row['name'].'</td>';
                                echo '<td>'.$row['speciality'].'</td>';
                                echo '<td>'.$row['doctor_contact'].'</td>';
                                echo '<td>'.$row['doctor_asst_contact'].'</td>';
                                echo '<td>'.$row['fee'].'</td>';
                                echo '<td>'.$row['availability'].'</td>';
                                echo '<td class="select">
                                        <button
                                           class = "button"
                                           data-toggle="modal"
                                           data-target="#doctor_edit"
                                           data-id="'.$schedule_id.'">Edit</button>
                                     </td>';
                                echo'</tr>';


                            }



                            ?>


                            </tbody>
                        </table>
                    <br>
                    </div>
                </div>
            </div>


        </div>

    </div>

<div class="modal fade" id="doctor_edit" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel" style="text-align: center"><b>Manage Doctor's Schedule</b></h4>
            </div>
            <div class="dash">


            </div>

        </div>
    </div>
</div>

</body>



<script type="text/javascript">
    document.getElementById('doc_sp_manage').value="<?php if(isset($_GET['search_manage'])) echo $_GET['doc_sp_manage'] ?>";
    $('#doctor_edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('id') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'id=' + recipient;

        $.ajax({
            type: "GET",
            url: "doctor_modal.php",
            data: dataString,
            cache: false,
            success: function (data) {
                console.log(data);
                modal.find('.dash').html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    })


    if (location.hash) {
        $('a[href=\'' + location.hash + '\']').tab('show');
    }
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('a[href="' + activeTab + '"]').tab('show');
    }

    $('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
        e.preventDefault()
        var tab_name = this.getAttribute('href')
        if (history.pushState) {
            history.pushState(null, null, tab_name)
        }
        else {
            location.hash = tab_name
        }
        localStorage.setItem('activeTab', tab_name)

        $(this).tab('show');
        return false;
    });
    $(window).on('popstate', function () {
        var anchor = location.hash ||
            $('a[data-toggle=\'tab\']').first().attr('href');
        $('a[href=\'' + anchor + '\']').tab('show');
    });



    function fetch_doctor(val)
    {
        $.ajax({
            type: 'post',
            url: 'action.php',
            data: {
                doc_sp:val
            },
            success: function (response) {
                document.getElementById("doctors").innerHTML=response;
            }
        });
    }


</script>

</body>





</html>

