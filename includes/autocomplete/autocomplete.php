<?php

	include('../db_connection.php');
	$q=$_GET['q'];




	$sql="SELECT name FROM doctor WHERE name LIKE '%$q%' ORDER BY name";
	$result = mysqli_query($connection,$sql) or die(mysqli_error());
	
	if($result)
	{
		while($row=mysqli_fetch_array($result))
		{
			echo $row['name']."\n";
		}
	}



?>