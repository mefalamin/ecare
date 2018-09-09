

<?php

// Check if the form was submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if file was uploaded without errors

    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){

        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

        $filename = $_FILES["photo"]["name"];

        $filetype = $_FILES["photo"]["type"];

        $filesize = $_FILES["photo"]["size"];

        $exts=findexts($filename);
        $name = "1".".".$exts;

        $error = array();
        // Verify file extension

        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if(!array_key_exists($ext, $allowed))
            $error[] = "Please select a valid file format";



        // Verify file size - 5MB maximum

        $maxsize = 2 * 1024 * 1024;

        if($filesize > $maxsize)
        {
           $error[]= 'File size is larger than the allowed limit.';

        }




        // Verify MYME type of the file

       if(in_array($filetype, $allowed)){

            // Check whether file exists before uploading it

            if(file_exists("upload/" . $_FILES["photo"]["name"])){

                $error[] = $_FILES["photo"]["name"] . " is already exists.";

            } else{

                move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $name);

                echo "Your file was uploaded successfully.";

            }

        } else{

           $error[] = "Error: There was a problem uploading your file. Please try again.";

        }

    } else{






    }

}


function findexts ($filename)
{
    $filename = strtolower($filename) ;
    $exts = split("[/\\.]", $filename) ;
    $n = count($exts)-1;
    $exts = $exts[$n];
    return $exts;
}

?>
<!DOCTYPE html>
<html lang="en">
<body>



</body>
</html>
