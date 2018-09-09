
<?php
include('../../includes/db_connection.php');

include("header.php");
include("success_modal.php");

//script for auto changing doctor availability
if(isset($_GET['sid'])){
    $sid=(int)$_GET['sid'];
    $sql="SELECT s.will_join,s.availability from schedule s WHERE s.schedule_id={$sid} AND s.availability= 'no' ";
    $auto=mysqli_query($connection,$sql);
    if($auto){
        $get_date=mysqli_fetch_assoc($auto);
        $join=Date('Y-m-d',strtotime($get_date['will_join']));
        $today=date('Y-m-d');
        if($today>=$join)
        {
            $sql="UPDATE schedule SET availability='yes',will_join=NULL WHERE schedule_id={$sid}";
            mysqli_query($connection,$sql);
        }

    }
}







if(isset($_GET['sid'])){
    $sid = $_GET['sid'];
    $sid=(int)$sid;
    $sql = "SELECT
                      d.name AS doc_name,
                      h.name AS h_name,
                      h.address AS address,
                      s.doctor_asst_contact AS asst,
                      s.schedule_id AS s_id,
                      d.speciality AS sp,
                      d.qualification AS q,
                      s.availability,
                      s.will_join,
                      s.sat_aval,
                      s.sat_from,
                      s.sat_to,
                      s.sat_max,
                      s.sun_aval,
                      s.sun_from,
                      s.sun_to,
                      s.sun_max,
                      s.mon_aval,
                      s.mon_from,
                      s.mon_to,
                      s.mon_max,
                      s.tues_aval,
                      s.tues_from,
                      s.tues_to,
                      s.tues_max,
                      s.wed_aval,
                      s.wed_from,
                      s.wed_to,
                      s.wed_max,
                      s.thur_aval,
                      s.thur_from,
                      s.thur_to,
                      s.thur_max,
                      s.fri_aval,
                      s.fri_from,
                      s.fri_to,
                      s.fri_max,
                      s.fee

                      FROM hospital h, schedule s,doctor d
                      WHERE
                      h.hospital_id=s.hospital_id AND
                      d.doctor_id=s.doctor_id AND
                      s.schedule_id={$sid}";


    $result=mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($result);

    $onleave=false;
    if($row['availability']=="no" && $row['will_join']!=null){
        $onleave=true;
        $will_join=Date('Y-m-d',strtotime($row['will_join']));

    }



    }


?>






<br>
<div class="container-fluid" >


    <div class="col-md-2"></div>

    <div class="col-md-8" style="background-color: #e5e5e5">
        <br>
        <h2 style="text-align: center;">Fill up Below for Appointment</h2>






    </div>
</div>


