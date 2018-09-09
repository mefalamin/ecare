<?php
include("../../includes/db_connection.php");
include("header.php");


$tab=0;
if(isset($_GET['tab'])){
    $tab=$_GET['tab'];
}

if(isset($_GET['hid'])){
   $_SESSION['hid_seeing']=$_GET['hid'];
}



$hid=(int)$_SESSION['hid_seeing'];
$sql = "SELECT * FROM hospital where hospital_id={$hid} ";
$result= mysqli_query($connection,$sql);
$hospital=mysqli_fetch_assoc($result);
//print_r($hospital);

?>
    <input type="hidden" id="hid" name="hid" value="<?php echo $_SESSION['hid_seeing'] ?>">

    <div class="modal fade" id="schedule_modal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">


            </div>
        </div>
    </div>

    <div class="container-fluid">

    <div class="col-md-2"></div>

        <div class="col-md-8" style="background-color: #e5e5e5">
            <br>
            <h2 class="title"><?php echo $hospital['name'] ?></h2>

            <ul class="nav nav-tabs">
                <li <?php if(!isset($_GET['search_doctor']) ) echo 'class="active" ' ?> ><a data-toggle="tab" href="#home">Details</a></li>
                <li <?php if(isset($_GET['search_doctor']) ) echo 'class="active" ' ?>><a data-toggle="tab" href="#doctor">Doctors</a></li>
                <li><a data-toggle="tab" href="#room">Room Booking</a></li>
                <li><a data-toggle="tab" href="#rating">Rating/Feedback</a></li>

            </ul>

            <div class="tab-content" style="background-color:#f8f6f8;min-height: 400px"  >


                <?php include "detail_about.php" ?>

                <?php include "detail_room.php" ?>

                <?php include "detail_rating.php" ?>
                <?php include "detail_doctor.php" ?>


            </div>
            <br>
            <br>

    </div>

    </div>



    <script>

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





        $('#schedule_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('id'); // Extract info from data-* attributes
            var modal = $(this);
            var dataString = 'id=' + recipient;
            var data = {"hid": $('#hid').val(),"id": recipient,"this_hid_only":true };

            //console.log(data);
            $.ajax({
                type: "GET",
                url: "schedule_modal.php",
                data: data,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.modal-content').html(data);

                },
                error: function(err) {
                    console.log(err);
                }
            });
        });



    </script>


    <?php include "footer.php"; ?>
