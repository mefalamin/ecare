<?php


$hid=(int)$_SESSION['hid_seeing'];
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
  female_ward_rate,
  icu_remaining,
  ccu_remaining,
  single_remaining,
  share_remaining,
   male_ward_remaining,
  female_ward_remaining
  FROM hospitals_room
  WHERE hospital_id={$hid}";
$result=mysqli_query($connection,$sql);
$count=0;
if($result){
    $count=mysqli_num_rows($result);
}
$row=mysqli_fetch_assoc($result);



?>


<style>
    .table_custom{
        text-align: center
    }
    .mymeter{
        width: 200px; height: 20px
    }
    th{
        text-align: center;
        background-color: black;
    }
    td{
        text-align: center;
        color: black;
        padding: 10px;
    }
    meter{
        width: 200px; height: 20px;

    }




</style>

<div id="room" class="tab-pane fade" style="padding: 50px" >

    <input type="hidden" id="login" value="<?php if(isset($_SESSION['uid'])) echo "true"; else echo "false" ?>">
    <input type="hidden" id="uid" value="<?php if(isset($_SESSION['uid'])) echo $_SESSION['uid']; ?>">
    <div class="content">

        <?php
        if($count>0){
            ?>

            <table>
                <thead >
                <tr>
                    <th>Category</th>
                    <th style="width: 150px">Rate (Per Day BDT)</th>
                    <th>Availability</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr <?php if($row['icu_aval']=="no") echo "hidden" ?> >
                    <td>ICU</td>
                    <td><?php echo $row['icu_rate'] ?></td>
                    <td><meter value="<?php echo $row['icu_remaining'] ?>" max="<?php echo $row['icu_quantity'] ?>"></meter> </td>
                    <td><button class="button" <?php if($row['icu_remaining']=="0") echo "disabled" ?> data-id="ICU" onclick="booking(this)" >Book</button> </td>
                </tr>
                <tr <?php if($row['ccu_aval']=="no") echo "hidden" ?> >
                    <td>CCU</td>
                    <td><?php echo $row['ccu_rate'] ?></td>
                    <td><meter value="<?php echo $row['ccu_remaining'] ?>" max="<?php echo $row['ccu_quantity'] ?>"></meter> </td>
                    <td><button class="button" <?php if($row['ccu_remaining']=="0") echo "disabled" ?> data-id="CCU" onclick="booking(this)" >Book</button> </td>
                </tr>

                <tr <?php if($row['single_aval']=="no") echo "hidden" ?> >
                    <td>Single Cabin</td>
                    <td><?php echo $row['single_rate'] ?></td>
                    <td><meter value="<?php echo $row['single_remaining'] ?>" max="<?php echo $row['single_quantity'] ?>"></meter> </td>
                    <td><button class="button" <?php if($row['single_remaining']=="0") echo "disabled" ?> data-id="Single Cabin" onclick="booking(this)" >Book</button> </td>
                </tr>
                <tr <?php if($row['share_aval']=="no") echo "hidden" ?> >
                    <td>Shared Cabin</td>
                    <td><?php echo $row['share_rate'] ?></td>
                    <td><meter value="<?php echo $row['share_remaining'] ?>" max="<?php echo $row['share_quantity'] ?>"></meter> </td>
                    <td><button class="button" <?php if($row['share_remaining']=="0") echo "disabled" ?> data-id="Shared Cabin" onclick="booking(this)" >Book</button> </td>
                </tr>
                <tr <?php if($row['male_ward_aval']=="no") echo "hidden" ?> >
                    <td>Male Ward</td>
                    <td><?php echo $row['male_ward_rate'] ?></td>
                    <td><meter value="<?php echo $row['male_ward_remaining'] ?>" max="<?php echo $row['male_ward_quantity'] ?>"></meter> </td>
                    <td><button class="button" <?php if($row['male_ward_remaining']=="0") echo "disabled" ?> data-id="Male Ward" onclick="booking(this)" >Book</button> </td>
                </tr>
                <tr <?php if($row['female_ward_aval']=="no") echo "hidden" ?> >
                    <td>Female Ward</td>
                    <td><?php echo $row['female_ward_rate'] ?></td>
                    <td><meter value="<?php echo $row['female_ward_remaining'] ?>" max="<?php echo $row['female_ward_quantity'] ?>"></meter> </td>
                    <td><button class="button" <?php if($row['female_ward_remaining']=="0") echo "disabled" ?> data-id="Female Ward" onclick="booking(this)" >Book</button> </td>
                </tr>




                </tbody>
            </table>
        <?php
        }
        else{
            echo '<span style="color: #000099;font-size: large">Sorry No Room Found for this</span>';
        }
        ?>

        <br>

    </div>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <h4>Ooops!</h4>
                    <p>Booking needs to be logged in</p>
                    <button class="btn btn-success" data-dismiss="modal">Try Again</button>
                </div>
            </div>
        </div>
    </div>

    <div id="booking_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">


                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="memberModalLabel" align="center">Book Your Room</h4>
                </div>
                <div class="modal-body">

                    <form id="booking_form" >
                        <div class="col-md-2"></div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>Patient Name</label>
                                <input type="text" class="form-control" name="pat_name" id="pat_name" required>
                                <br>
                                <label>Age</label>
                                <input type="text" class="form-control" name="pat_age" id="pat_age" required>
                                <br>
                                <label>Reason Of Booking</label>
                                <textarea name="reason" id="reason" class="form-control" required></textarea>
                                <br>
                                <label>Contact</label>
                                <input type="text" class="form-control" name="pat_contact" id="pat_contact" required>
                                <br>
                                <label>Booking For</label>
                                <input type="text" readonly class="form-control" name="booking_cat" id="booking_cat">

                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button class="button">Book</button>
                    <button class="button" type="submit"   data-dismiss="modal">Close</button>

                </div>
                </form>
            </div>



        </div>

    </div>




    <div id="error_modal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <h4>Ooops!</h4>
                    <p>You have already two bookings on process</p>
                    <button class="btn btn-success" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="success_booking" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-center">
                <h4>Great!</h4>
                <p>Your Booking is  processing</p>
                <button class="btn btn-success" onClick="window.location.reload()" data-dismiss="modal"><span>OK</span></button>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
        var count,chosen,hid,uid;
        function booking(button){
            var login=$('#login').val();

            chosen = $(button).data('id');
             hid = $('#hid').val();
             uid = $('#uid').val();

            var data={"uid":uid,"booking_check":true};

            $.ajax({
                type: "POST",
                url: "action.php",
                data: data,
                dataType: "json",
                success: function(data) {
                    count=parseInt(data);
                    console.log(count);

                }
            });


            if(login=="false"){
                $('#myModal').modal('show');
            }
            else if(count>=2)
            {
                $('#error_modal').modal('show');
            }
            else
            {
                $('#booking_modal').modal('show');

            }


        }

        $(document).ready(function(){

            $("#booking_modal").on('shown.bs.modal', function(){

                $(this).find('#pat_name').focus();
                document.getElementById('booking_cat').value=chosen;

            });

        });




        $( "#booking_form" ).on( "submit", function( event ) {
            event.preventDefault();




                var data= $("#booking_form").serializeArray();
                data.push({name: 'hid', value: hid});
                data.push({name: 'uid', value:uid});
                data.push({name: 'booking', value:true});
                console.log(data);

          //  $('#success_booking').modal('show');


                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: data,
                    dataType: "json",
                    success: function(data) {

                      if(data=='booked')
                      {
                          $('#success_booking').modal('show');
                      }
                        else{
                          alert("Failed , Please try again later");
                      }

                    }
                });

        });


    </script>