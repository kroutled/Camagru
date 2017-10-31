<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">         
</head>
<body>
    <form method="POST">
        <input type="email" name="email" placeholder="Enter your E-mail address">
        <div class="but">
            <button type="submit" name="cont" value="ok">Continue</button></br>
        </div>
    </form>
    <div class="logbut">
        <a href="index.php"><button type="submit">Sign up</button></a>
        </div>
</body>
</html>

<?php

    include_once "config/database.php";

    $email = $_POST["email"];
    $cont = $_POST["cont"];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE user_email = :email');
    $stmt->execute([':email' => $email]);
    $db = $stmt->fetch();

    if ($cont == 'ok' && !empty($email))
    {
        if ($email == $db['user_email'])
        {
            $message = 
            "
            Password Reset:
            Click the link below to reset your password
            http://localhost:8080/Camagru/reset.php?access=ok
            ";

            mail($email,"Camagru Password reset", $message, "From: DoNotReply@camagru.com");
            header ("Location: email.php?emailsent");
            exit();
        }
        else
        {
            header ("Location: email.php?user=notfound");
            exit();
        }
    }
    elseif ($cont == 'ok')
    {
        header ("Location: email.php?emailnotvalid");
        exit();
    }
?>