<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Auto Complete Input box</title>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 $("#tag").autocomplete("autocomplete.php", {
		selectFirst: true
	});
});



</script>
</head>

<?php
if(isset($_POST['up'])){

    if(isset($_POST['check'])){
        $check = $_POST['check'];
    }
    else{
        $check='off';
    }
    $time = $_POST['time'];

}
    echo $time." ".$check



?>

<body>




</body>
</html>
