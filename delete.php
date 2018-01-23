<?php
    include "config/database.php";
    session_start();

    $username = $_SESSION['loggedin'];
    $pid = $_POST['delete'];

    $stmt = $pdo->prepare('SELECT user_id FROM users WHERE user_username = :username');
    $stmt->execute(['username' => $username]);
    $userid = $stmt->fetch();

    $stmt = $pdo->prepare('DELETE FROM uploads WHERE userid = :userid AND pid = :pid');
    $stmt->execute(['userid' => $userid['userid'],
                    'pid' => $pid]);
print("worked?");
    //header("Location: home.php");
?>