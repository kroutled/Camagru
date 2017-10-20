<?php
    include_once "index.php";

    $username = $GET['username'];
    $code = $_GET['code'];

    $query = $pdo->prepare('SELECT * FROM `users` WHERE user_username = :username');
    $query->execute(array($_GET['username']));
    while ($row = $query->fetch(PDO::FETCH_ASSOC))
    {
        $db_code = $row['user_confirm_code'];
    }
    if ($code == $db_code)
    {
        $query = $pdo->prepare("UPDATE `users` SET user_confirmed = '1', user_confirm_code = '0' WHERE user_username = :username");
        $query->execute(array($_GET['username']));
        header("Location: login.php");
        exit();
    }
    else
    {
        echo "Error!";
    }
?>