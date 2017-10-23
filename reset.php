<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">         
</head>
<body>
    <form action="" method="POST">
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

    $newpwd = $_POST["newpwd"];
    $newpwdconfirm = $_POST["newpwdconfirm"];
    $reset = $_POST["reset"];

    if ($reset == "ok" &&!empty($newpwd) && !empty($newpwdconfirm))
    {
        if (strlen($newpwd) >= 5)
        {
            
        }
        else
        {
            header("Location: reset.php?pwdtooshort");
            exit();
        }
    }
    elseif ($reset = "ok")
    {
        header("Location: reset.php?pwdempty");
        exit();
    }
?>