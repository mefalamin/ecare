<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
header("location:/project/public/admin/login/login.php");

}
echo $_SESSION['org_id'] . " " . $_SESSION['admin_id'] . " " . $_SESSION['admin_name'] . " " . $_SESSION['owner'];


$current_file = basename($_SERVER['PHP_SELF']);
include('header.php');
include('../../../includes/db_connection.php');

$org_id=(int)$_SESSION['org_id'];
$sql="SELECT
icu_aval,
icu_quantity,
icu_rate,
ccu_aval,
ccu_quantity,
ccu_rate,
single_aval,
single_quantity,
single_rate,
share_aval,
share_quantity,
share_rate,
male_ward_aval,
male_ward_quantity,
male_ward_rate,
female_ward_aval,
female_ward_quantity,
female_ward_rate
FROM hospitals_room
WHERE hospital_id={$org_id}";
$result=mysqli_query($connection,$sql);
$row=mysqli_fetch_assoc($result);


?>


<div class="content">
<div class="container-fluid">

<div class="row">
<div class="col-md-8">
<div class="card">
    <div class="header">
        <h4 class="title" style="text-align: center">Manage Rooms of Your Hospital</h4>
    </div>
    <div class="content">
        <form method="post" id="room">
                <div class="table-responsive">
                <table id="ver-minimalist">
                    <thead>
                    <tr>
                        <th>Availability</th>
                        <th>Category</th>
                        <th>Rate (Per Day BDT)</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="text-align: center"><input type="checkbox" id="icu_check"
                                                              name="icu_check" <?php if($row['icu_aval']=="yes") echo "checked"  ?> ></td>
                        <td>ICU</td>
                        <td><input type="text" class="form-control" id="icu_rate" name="icu_rate" value="<?php echo $row['icu_rate']?>" ></td>
                        <td><input type="number" min="0" class="form-control" placeholder="no.of icu"
                                   value="<?php echo $row['icu_quantity']?>" id="icu_quantity" name="icu_quantity" ></td>

                    </tr>
                    <tr>
                        <td style="text-align: center"><input
                                type="checkbox" id="ccu_check" name="ccu_check" <?php if($row['ccu_aval']=="yes") echo "checked"  ?> ></td>
                        <td>CCU</td>
                        <td><input type="text" class="form-control" id="ccu_rate" name="ccu_rate" value="<?php echo $row['ccu_rate']?>"></td>
                        <td><input type="number" min="0" class="form-control" placeholder="no.of ccu"
                                   value="<?php echo $row['ccu_quantity'] ?>" id="ccu_quantity" name="ccu_quantity" ></td>

                    </tr>
                    <tr>
                        <td style="text-align: center"><input type="checkbox" <?php if($row['single_aval']=="yes") echo "checked"  ?>
                                                              id="single_check" name="single_check" ></td>
                        <td>Single Cabin</td>
                        <td><input type="text" class="form-control" id="single_rate" name="single_rate" value="<?php echo $row['single_rate']?>"></td>
                        <td><input type="number" min="0" class="form-control" placeholder="no.of single"
                                   value='<?php echo $row['single_quantity']?>' id="single_quantity" name="single_quantity" ></td>

                    </tr>
                    <tr>
                        <td style="text-align: center"><input type="checkbox"
                                <?php if($row['share_aval']=="yes") echo "checked" ?> id="share_check" name="share_check" ></td>
                        <td>Shared Cabin</td>
                        <td><input type="text" class="form-control" id="share_rate" name="share_rate" value="<?php echo $row['share_rate'] ?>"></td>
                        <td><input type="number" min="0" class="form-control" placeholder="no.of share"
                                   value='<?php echo $row['share_quantity'] ?>' id="share_quantity" name="share_quantity" ></td>

                    </tr>
                    <tr>
                        <td style="text-align: center"><input type="checkbox" <?php if($row['male_ward_aval']=="yes") echo "checked"  ?>
                                                              id="male_ward_check" name="male_ward_check" ></td>
                        <td>Male Ward</td>
                        <td><input type="text" class="form-control" id="male_ward_rate" name="male_ward_rate" value="<?php echo $row['male_ward_rate'] ?>" ></td>
                        <td><input type="number" min="0" class="form-control" placeholder="no.of male_ward"
                                   value='<?php echo $row['male_ward_quantity'] ?>' id="male_ward_quantity" name="male_ward_quantity" ></td>

                    </tr>
                    <tr>
                        <td style="text-align: center"><input type="checkbox" <?php if($row['female_ward_aval']=="yes") echo "checked"  ?>
                                                              id="female_ward_check" name="female_ward_check" ></td>
                        <td>Female Ward</td>
                        <td><input type="text" class="form-control" id="female_ward_rate" name="female_ward_rate" value="<?php echo $row['female_ward_rate'] ?>" ></td>
                        <td><input type="number" min="0" class="form-control" placeholder="no.of female_ward"
                                   value='<?php echo $row['female_ward_quantity'] ?>' id="female_ward_quantity" name="female_ward_quantity" ></td>

                    </tr>

                    </tbody>
                </table>
                </div>
            <br>

            <div class="row">

                <div class="col-lg-1"></div>

                <div class="col-md-8">
                    <div class="text animated bounce" id="updated" style="color: #000099">Updated</div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
                    <div class="clearfix"></div>
                </div>
            </div>



        </form>


    </div>
