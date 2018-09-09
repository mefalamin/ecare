<?php
include("../../includes/db_connection.php");
include "header.php";
//include 'includes/navigation.php';

$sql="SELECT * FROM blood_bank ORDER BY name";
$default=mysqli_query($connection,$sql);
$sql="SELECT name FROM blood_bank ORDER BY name";
$combo=mysqli_query($connection,$sql);
?>


<br>
<div class="container-fluid" style="min-height: 350px" >


	<div class="col-md-2"></div>

	<div class="col-md-8" style="background-color: #e5e5e5">
		<br>
		<h2 style="text-align: center">Blood Banks
		</h2>
		<br>
		<div class="col-md-3"></div>
		<form>
			<div class="row">

				<div class="col-md-4" >

					<label for="sel1">Select from Below</label>
					<select class="form-control" name="bank" id="bank">
						<option value="" ></option>
						<?php
						while($name=mysqli_fetch_assoc($combo)){
							echo '<option>'.$name['name'].'</option>';
						}
						?>
					</select>
				</div>

				<div class="col-md-2 "> <br>
					<button type="submit" style= "padding: 8.5px 32px;" class="btn" name="search">Show</button>
				</div>
			</div>
		</form>
		<br><br>

		<?php
		if(isset($_GET['search'])){
			$bank=$_GET['bank'];
			$sql="SELECT * FROM blood_bank where name='{$bank}'";
			$selected=mysqli_query($connection,$sql);

		}
		?>

		<?php
			if(isset($_GET['search']))
				$execute=$selected;
			else
				$execute=$default;


				while ($all = mysqli_fetch_assoc($execute))
				{
					?>
					<div class="row">
						<div class="col-md-3 text-center" style="border-right: 1px solid #404040;height: 140px;">
							<img style="width:250px;height:150px;border-square: 100%;"
								 src="images/bank/<?php echo $all['blood_bank_id'] . ".jpg"; ?>">
						</div>
						<div class="col-md-4 text-left" style="border-right: 1px solid #404040;height:auto;">
							<p id='a' class="u-amount" style="color:#001a00;font-size: 25px;">
								<b><?php echo $all['name']; ?></b></p>

							<p class="u-amount " style="font-size=6px; "><span
									class="glyphicon glyphicon-map-marker "></span> <b><?php echo $all['address']; ?>
							</p>

							<p class="u-amount " style="font-size=6px; "><span
									class="glyphicon glyphicon-earphone "></span> <?php echo $all['phone']; ?></p>

							<p style="color:#001a00;font-family: consolas;font-size: 16px;"><span
									class="glyphicon glyphicon-envelope "></span> <?php echo $all['email']; ?></p>


						</div>
						<br>

						<div class="col-md-5 text-left">

							<br>

							<div class="btn-group-vertical pull-right">
								<button type="button" style="padding: 8.5px 25px;"
										class="btn btn-sm btn-primary pull-right"
										onclick="detailsmodal(<?php echo $all['id']; ?>)">See Stock
								</button>
								<br> <br>
							</div>
						</div>
					</div>
					<hr style="height:2px;border:none;color:#cccccc;background-color:#cccccc;">
					<br>
					<?php

				}


		?>


	</div>



</div>

<script type="text/javascript">

	document.getElementById('bank').value="<?php if(isset($_GET['search'])) echo $_GET['bank'] ;?>";

</script>

<?php
include "footer.php";
?>

