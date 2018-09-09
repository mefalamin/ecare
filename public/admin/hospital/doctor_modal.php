<?php

include('../../../includes/db_connection.php');

$schedule_id = $_GET['id'];
$schedule_id=(int)$schedule_id;
$sql="SELECT
       d.doctor_id
      ,d.name
      ,d.speciality
      ,d.qualification
      ,d.contact
      ,s.doctor_asst_contact
      ,s.fee
      ,s.availability
      ,s.room
      ,will_join
        , s.sat_aval
        , s.sat_from
        , s.sat_to
        , s.sat_max
        , s.sun_aval
        , s.sun_from
        , s.sun_to
        , s.sun_max
        , s.mon_aval
        , s.mon_from
        , s.mon_to
        , s.mon_max
        , s.tues_aval
        , s.tues_from
        , s.tues_to
        , s.tues_max
        , s.wed_aval
        , s.wed_to
        , s.wed_from
        , s.wed_max
        , s.thur_aval
        , s.thur_from
        , s.thur_to
        , s.thur_max
        , s.fri_aval
        , s.fri_from
        , s.fri_to
        , s.fri_max
      FROM doctor d,schedule s
      WHERE d.doctor_id=s.doctor_id AND
      s.schedule_id=$schedule_id";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($result);
    $doctor_id = $row['doctor_id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">




</head>
<body>

<form method="post" action="" role="form" id="doc_form">
    <div class="modal-body">
        <div class="form-group">

       <input type="hidden" name="doctor_id"   value="<?php echo $doctor_id ?>" >
        <input type="hidden" name="schedule_id"  value="<?php echo $schedule_id ?>"

        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" readonly id="name" name="name" value="<?php echo $row['name'];?>" />
        </div>
        <div class="form-group">
            <label>Speciality</label>
            <input type="text" class="form-control" id="speciality" name="speciality" readonly value="<?php echo $row['speciality'];?>" />
        </div>
        <div class="form-group">
            <label>Qualification</label>
            <textarea rows="4" readonly class="form-control"><?php echo $row['qualification'];?></textarea>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Doctor's Contact</label>
                    <input type="text" class="form-control" name="doctor_contact" required value="<?php echo $row['contact'];?>" />
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Doctor's Assistant Contact</label>
                    <input type="text" class="form-control" name="doctor_asst_contact" required value="<?php echo $row['doctor_asst_contact'] ;?>" />
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Fee</label>
                    <input type="text" placeholder="BDT" class="form-control" name="fee" required id="fee" value="<?php echo $row['fee'];?>" />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                <label>Availability</label>
                    <br>
                <input type="checkbox" id="availability" name="availability" class="form-control" <?php if($row['availability']==="yes"){ echo 'checked'; } ?> >
                </div>
            </div>
            <div class="col-md-4">
                <br>
                <div class="form-group" id="join" <?php if($row['availability']==="yes"){ echo 'hidden'; } ?>>

                    <input type="date" id="will_join" name="will_join"  class="form-control"
                           data-toggle="popover" data-trigger="hover" value="<?php echo $row['will_join'] ?>"
                           data-content="Doctor will be available From this Date? Selecting No Date will Make this doctor Hidden From Your Hospital"

                        >

                </div>
                </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Room No.</label>
                    <br>
                    <input type="text" id="room" value="<?php echo $row['room'] ?>" name="room" class="form-control">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="box-table-b">
                <thead>
                <tr>
                    <td><b>Day</b></td>
                    <td><b>From</b></td>
                    <td><b>To</b></td>
                    <td><b>Off Day</b></td>
                    <td><b>Maximum Patient</b></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Sat</td>
                    <td><input type="time" id="sat_from" name="sat_from" value="<?php

                        if($row['sat_aval']==="yes"){
                            echo $row['sat_from'];
                        }
                        else{
                            echo "";
                        }
                        ?>"></td>
                    <td><input type="time"  id="sat_to" name="sat_to" value="<?php

                        if($row['sat_aval']==="yes"){
                            echo $row['sat_to'];
                        }
                        else{
                            echo "";
                        }



                        ?>"></td>
                    <td><input type="checkbox" id="sat_aval" name="sat_aval"<?php if($row['sat_aval']==="yes"){ echo 'unchecked';}else echo 'checked' ?>></td>
                    <td><input type="number"  id="sat_max" name="sat_max" value="<?php
                        if($row['sat_aval']==="yes"){
                            echo $row['sat_max'];
                        }
                       else{
                           echo 0;
                       }
                        ?>" ></td>
                </tr>

                <tr>
                    <td>Sun</td>
                    <td><input type="time" id="sun_from" name="sun_from" value="<?php

                        if($row['sun_aval']==="yes"){
                            echo $row['sun_from'];
                        }
                        else{
                            echo "";
                        }
                        ?>"></td>
                    <td><input type="time"  id="sun_to" name="sun_to" value="<?php

                        if($row['sun_aval']==="yes"){
                            echo $row['sun_to'];
                        }
                        else{
                            echo "";
                        }



                        ?>"></td>
                    <td><input type="checkbox" id="sun_aval" name="sun_aval"<?php if($row['sun_aval']==="yes"){ echo 'unchecked';}else echo 'checked' ?>></td>
                    <td><input type="number"  id="sun_max" name="sun_max" value="<?php
                        if($row['sun_aval']==="yes"){
                            echo $row['sun_max'];
                        }
                        else{
                            echo 0;
                        }
                        ?>" ></td>

                </tr>

                <tr>
                    <td>Mon</td>
                    <td><input type="time" id="mon_from" name="mon_from" value="<?php

                        if($row['mon_aval']==="yes"){
                            echo $row['mon_from'];
                        }
                        else{
                            echo "";
                        }
                        ?>"></td>
                    <td><input type="time"  id="mon_to" name="mon_to" value="<?php

                        if($row['mon_aval']==="yes"){
                            echo $row['mon_to'];
                        }
                        else{
                            echo "";
                        }



                        ?>"></td>
                    <td><input type="checkbox" id="mon_aval" name="mon_aval"<?php if($row['mon_aval']==="yes"){ echo 'unchecked';}else echo 'checked' ?>></td>
                    <td><input type="number"  id="mon_max" name="mon_max" value="<?php
                        if($row['mon_aval']==="yes"){
                            echo $row['mon_max'];
                        }
                        else{
                            echo 0;
                        }
                        ?>" ></td>
                </tr>

                <tr>
                    <td>Tues</td>
                    <td><input type="time" id="tues_from" name="tues_from" value="<?php

                        if($row['tues_aval']==="yes"){
                            echo $row['tues_from'];
                        }
                        else{
                            echo "";
                        }
                        ?>"></td>
                    <td><input type="time"  id="tues_to" name="tues_to" value="<?php

                        if($row['tues_aval']==="yes"){
                            echo $row['tues_to'];
                        }
                        else{
                            echo "";
                        }



                        ?>"></td>
                    <td><input type="checkbox" id="tues_aval" name="tues_aval"<?php if($row['tues_aval']==="yes"){ echo 'unchecked';}else echo 'checked' ?>></td>
                    <td><input type="number"  id="tues_max" name="tues_max" value="<?php
                        if($row['tues_aval']==="yes"){
                            echo $row['tues_max'];
                        }
                        else{
                            echo 0;
                        }
                        ?>" ></td>
                </tr>

                <tr>
                    <td>Wed</td>
                    <td><input type="time" id="wed_from" name="wed_from" value="<?php

                        if($row['wed_aval']==="yes"){
                            echo $row['wed_from'];
                        }
                        else{
                            echo "";
                        }
                        ?>"></td>
                    <td><input type="time"  id="wed_to" name="wed_to" value="<?php

                        if($row['wed_aval']==="yes"){
                            echo $row['wed_to'];
                        }
                        else{
                            echo "";
                        }



                        ?>"></td>
                    <td><input type="checkbox" id="wed_aval" name="wed_aval"<?php if($row['wed_aval']==="yes"){ echo 'unchecked';}else echo 'checked' ?>></td>
                    <td><input type="number"  id="wed_max" name="wed_max" value="<?php
                        if($row['wed_aval']==="yes"){
                            echo $row['wed_max'];
                        }
                        else{
                            echo 0;
                        }
                        ?>" ></td>
                </tr>

                <tr>
                    <td>Thur</td>
                    <td><input type="time" id="thur_from" name="thur_from" value="<?php

                        if($row['thur_aval']==="yes"){
                            echo $row['thur_from'];
                        }
                        else{
                            echo "";
                        }
                        ?>"></td>
                    <td><input type="time"  id="thur_to" name="thur_to" value="<?php

                        if($row['thur_aval']==="yes"){
                            echo $row['thur_to'];
                        }
                        else{
                            echo "";
                        }



                        ?>"></td>
                    <td><input type="checkbox" id="thur_aval" name="thur_aval"<?php if($row['thur_aval']==="yes"){ echo 'unchecked';}else echo 'checked' ?>></td>
                    <td><input type="number"  id="thur_max" name="thur_max" value="<?php
                        if($row['thur_aval']==="yes"){
                            echo $row['thur_max'];
                        }
                        else{
                            echo 0;
                        }
                        ?>" ></td>
                </tr>

                <tr>
                    <td>Fri</td>
                    <td><input type="time" id="fri_from" name="fri_from" value="<?php

                        if($row['fri_aval']==="yes"){
                            echo $row['fri_from'];
                        }
                        else{
                            echo "";
                        }
                        ?>"></td>
                    <td><input type="time"  id="fri_to" name="fri_to" value="<?php

                        if($row['fri_aval']==="yes"){
                            echo $row['fri_to'];
                        }
                        else{
                            echo "";
                        }



                        ?>"></td>
                    <td><input type="checkbox" id="fri_aval" name="fri_aval"<?php if($row['fri_aval']==="yes"){ echo 'unchecked';}else echo 'checked' ?>></td>
                    <td><input type="number"  id="fri_max" name="fri_max" value="<?php
                        if($row['fri_aval']==="yes"){
                            echo $row['fri_max'];
                        }
                        else{
                            echo 0;
                        }
                        ?>" ></td>
                </tr>
                </tbody>
            </table>




    </div>
    <div class="modal-footer">
       <span id="confirm" style="color: #0044cc;position:inherit;float: left "></span>
        <button type="submit" class="btn btn-primary" id="update" name="update">Update</button>&nbsp;
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload()">Close</button>
    </div>
</form>
</body>
</html>

<script>


    $('#sat_aval').click(function()
    {
        //If checkbox is checked then disable or enable input
        if ($(this).is(':checked'))
        {

            $('#sat_from').prop('disabled', true);
            $('#sat_to').prop('disabled', true);
            $('#sat_max').prop('disabled', true);
            
        }
        //If checkbox is unchecked then disable or enable input
        else
        {
            $('#sat_from').prop('disabled', false);
            $('#sat_to').prop('disabled', false);
            $('#sat_max').prop('disabled', false);

        }
    });
    $('#sun_aval').click(function()
    {
        //If checkbox is checked then disable or enable input
        if ($(this).is(':checked'))
        {

            $('#sun_from').prop('disabled', true);
            $('#sun_to').prop('disabled', true);
            $('#sun_max').prop('disabled', true);

        }
        //If checkbox is unchecked then disable or enable input
        else
        {
            $('#sun_from').prop('disabled', false);
            $('#sun_to').prop('disabled', false);
            $('#sun_max').prop('disabled', false);

        }
    });
    $('#mon_aval').click(function()
    {
        //If checkbox is checked then disable or enable input
        if ($(this).is(':checked'))
        {

            $('#mon_from').prop('disabled', true);
            $('#mon_to').prop('disabled', true);
            $('#mon_max').prop('disabled', true);

        }
        //If checkbox is unchecked then disable or enable input
        else
        {
            $('#mon_from').prop('disabled', false);
            $('#mon_to').prop('disabled', false);
            $('#mon_max').prop('disabled', false);

        }
    });
    $('#tues_aval').click(function()
    {
        //If checkbox is checked then disable or enable input
        if ($(this).is(':checked'))
        {

            $('#tues_from').prop('disabled', true);
            $('#tues_to').prop('disabled', true);
            $('#tues_max').prop('disabled', true);

        }
        //If checkbox is unchecked then disable or enable input
        else
        {
            $('#tues_from').prop('disabled', false);
            $('#tues_to').prop('disabled', false);
            $('#tues_max').prop('disabled', false);

        }
    });
    $('#wed_aval').click(function()
    {
        //If checkbox is checked then disable or enable input
        if ($(this).is(':checked'))
        {

            $('#wed_from').prop('disabled', true);
            $('#wed_to').prop('disabled', true);
            $('#wed_max').prop('disabled', true);

        }
        //If checkbox is unchecked then disable or enable input
        else
        {
            $('#wed_from').prop('disabled', false);
            $('#wed_to').prop('disabled', false);
            $('#wed_max').prop('disabled', false);

        }
    });
    $('#thur_aval').click(function()
    {
        //If checkbox is checked then disable or enable input
        if ($(this).is(':checked'))
        {

            $('#thur_from').prop('disabled', true);
            $('#thur_to').prop('disabled', true);
            $('#thur_max').prop('disabled', true);

        }
        //If checkbox is unchecked then disable or enable input
        else
        {
            $('#thur_from').prop('disabled', false);
            $('#thur_to').prop('disabled', false);
            $('#thur_max').prop('disabled', false);

        }
    });
    $('#fri_aval').click(function()
    {
        //If checkbox is checked then disable or enable input
        if ($(this).is(':checked'))
        {

            $('#fri_from').prop('disabled', true);
            $('#fri_to').prop('disabled', true);
            $('#fri_max').prop('disabled', true);

        }
        //If checkbox is unchecked then disable or enable input
        else
        {
            $('#fri_from').prop('disabled', false);
            $('#fri_to').prop('disabled', false);
            $('#fri_max').prop('disabled', false);

        }
    });


    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });


    $(function() {

        // Get the form fields and hidden div
        var checkbox = $("#availability");
        var hidden = $("#join");



        // Setup an event listener for when the state of the
        // checkbox changes.
        checkbox.change(function() {
            if (checkbox.is(':checked')) {
                // Show the hidden fields.
                hidden.hide();

            } else {

                hidden.show();


            }
        });
    });



</script>
<script type="text/javascript">

    $( "#doc_form" ).on( "submit", function( event ) {
        event.preventDefault();

        var data = $("#doc_form").serializeArray();
        data.push({name: 'update', value: 'true'});
        console.log(data);
        $.ajax({
            type: "POST",
            url: "action.php",
            data: data,
            dataType: "json",
            success: function(data) {
                if(data.success){

                    document.getElementById('confirm').innerHTML=("Updated Successfully");

                }
                else
                alert("Error");

            }
        });
    });

</script>

<?php



?>