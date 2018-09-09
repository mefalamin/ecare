

<?php
include ('header.php');
include '../../../includes/db_connection.php';
$bb_id=(int)$_SESSION['bank_id'];
$admin_id=(int)$_SESSION['admin_id'];
$sql="SELECT * FROM blood_bank WHERE blood_bank_id={$bb_id} AND admin_id={$admin_id}";
$result=mysqli_query($connection,$sql);
if($result){
    $row=mysqli_fetch_assoc($result);
    //print_r($row);
}
else{
    ?>
    <script type="text/javascript">
        alert("Ops, Your Blood Bank information is not given yet");
    </script>
    <?php
}

?>

<?php


?>
<input type="hidden" id="bank_id" name="bank_id" value="<?php echo $bb_id ?>">
		
		<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Your Blood Bank Information</h4>
                            </div>
                            <div class="content">
                                <form id="bank_info" method="post">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Blood Bank Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Name of Your Blood Bank" value="<?php echo $row['name']; ?>">
                                            </div>
                                        </div>


                                    </div>

                                    
								     <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="address" class="form-control" placeholder="House no Road no" value="<?php echo  $row['address'] ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Contacts</label>
                                                <input type="text" name="contact" class="form-control" placeholder="phone no" value="<?php echo $row['phone'] ?>">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control" placeholder="email" value="<?php echo $row['email'] ?>">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <span style="color: #000099;" id="update"></span>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Save</button>
                                     <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>




                </div>


            </div>
        </div>


<script type="text/javascript">



    $( "#bank_info" ).on( "submit", function( event ) {
        event.preventDefault();



            var data = $("#bank_info").serializeArray();
            data.push({name: 'bank_update', value: 'true'});
            data.push({name: 'bank_id', value: $('#bank_id').val()});


            console.log(data);


          $.ajax({
                type: "POST",
                url: "action.php",
                data: data,
                dataType: "json",
                success: function(data) {
                    if(data=="updated"){
                        document.getElementById('update').innerHTML="Updated";
                    }
                    else{
                        document.getElementById('update').innerHTML="!!Error!! Failed to update";
                    }


                }
            });






    });




</script>

<?php

include "footer.php";
?>
		
