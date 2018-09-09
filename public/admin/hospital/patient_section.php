<?php

session_start();
if (!isset($_SESSION["admin_id"])) {
    header("location:/project/public/admin/login/login.php");

}
echo $_SESSION['org_id']." ".$_SESSION['admin_id']." ".$_SESSION['admin_name']." ".$_SESSION['owner'];
$current_file = basename($_SERVER['PHP_SELF']);
?>

<?php


include('../../../includes/db_connection.php');

$org_id=(int)$_SESSION['org_id'];
$sql = "SELECT d.speciality from doctor d,schedule s WHERE d.doctor_id=s.doctor_id AND s.hospital_id={$org_id} GROUP BY d.speciality";
$result = mysqli_query($connection,$sql);


    include('header.php');
?>




        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#patient_list">Take Patient list</a></li>
            <li><a data-toggle="tab" href="#booking">Booking</a></li>

        </ul>
        <div class="tab-content">
                <br>
                    <div id="patient_list" class="tab-pane fade in active">
                        <div class="container-fluid">
                            <?php include('patient_list.php') ?>
                        </div>
                    </div>


            <div id="booking" class="tab-pane fade ">
                <div class="container-fluid">
                <?php include "booking.php"; ?>
                </div>
            </div>





        </div>


</div>
		
</div>

<input type="hidden" id="hospital_id" value="<?php if(isset($_SESSION['org_id'])) echo $_SESSION['org_id'] ?>">

</body>



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

    function fetch_doctor(val)
    {

        var org_id=$('#hospital_id').val();


       $.ajax({
            url: 'action.php',
            type: "POST",
            datatype: 'json',
            data : ({org_id:org_id,sp:val,see_list:true}),
            success: function(response){
                document.getElementById("doctors").innerHTML=response;
            }
        })
    }

</script>



</html>
		
		
		





