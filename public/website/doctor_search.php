<?php
include("../../includes/db_connection.php");
include("header.php");

?>


<div class="modal fade" id="schedule_modal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


        </div>
    </div>
</div>







<br> 
<div class="container-fluid" style="min-height: 500px" >
	
   
    <div class="col-md-2"></div>
	
	<div class="col-md-8" style="background-color: #e5e5e5">
	<br>
	<h2 style="text-align: center">Find Doctors</h2>

	<form id="search" method="get">
	<div class="row">
        <div class="col-md-3 "></div>
      <div class="col-md-5 " >
       <label for="sel1">Select Doctor's Speciality</label>
          <select name="doc_sp" class="form-control selectpicker" id="doc_sp" required>

              <option disabled selected value ></option>
              <?php
              $query = "SELECT speciality FROM doctor GROUP BY speciality ";
              $result = mysqli_query($connection,$query);
              while($row=mysqli_fetch_assoc($result)){
                  echo "<option>".$row["speciality"]."</option>";
              }

              ?>
          </select>
      </div>

        <div class="col-md-2 "><br>
            <button type="submit" style="padding: 8.5px 32px;" class="btn" name="search_doctor">Search</button>
        </div>


    </div>
    </form>

        <?php

        if(isset($_GET['search_doctor']) && isset($_GET['doc_sp']) ){
            $doc_sp = $_GET['doc_sp'];


            $query = "SELECT * FROM project.doctor where speciality='$doc_sp' order by name;";
            $result = mysqli_query($connection, $query);
            $count_row = mysqli_num_rows($result);

            if ($count_row > 0){
                while ($row = mysqli_fetch_assoc($result)){

                    ?>

                    <br><br>

                    <div class="row">
                        <div class="col-md-3 text-left" style="border-right: 1px solid #404040;height: 170px;">
                            <img style="width:150px;height:150px;border-radius: 70% ; float: left" src="../admin/hospital/doctor_pic/<?php echo $row['pic'] ?>">
                        </div>
                        <div class="col-md-6 text-left" style="border-right: 1px solid #404040;height: 170px;">
                            <p id='a' style="color:#001a00;font-size: 25px;"><b><?php echo $row['name']; ?></b></p>

                            <p class="u-amount " style="color: #005ce6;font-family:consolas;font-size: 19px; "><span
                                    class="glyphicon glyphicon-info-sign"></span> <b><?php echo $row['speciality']; ?></p>

                            <p style="color:#001a00 ;font-family: consolas;font-size: 16px;"><?php echo $row['qualification']; ?></p>

                            <br>

                            <p></p>
                        </div>
                        <br>

                        <div class="col-md-3 text-left">

                            <p class="u-amount " style="font-size=6px; "><span
                                    class="glyphicon glyphicon-earphone "></span> <?php echo $row['contact']; ?></p>

                     <!--       <p><span class="glyphicon glyphicon-hand-right "></span> <b>Fees</b></p>

                            <p>Tk.<?php //echo $row['fee']; ?></p>
-->


                            <button class = "btn-info pull-right"
                                    data-toggle="modal" data-target="#schedule_modal"
                                    data-id="<?php echo $row['doctor_id']; ?>">Chambers & Schedule</button>
                        </div>
                    </div>
                    <hr style="height:2px;border:none;color:#cccccc;background-color:#cccccc;">
                    <br>
                    <?php
                }
            }
        }
        ?>



        <br>
    </div>
    <div class="col-md-2"></div>


        </div>




<script type="text/javascript">

        document.getElementById('doc_sp').value = "<?php if(isset($_GET['search_doctor'])) echo $_GET['doc_sp'] ;?>";

        $('#schedule_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('id'); // Extract info from data-* attributes
            var modal = $(this);
            var dataString = 'id=' + recipient;

            $.ajax({
                type: "GET",
                url: "schedule_modal.php",
                data: dataString,
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






      /*  $(document).ready(function(){
            $( "#search" ).on( "submit", function( event ) {
                event.preventDefault();




                var data = $("#search").serializeArray();
                data.push({name: 'search_doctor', value: 'true'});
                /*   data.push({name: 'sid', value: $("#s_id").val()});
                 data.push({name: 'uid', value:$("#uid").val()});
                 data.push({name: 'max', value:max});

                console.log(data);


                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: data,
                    dataType: "json",
                    success: function(data) {

                        console.log(data);
                        $('#result').html(data);


                    }
                });

            });
        });*/





</script>


<!-- IE9 Placeholder Support -->

<!-- /.container -->
<?php

include "footer.php";
?>

