<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">         
</head>
<body>
    <form method="POST">
        <input type="email" name="email" placeholder="Enter your E-mail address">
        <input type="password" name="newpwd" placeholder="Enter new password">
        <input type="password" name="newpwdconfirm" placeholder="Confirm new password">
        <div class="but">
            <button type="submit" name="reset" value="ok">Reset Password</button></br>
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
    $newpwd = $_POST["newpwd"];
    $newpwdconfirm = $_POST["newpwdconfirm"];
    $reset = $_POST["reset"];
    $verify = $_GET['access'];

        if ($reset == "ok" &&!empty($newpwd) && !empty($newpwdconfirm))
        {
            if (strlen($newpwd) >= 5)
            {
                if ($newpwd == $newpwdconfirm)
                {
                    $stmt = $pdo->prepare('SELECT * FROM users WHERE user_email = :email');
                    $stmt->execute([':email' => $email]);
                    $db = $stmt->fetch();
                    $oldpwd = $db['user_pwd'];
                    $hashpwd = hash("whirlpool", $newpwd);
                    $pdo->prepare("UPDATE `users` SET user_pwd = ? WHERE user_email = ?")->execute([$hashpwd, $email]);
                    header("Location: login.php?pwd reset!");
                }
                else
                {
                    header("Location: reset.php?pwddontmatch");
                    exit();
                }
            }
            else
            {
                header("Location: reset.php?pwdtooshort");
                exit();
            }
        }
        elseif ($reset = "ok" && empty($newpwd) && empty(newpwdconfirm))
        {
            header("Location: reset.php?pwdempty");
            exit();
        }
?>