<div class="container vertical-divider" style="background-color: #e5e5e5">
    <div class="column one-third" style="margin-left: 20px;margin-top: 20px;">
        <h2><?php echo $row['doc_name'] ?> </h2>
        <div style="margin-top: -15px">
            <p><em><?php echo $row['sp'] ?> Specialist</em></p>
            <p><?php echo $row['q'] ?> </p>
            <p>Chamber:<?php echo $row['h_name'].'<br>'.$row['address'] ?> </p>
            <p><?php echo "Fee:".$row['fee'].' TK'; ?></p>
            <p><?php echo "For Query:".$row['asst']; ?></p>
        </div>


            <table id="pattern-style-a">
                <thead>
                <td>Day</td>
                <td style="text-align: center">Time</td>
                <td hidden>aval</td>
                </thead>

                <tr <?php if($row['sat_aval']=="no" || $row['sat_aval']=="") echo "hidden" ?>>
                    <td>Sat</td>
                    <td style="text-align: center"><?php echo date("g:i a", strtotime($row['sat_from']))." to ".date("g:i a", strtotime($row['sat_to'])); ?></td>
                    <td  hidden><?php echo $row['sat_aval'] ?></td>
                </tr>
                
                <tr <?php if($row['sun_aval']=="no" || $row['sun_aval']=="") echo "hidden" ?>>
                    <td>sun</td>
                    <td style="text-align: center"><?php echo date("g:i a", strtotime($row['sun_from']))." to ".date("g:i a", strtotime($row['sun_to'])); ?></td>
                    <td  hidden><?php echo $row['sun_aval'] ?></td>
                </tr>
                
                <tr <?php if($row['mon_aval']=="no" || $row['mon_aval']=="") echo "hidden" ?>>
                    <td>mon</td>
                    <td style="text-align: center"><?php echo date("g:i a", strtotime($row['mon_from']))." to ".date("g:i a", strtotime($row['mon_to'])); ?></td>
                    <td  hidden><?php echo $row['mon_aval'] ?></td>
                </tr>
                
                <tr <?php if($row['tues_aval']=="no" || $row['tues_aval']=="") echo "hidden" ?>>
                    <td>tues</td>
                    <td style="text-align: center"><?php echo date("g:i a", strtotime($row['tues_from']))." to ".date("g:i a", strtotime($row['tues_to'])); ?></td>
                    <td  hidden><?php echo $row['tues_aval'] ?></td>
                </tr>
                
                <tr <?php if($row['wed_aval']=="no" || $row['wed_aval']=="") echo "hidden" ?>>
                    <td>wed</td>
                    <td style="text-align: center"><?php echo date("g:i a", strtotime($row['wed_from']))." to ".date("g:i a", strtotime($row['wed_to'])); ?></td>
                    <td hidden><?php echo $row['wed_aval'] ?></td>
                </tr>

                <tr <?php if($row['thur_aval']=="no" || $row['thur_aval']=="") echo "hidden" ?>>
                    <td>thur</td>
                    <td style="text-align: center"><?php echo date("g:i a", strtotime($row['thur_from']))." to ".date("g:i a", strtotime($row['thur_to'])); ?></td>
                    <td  hidden><?php echo $row['thur_aval'] ?></td>
                </tr>

                <tr <?php if($row['fri_aval']=="no" || $row['fri_aval']=="") echo "hidden" ?>>
                    <td>fri</td>
                    <td style="text-align: center"><?php echo date("g:i a", strtotime($row['fri_from']))." to ".date("g:i a", strtotime($row['fri_to'])); ?></td>
                    <td hidden><?php echo $row['fri_aval'] ?></td>
                </tr>
                
                
            </table>
<br>
        <span style="color: #000099;"><?php if($onleave) echo "Doctor is on leave.Schedules will be available from"." ".date('d-M-Y',strtotime($row['will_join'])) ?></span>

        <input type="hidden" id="sat_aval" value="<?php echo $row['sat_aval'] ?>">
        <input type="hidden" id="sun_aval" value="<?php echo $row['sun_aval'] ?>">
        <input type="hidden" id="mon_aval" value="<?php echo $row['mon_aval'] ?>">
        <input type="hidden" id="tues_aval" value="<?php echo $row['tues_aval'] ?>">
        <input type="hidden" id="wed_aval" value="<?php echo $row['wed_aval'] ?>">
        <input type="hidden" id="thur_aval" value="<?php echo $row['thur_aval'] ?>">
        <input type="hidden" id="fri_aval" value="<?php echo $row['fri_aval'] ?>">
        <input type="hidden" id="s_id" value="<?php echo $row['s_id'] ?>">
        <input type="hidden" id="uid" value="<?php
                    if(isset($_SESSION['uid']))
                    {
                        echo $_SESSION['uid'];
                        $date = date('Y-m-d');
                        $uid = (int)$_SESSION['uid'];
                        $sid = (int)$_GET['sid'];
                        $sql="SELECT COUNT(*) as coming FROM appointment WHERE userid={$uid} AND  day_of_appointment>='{$date}'";
                        $result=mysqli_query($connection,$sql);
                        $row = mysqli_fetch_assoc($result);
                        $total=(int)$row['coming'];
                        $sql="SELECT COUNT(*) this FROM appointment WHERE userid={$uid} AND  day_of_appointment>='2017-12-05' AND schedule_id={$sid}";
                        $result=mysqli_query($connection,$sql);
                        $row = mysqli_fetch_assoc($result);
                        $this_doc=(int)$row['this'];
                        $other = $total-$this_doc;
                        $disable_app=false;


        }
                    else
                        echo "0";?>">



    </div>
    <div class="column one_half">
           <span style="color: red">
                <?php

                if(isset($this_doc) && $this_doc==2)
                {
                    echo "Sorry, You have taken upcoming 2 schedules for this doctor";
                    $disable_app=true;
                }
                elseif(isset($other) && ($other+$this_doc)===5){
                    echo "Sorry, Your upcoming appointment limit exceed";
                    $disable_app=true;
                }
                ?>
           </span>


        <form id="app_form" >

            <div class="row" <?php if(isset($disable_app) && $disable_app==true) echo "hidden" ?>>
                <div class="col-md-1"><input type="checkbox" id="use_profile" name="use_profile"></div>
                <div class="col-md-6"><p>Use my Profile</p></div>
            </div>


            <label>Patient Name</label>
            <input type="text" class="form-control" name="name" id="name" onkeyup="check_form()"  required>
            <span id="name_error" style="color: #000099"></span>
            <br>


            <div class="row">
                <div class="col-md-6">
            <label>Date of Birth</label>

            <input type="date" class="form-control" name="dob" max="<?php echo date("Y-m-d"); ?>" id="dob" onchange='cal_age()' required>
                    </div>
                <div class="col-md-4">
                    <label>Age</label>
                    <input type="text" class="form-control" name="age" disabled id="age" >
                </div>
            </div>
            <br>
