



<?php
	session_start();
	if(isset($_SESSION['owner'])){
		if($_SESSION['owner']=="bb"){
			header("Location: /project/public/admin/bank/dashboard.php");
		}
		else{
			header("Location: /project/public/admin/hospital/dashboard.php");
		}
	}
	
	include('..\..\..\includes\db_connection.php');

if (isset($_POST['login-button'])) {
	$email = $_POST['aid'];
	$password = $_POST['passwd'];

	$sql = "SELECT * from admin where email ='$email' and passwd='$password'";
	$run = mysqli_query($connection,$sql);
	confirm_query($run);
	$count = mysqli_num_rows($run);
	$row = mysqli_fetch_array($run);


	if ($count > 0) {

			session_start();
			$_SESSION["admin_id"] = $row["admin_id"];
			$_SESSION["admin_name"] = $row["name"];
			$_SESSION["owner"] = $row['owner'];
			$aid = $_SESSION["admin_id"];


			if($_SESSION['owner']=="hospital"){
				$sql = "select hospital_id from hospital where admin_id= '$aid' ";
				$run = mysqli_query($connection,$sql);
				confirm_query($run);
				$row = mysqli_fetch_array($run);
				$_SESSION['org_id']= $row['hospital_id'];
				header("Location: /project/public/admin/hospital/dashboard.php");

			}
		else{
			$sql = "select blood_bank_id from blood_bank where admin_id= '$aid' ";
			$run = mysqli_query($connection,$sql);
			confirm_query($run);
			$row = mysqli_fetch_array($run);
			$_SESSION['bank_id']= $row['blood_bank_id'];
			header("Location: /project/public/admin/bank/dashboard.php");
		}




	}
	else {

		header("Location:login.php?error=1");

	}

}



?>



<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Administrative Login</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <div class="wrapper">
	<div class="container">
		<h1>Welcome, Admin</h1>


		
		<form class="form" method="post" action="login.php">

			<input type="text" placeholder="Username" name="aid">
			<input type="password" placeholder="Password" name="passwd">





			<button type="submit" name="login-button">Login</button>


		</form>


		<label type=text style="color: yellow">
			   <?php
			   if(isset($_GET["error"])){
				   echo "wrong username or password";

			   }
			   ?>

			</label>

	</div>

	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="js/index.js"></script>

</body>
</html>
