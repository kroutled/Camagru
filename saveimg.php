<?php
     session_start();
     include 'config/database.php';
     echo "hello bitches!";
    if (isset($_POST['picture'])) 
    {
        $email = $_SESSION['email'];
        $photo = json_decode($_POST['picture']);
        $photo = explode(',', $photo);
        $photo = base64_decode($photo[1]);
        $fileName = uniqid('', true).".png";
        $fileDest = "uploads/".$fileName;
        file_put_contents($fileDest, $photo);
        $stmt = $pdo->prepare('INSERT INTO uploads (userid, file_name)
        VALUES (:userid, :file_name)');
        $stmt->execute([
            'userid' => $_SESSION['uid'],
            'file_name' => $fileName]);
        header("location: home.php?$fileDest");
    }
    else {
        echo "error";
    }
?>