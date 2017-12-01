<?php
    session_start();
    include 'config/database.php';

function setComments()
{
    if (isset($_POST['commentSubmit']))
    {
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        $stmt = $pdo->prepare('INSERT INTO comments (uid, date, message)
        VALUES (:uid, :date, :message)');
        $stmt->execute([
            'uid' => $uid,
            'dates' => $date,
            'message' => $message]);
    }
    //header('location: gallery.php')
}

?>