<div>
            <div class="row">
                <div class="col-md-8">
                <label>Appointment Date</label>
                <input  type="date" required name="app_date"
                        min="<?php if($onleave) echo Date('Y-m-d',strtotime($will_join)); else echo Date('Y-m-d')  ?>" max="<?php
                                    if($onleave)
                                        echo Date('Y-m-d',strtotime($will_join. '+30 days'));
                                     else
                                         echo Date("Y-m-d",strtotime("+30 days"));

                ?>"  id="app_date" class="form-control" onchange="check_doctor_availability()">
                </div>
            </div>
            <span id="app_error" style="color: #dd1144"></span>
            <br>

            <div class="row">
                <div class="col-md-8">
                    <label>Contact no.</label>
                    <input type="text" name="contact" id="contact" onkeyup="check_form()" placeholder="01XXXXXXXXX" class="form-control" required>
                    <span id="contact_error" style="color: #000099"></span>
                    </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-12">
                <label>Choose the chronic diseases below if you have</label>
                </div>

            </div>

            <div class="row">
               <div class="col-md-1"><input type="checkbox" id="c1" class="chronics" value="asthma"></div>
                <div class="col-md-6">Asthma</div>
            </div>

            <div class="row">
                <div class="col-md-1"><input type="checkbox" class="chronics" id="c2" value="cardiac"></div>
                <div class="col-md-6">Cardiac failure</div>
            </div>


            <div class="row">
                <div class="col-md-1"><input type="checkbox" class="chronics" id="c3" value="chronic_kidney"></div>
                <div class="col-md-6">Chronic kidney disease</div>
            </div>


            <div class="row">
                <div class="col-md-1"><input type="checkbox" id="c4" class="chronics" value="diabetes"></div>
                <div class="col-md-10">Diabetes mellitus (type 1 and type 2)</div>
            </div>

            <div class="row">
                <div class="col-md-1"><input type="checkbox" id="c5" class="chronics" value="hyperlipidaemia"></div>
                <div class="col-md-10">Hyperlipidaemia (high cholesterol)</div>
            </div>

            <div class="row">
                <div class="col-md-1"><input type="checkbox" id="c6" class="chronics" value="hypertension"></div>
                <div class="col-md-10">Hypertension (high blood pressure)</div>
            </div>

</div>

            <br>
               <button type="submit" class="btn-primary " <?php if($disable_app) echo "disabled" ?>>Appoint</button>
        </form>

        </div>





    </div>


</div>

<!-- Modal HTML -->
<div id="success_modal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>
                <h4 class="modal-title">Appointed!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Your Serial is</p>
                <p class="text-center" style="color: red;font-size: larger" id="serial"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" onclick="window.location='index.php';" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>





<script src="Bootstrap/js/jquery.min.js"></script>
<script src="Bootstrap/js/bootstrap.min.js"></script>


