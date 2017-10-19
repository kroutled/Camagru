<!DOCTYPE html>
<html>
<head>
    <title>Camagru</title>
    <link rel="stylesheet" href="style.css">
    <?php include_once "config/database.php"; ?>         
</head>
<body>
    <h2 class="suhead">Register</h2>
    <div class="form">
        <form method="POST">  
            <div class="input"><input type="text" name="first" placeholder="First Name"></div></br>
            <div class="input"><input type="text" name="last" placeholder="Last Name"></div></br>
            <div class="input"><input type="email" name="email" placeholder="E-mail"></div></br>
            <div class="input"><input type="text" name="username" placeholder="Username"></div></br>
            <div class="input"><input type="password" name="pwd" placeholder="Password"></div></br>
            <div class="but">
                <button type="submit" name="submit" value="ok">Sign up</button></br>
            </div>
        </form>
    </div>
        <div class="logbut">
            <a href="login.php"><button id="login_but" type="submit">Login</button></a>
        </div>
</body>
</html>

<?php

$first = $_POST["first"];
$last = $_POST["last"];
$email = $_POST["email"];
$username = $_POST["username"];
$pwd = $_POST["pwd"];
$submit = $_POST["submit"];
if ($submit == 'ok' && !empty($first) && !empty($last) && !empty($email) && !empty($username) && !empty($pwd))
{
    if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last))
    {
        header("Location: index.php?signup=invalid");
        exit();
    }
    else
    {
        $stmt = $pdo->prepare('SELECT COUNT(*) AS count FROM users WHERE user_username = :username');
        $stmt->execute(array($_POST['username']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (intval($row['count']) > 0)
        {
            header("Location: index.php?signup=userexists");
            exit();
        }
        else
        {
            if (strlen($pwd) < 5)
            {
                header("Location: index.php?signup=passwordtooshort");
                exit();
            }
            else
            {
                $hashpwd = hash("whirlpool", $pwd);
                $stmt = $pdo->prepare('INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_email`, `user_username`, `user_pwd`) VALUES (NULL, :first, :last, :email, :username, :pwd)');
                $stmt->execute(['first' => $first, 'last' => $last, 'email' => $email, 'username' => $username, 'pwd' => $hashpwd]);
                header("Location: login.php");
                exit();
            }
        }
    }
}
elseif ($submit == 'ok')
{
    header("Location: index.php?signup=empty");
    exit();
}

?>
