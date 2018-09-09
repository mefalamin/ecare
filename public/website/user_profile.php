
<?php
include("header.php");
include ("../../includes/db_connection.php");
if(!isset($_SESSION['uid'])){
    header("location:index.php");
}













?>



<br>
<div class="container-fluid" >


    <div class="col-md-2"></div>


    <div class="col-md-8" style="background-color:#e5e5e5">
        <br>
        <h2 style="text-align: center;"><b>Profile Setting</b></h2><br>
        <ul class="nav nav-tabs"style="background-color:inherit;">
            <li class="active"><a data-toggle="tab" href="#main">My Profile</a></li>
            <li><a data-toggle="tab" href="#appointment">Appointments</a></li>
            <li><a data-toggle="tab" href="#donor">My Donor Profile</a></li>


        </ul>
        <div class="tab-content" style="background-color:#f8f6f8;min-height: 400px">


            <?php include "user_profile/main_profile.php"; ?>
            <?php include "user_profile/user_appointment.php"; ?>
            <?php include "user_profile/donor_profile.php"; ?>



        </div>
        <br>
        <br>



    </div>



</div>
<br>
<div id="congratz" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-center">
                <h4>Congratulation</h4>
                <p>You have become a Blood Donor</p>
                <button class="btn btn-success" data-dismiss="modal" onclick="window.location='user_profile.php'"><span>OK</span> <i class="material-icons">&#xE5C8;</i></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">



    function validate_profile() {
        document.getElementById('confirm_name_update').innerHTML = "";
        document.getElementById('error_fname').innerHTML = "";
        document.getElementById('error_lname').innerHTML = "";
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var uid="<?php if(isset($_SESSION['test'])) echo $_SESSION['test']  ?>";
        console.log(fname, lname);
        var edit=true;
        if (!name_checker(fname)) {
            document.getElementById('error_fname').innerHTML = "Invalid First Name(Only A-z)";
            edit = false;
        }

        if (!name_checker(lname)) {
            document.getElementById('error_lname').innerHTML = "Invalid Last Name(Only A-z)";
            edit = false;
        }



        if(edit){

            var data={fname:fname,lname:lname,edit:true,uid:uid};
            console.log(data);
            $.ajax({
                type: "POST",
                url: "action.php",
                data: data,
                dataType: "json",
                success: function(data) {

                  if(data=="updated")
                      document.getElementById('confirm_name_update').innerHTML = "Updated";
                   else{
                      document.getElementById('confirm_name_update').innerHTML = "Error";
                  }

                }
            });
        }
    }
    function change_pass() {
        document.getElementById('current_error').innerHTML="";
        document.getElementById('success').innerHTML = "";
        document.getElementById('match_error').innerHTML = "";
        var change_pass = true;
        var curr_pass = $('#current_pwd').val();
        var new_pass = $('#new_pwd').val();
        var confirm_pass = $('#confirm_passwd').val();
        var uid = "<?php if(isset($_SESSION['test'])) echo $_SESSION['test']  ?>";

        if (new_pass != confirm_pass) {

            document.getElementById('match_error').innerHTML = "Confirm Password does not match";
            document.getElementById('confirm_passwd').focus();
            change_pass = false;
        }
        else
            document.getElementById('match_error').innerHTML = "";


        if(change_pass){

            var data={current:curr_pass,new:new_pass,uid:uid,pass_change:true};
            console.log(data);
            $.ajax({
                type: "POST",
                url: "action.php",
                data: data,
                dataType: "json",
                success: function(data) {

                    if(data=="mismatched")
                        document.getElementById('current_error').innerHTML = "Current Password Mismatched";
                    else{
                        if(data=="success")
                            document.getElementById('success').innerHTML = "Password Changed Successfully";
                       if(data=="fail")
                           document.getElementById('success').innerHTML = "Error! Password did not change";

                    }

                }


            });
        }
    }
    function name_checker(val)
    {
        var x=val;
        return /^[A-z ]+$/.test(x);
    }


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



    $( "#donor_form" ).on( "submit", function( event ) {
        event.preventDefault();
        document.getElementById('donor_notify').innerHTML = "";
            var uid="<?php if(isset($_SESSION['test'])) echo $_SESSION['test']  ?>";

           var become = "<?php if(isset($_GET['become'])) echo "1";else echo "0" ?>";
            var data = $("#donor_form").serializeArray();
            data.push({name: 'uid', value:uid});
            data.push({name: 'donor_update', value:true});
            data.push({name: 'become', value:become});
            console.log(data);


            $.ajax({
                type: "POST",
                url: "action.php",
                data: data,
                dataType: "json",
                success: function(data) {
                    if(data=="updated"){
                        document.getElementById('donor_notify').innerHTML = "Updated";

                    }
                    else if(data="congratz"){
                        $('#congratz').modal('show');
                    }
                    else{
                        document.getElementById('donor_notify').innerHTML = "!!Error!!";
                    }


                }
            });

    });




</script>


<?php
include ("footer.php");
?>
