<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <?php include "config/database.php"; ?>
</head>
<body>
    <h2 class="suhead">Login</h2>
        <form action="" method="POST">  
            <div class="input"><input type="text" name="username" placeholder="Username"></div></br>
            <div class="input"><input type="password" name="pwd" placeholder="Password"></div></br>
            <div class="but">
                <button type="submit" name="login" value="ok">Login</button></br>
            </div>
        </form>
        <div class="logbut">
        <a href="index.php"><button type="submit">Sign up</button></a>
        </div>
        <div class="logbut">
        <a href="email.php"><button type="submit">Forgot Password?</button></a>
        </div>
</body>
</html>

<?php

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $login = $_POST["login"];
    if ($login == "ok" && !empty($username) && !empty($pwd))
    {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE user_username = :username');
        $stmt->execute(['username' => $username]);
        $db = $stmt->fetch();  
        if ($username == $db["user_username"])
        {
            $hashpwd = hash("whirlpool", $pwd);
            if ($hashpwd == $db['user_pwd'])
            {
                if ($db["user_confirmed"] == 1)
                {
                    $_SESSION["loggedin"] = $_POST["username"];
                    $_SESSION["uid"] = $db["user_id"];
                    $_SESSION['email'] = $db['email'];
                    header("Location: home.php");
                    exit();
                }
                else
                {
                    header("Location: login.php?login=usernotconfirmed");
                    exit();
                }

            }
            else
            {
                header("Location: login.php?login=password");
                exit();
            }
        }
        else
        {
            header("Location: login.php?login=usernotfound");
            exit();
        }
    }
    elseif ($login == "ok")
    {
        header("Location: login.php?login=empty");
        exit();
    }
?>