<script type="text/javascript">

    var form = true;
    var max;
    function cal_age()
    {
        var today = new Date();
        var birthDate = new Date($("#dob").val());
        //console.log(birthDate);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate()))
        {
            age--;
        }
        document.getElementById("age").value = age;


    }

   function check_doctor_availability(){
       var appoint_date = new Date($("#app_date").val());
       var day = appoint_date.getDay();


       var day_check = [$("#sun_aval").val(),$("#mon_aval").val(),$("#tues_aval").val(),
           $("#wed_aval").val(),$("#thur_aval").val(),$("#fri_aval").val(),$("#sat_aval").val()];
      // console.log(day_check[day]);

       var weekday = new Array(7);
       weekday[0] =  "sun_max";
       weekday[1] = "mon_max";
       weekday[2] = "tues_max";
       weekday[3] = "wed_max";
       weekday[4] = "thur_max";
       weekday[5] = "fri_max";
       weekday[6] = "sat_max";

       var which_day_max = weekday[day];
       max = which_day_max;
       var appointment_date = appoint_date.toISOString().substr(0,10);
       var sid = $("#s_id").val();

       if(day_check[day]=="no"){

           document.getElementById("app_date").value = "";
           document.getElementById('app_error').innerHTML  = "!!Doctor is not Available in this Day!!";
       }


    else{

           $.ajax({

               url: 'action.php',
               type: "POST",
               datatype: 'json',
               data : ({sid:sid,day_max:which_day_max,app_date:appointment_date,check_schedule:true}),
               success: function(data){
                   var returnedData = JSON.parse(data);
                   if(returnedData=="full"){
                       document.getElementById('app_error').innerHTML= "Appointment is full try another day";
                       document.getElementById("app_date").value = "";
                   }
                   if(returnedData=="slot") {
                       document.getElementById('app_error').innerHTML  = "Appointment is available";

                   }


               }



           });

    }


    }


    $(function() {

        // Get the form fields and hidden div
        var checkbox = $("#use_profile");

        checkbox.change(function() {
            if (checkbox.is(':checked')) {


                var uid = $("#uid").val();
                $.ajax({
                    url: 'action.php',
                    type: "POST",
                    datatype: 'json',
                    data : ({uid:uid,profile:true}),
                    success: function(data){
                        var returnedData = JSON.parse(data);

                        document.getElementById("name").value = returnedData.name;
                        document.getElementById("contact").value = returnedData.cell;

                    }
                })





            }
            else {

                document.getElementById("name").value = "";
                document.getElementById("contact").value = "";




            }
        });
    });




        $( "#app_form" ).on( "submit", function( event ) {
            event.preventDefault();


            if(form==true){

                var data = $("#app_form").serializeArray();
                data.push({name: 'appointment', value: 'true'});
                data.push({name: 'sid', value: $("#s_id").val()});
                data.push({name: 'uid', value:$("#uid").val()});
                data.push({name: 'max', value:max});
                $('.chronics:checked').each(function(){
                    data.push({name: $(this).attr('value'),value: $(this).is(":checked")});

                });
                console.log(data);


                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: data,
                    dataType: "json",
                    success: function(data) {
                        document.getElementById('serial').innerHTML  = data.serial;
                        $('#success_modal').modal('show');
                        console.log(data.affected,data.serial);


                    }
                });
            }
            else{
                alert("Filling up form Error");
            }




        });





    function check_form(){
        var name =$("#name").val();
        var contact = $("#contact").val();
        if(name==""){
            document.getElementById('name_error').innerHTML="Name should not be empty";
        }
        else if (name.length > 25 || (name.length<5 && name.length>2 ))
        {
            document.getElementById('name_error').innerHTML="Name should be between 5 to 25 characters";
            form=false;
        }
        else if (/[^a-zA-Z\- ]/.test( name ))
        {
            document.getElementById('name_error').innerHTML="Name can only contain alphabets";
            form=false;
        }
        else{
            document.getElementById('name_error').innerHTML="";
            form=true;
        }


        if (contact.length<11 || contact.length>11 )
        {
            document.getElementById('contact_error').innerHTML="contact should be 11 digits";
            form=false;
        }
        else if (isNaN(contact))
        {
            document.getElementById('contact_error').innerHTML="Must input numbers";
            form=false;
        }

        else{
            document.getElementById('contact_error').innerHTML="";
            form=true;
        }


    }

        if($("#uid").val()=='0'){
            alert("!!Taking Appointment Requires Sign or Signup!!");
            window.location='index.php';
        }


</script>


</body>

</html>