</div>
</div>


</div>
</div>
</div>


</div>
<input type="hidden" name="org_id" id="org_id" value="<?php  echo $_SESSION['org_id'] ?>">


<script type="text/javascript">

$(document).ready(function(){

$('#icu_check').click(function()
{
    //If checkbox is checked then disable or enable input
    if ($(this).is(':checked'))
    {

        $('#icu_rate').prop('disabled', false);
        $('#icu_quantity').prop('disabled', false);


    }
    //If checkbox is unchecked then disable or enable input
    else
    {
        $('#icu_rate').prop('disabled', true);
        $('#icu_quantity').prop('disabled', true);


    }
});

$('#ccu_check').click(function()
{
    //If checkbox is checked then disable or enable input
    if ($(this).is(':checked'))
    {

        $('#ccu_rate').prop('disabled', false);
        $('#ccu_quantity').prop('disabled', false);


    }
    //If checkbox is unchecked then disable or enable input
    else
    {
        $('#ccu_rate').prop('disabled', true);
        $('#ccu_quantity').prop('disabled', true);


    }
});
$('#single_check').click(function()
{
    //If checkbox is checked then disable or enable input
    if ($(this).is(':checked'))
    {

        $('#single_rate').prop('disabled', false);
        $('#single_quantity').prop('disabled', false);


    }
    //If checkbox is unchecked then disable or enable input
    else
    {
        $('#single_rate').prop('disabled', true);
        $('#single_quantity').prop('disabled', true);


    }
});

$('#share_check').click(function()
{
    //If checkbox is checked then disable or enable input
    if ($(this).is(':checked'))
    {

        $('#share_rate').prop('disabled', false);
        $('#share_quantity').prop('disabled', false);


    }
    //If checkbox is unchecked then disable or enable input
    else
    {
        $('#share_rate').prop('disabled', true);
        $('#share_quantity').prop('disabled', true);


    }
});
$('#male_ward_check').click(function()
{
    //If checkbox is checked then disable or enable input
    if ($(this).is(':checked'))
    {

        $('#male_ward_rate').prop('disabled', false);
        $('#male_ward_quantity').prop('disabled', false);


    }
    //If checkbox is unchecked then disable or enable input
    else
    {
        $('#male_ward_rate').prop('disabled', true);
        $('#male_ward_quantity').prop('disabled', true);


    }
});

$('#female_ward_check').click(function()
{
    //If checkbox is checked then disable or enable input
    if ($(this).is(':checked'))
    {

        $('#female_ward_rate').prop('disabled', false);
        $('#female_ward_quantity').prop('disabled', false);


    }
    //If checkbox is unchecked then disable or enable input
    else
    {
        $('#female_ward_rate').prop('disabled', true);
        $('#female_ward_quantity').prop('disabled', true);


    }
});
});
document.getElementById('updated').style.visibility = "hidden";

$( "#room" ).on( "submit", function( event ) {
event.preventDefault();




    var data = $("#room").serializeArray();
    data.push({name: 'room_set', value: 'true'});
    data.push({name: 'org_id', value: $("#org_id").val()});



    console.log(data);


    $.ajax({
        type: "POST",
        url: "action.php",
        data: data,
        dataType: "json",
        success: function(data) {

           if(data=="updated"){
               document.getElementById('updated').style.visibility = "visible";
           }



        }
    });






});




</script>

