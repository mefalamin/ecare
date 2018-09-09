<html>
<head>

    <meta charset="UTF-8">

    <title>File Upload Form</title>

</head>

<body>

<form action="ajax.php" method="post" enctype="multipart/form-data">

    <h2>Upload File</h2>

    <label for="fileSelect">Filename:</label>

    <input type="file" name="photo" id="fileSelect">

    <input type="submit" name="submit" value="Upload">

    <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 2 MB.</p>

    
    <img src="../images/user.png">

    <meter value="40" high="100" low="20"></meter>


</form>

</body>

</html>

<?php


    $str="12345";

    if(password_verify($str,'$2y$10$u9aMLVHANUFEEXH7ViODkudhr/9xSVSXlqn3Vum471jBkDogakoSG')){
        echo true;
    }

?>
