<?php
    if (isset($_POST["submit"]))
    {
        $file = $_FILES["file"];

        $fileName = $_FILES["file"]["name"];
        $fileTmpName = $_FILES["file"]["tmp_name"];
        $fileSize = $_FILES["file"]["size"];
        $fileError = $_FILES["file"]["error"];
        $fileType = $_FILES["file"]["type"];

        $fileExt = explode('.', $fileName);
        $fileActExt = strtolower(end($fileExt));

        $allowed = array("jpg", "jpeg", "png");

        if (in_array($fileActExt, $allowed))
        {
            if ($fileError === 0)
            {
                if ($fileSize < 500000)
                {
                    $fileNameNew = uniqid("", true).".".$fileActExt;
                    $fileDest = "uploads/".$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDest);
                    header("Location: home.php?uploadsuccess");
                }
                else
                {
                    echo "Your file is too big!";
                }
            }
            else
            {
                echo "There was an error uploading your file!";
            }
        }
        else
        {
            echo "You cannot upload files of this type!";
        }
    }
?>