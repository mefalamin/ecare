<?php
include("../../includes/db_connection.php");

//include 'includes/navigation.php';
$sql = "SELECT * FROM hospital ";
$result = mysqli_query($connection,$sql);
if(isset($_GET['search_hospital'])){
	$h_sp=$_GET['hospital'];
	$h_name= preg_replace("/\([^)]+\)/","",$h_sp);
	$sql = "SELECT * FROM hospital where name='{$h_name}' ";
	$result=mysqli_query($connection,$sql);
}

if(isset($_SESSION['hid_seeing'])){
	unset($_SESSION['hid_seeing']);
}
?>




<?php
include("header.php");
?>




<br>
<div class="container-fluid" >


	<div class="col-md-2"></div>

	<div class="col-md-8" style="background-color: #e5e5e5">
		<br>
		<div class="col-md-3"></div>
		<form method="get" action="hospital.php">
		<div class="row">
			<div class="col-md-4 " >
				<label for="sel1">Select Hospital</label>
				<select class="form-control" id="sel1" name="hospital">
					<option value=" " ></option>
					<?php
					$sql="select name,speciality from hospital ORDER by name";
					$hospital=mysqli_query($connection,$sql);

					while($name=mysqli_fetch_assoc($hospital)){
						echo '<option>'.$name['name'].' ('.$name['speciality'].')'.'</option>';
					}
					?>
				</select>
			</div>




			<div class="col-md-2"> <br>
				<button type="submit" style= "padding: 8.5px 32px;" class="btn" name="search_hospital">Search</button>
			</div>


		</div>
		</form>

		<br><br>
		<?php while($row =mysqli_fetch_assoc($result)) :?>
			<div class="row">
				<div class="col-md-3 text-left" style="border-right: 1px solid #404040;height: 160px;">
					<img style="width:250px;height:150px;border-square: 100%;" src="images/h2.jpg">
				</div>
				<div class="col-md-4 text-left" style="border-right: 1px solid #404040;height: 160px;">
					<p id='a' class="u-amount" style="color:#001a00;font-size: 23px;" ><b><?php echo $row['name']; ?></b></p>
					<p class="u-amount " style="font-family: consolas;font-size=5px; "><b><?php echo $row['description']; ?></b></p>
					<p class="u-amount " style="color: #005ce6;font-family:consolas;font-size: 19px; "><span class="glyphicon glyphicon-info-sign"></span> <b><?php echo $row['speciality']; ?></p>
					<p class="u-amount " style="font-size=6px; "><span class="glyphicon glyphicon-map-marker "></span> <b><?php echo $row['address']; ?></p>
					<p class="u-amount " style="font-size=6px; "><span class="glyphicon glyphicon-earphone "></span> <?php echo $row['phone']; ?></p> <br>

				</div> <br>



				<div class="col-md-5 text-left">

					<p style="color:#001a00"> Emergency Call </p>
					<p class="u-amount" style="color:#005ce6;font-family:;font-size=6px; "><span class="glyphicon glyphicon-hand-right "></span> <?php echo $row['emergency']; ?></p>
					<p style="color:#001a00;font-family: consolas;font-size: 16px;"><span class="glyphicon glyphicon-envelope "></span> <?php echo $row['email']; ?></p>
					<p class="u-amount " style="font-size=6px; "><span class="glyphicon glyphicon-print"></span> <?php echo $row['fax']; ?></p> </b>



					<div class="btn-group-vertical pull-right">
						<button   type="button" style= "padding: 8.5px 25px;" class="btn btn-sm btn-primary pull-right" onclick=window.open('detail_hospital.php?<?php echo "hid=".$row['hospital_id']; ?>','_self') >See More</button> <br> <br>
						<button   type="button" style= "padding: 8.5px 25px;" class="btn btn-sm btn-primary pull-right" onclick=window.open('detail_hospital.php?<?php echo "hid=".$row['hospital_id']; ?>','_self') >Doctors</button><br> <br>


					</div>
				</div>
			</div>
			<hr style="height:2px;border:none;color:#cccccc;background-color:#cccccc;">
			<br>
		<?php endwhile; ?>
	</div>
	<div class="col-md-2"></div>
</div>




<?php
include("footer.php");
?>

