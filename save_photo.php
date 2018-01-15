<?php
session_start();
include('./config/database.php');

$username = $_SESSION['loggedin']; 
$stmt = $pdo->prepare('SELECT user_id FROM users WHERE user_username = :username');
$stmt->execute(['username' => $username]);
$userid = $stmt->fetch();


$photo = $_POST["picture"];
$overlay = $_POST["overlay"];
$photo2 = explode(',', $photo);
$photo = $photo2[1];
$photo = base64_decode($photo);
$overlay2 = explode(',', $overlay);
$overlay = $overlay2[1];
$overlay = base64_decode($overlay);

$img1 = imagecreatefromstring($photo);
$img2 = imagecreatefromstring($overlay);
imagecopy($img1, $img2, 0, 0, 0, 0, 640, 480);

$img_name = tempnam("./uploads", $userid['user_id'] . "_");
imagepng($img1, $img_name.".png");
$img_name2 = substr($img_name, strlen($_SERVER['DOCUMENT_ROOT']));
$stmt = $pdo->prepare('INSERT INTO uploads (userid, file_name)
        VALUES (:userid, :file_name)');
        $stmt->execute([
            'userid' => $userid['user_id'],
            'file_name' => $img_name2.".png"]);
echo $img_name;
unlink($img_name);
imagedestroy($img1);
imagedestroy($img2);
?>