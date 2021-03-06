<?php
    include_once "config/database.php";
    session_start();
    
    $stmt = $pdo->prepare('SELECT * FROM users WHERE user_username = :username');
    $stmt->execute([':username' => $_SESSION["loggedin"]]);
    $db = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <?php include_once "config/database.php"; ?>         
</head>
<body>
<header>
    <nav>
        <div>
            <div>
                <?php
                    if (isset($_SESSION["loggedin"]))
                    {
                        echo '<form class ="logout" action="logout.php" method="POST">
                        <button id="logout" type="submit" name="submit">Logout</button>
                              </form>';
                    }
                ?>
            </div>
        </div>
        <a href="gallery.php"><button id="gallbut" type="submit">Gallery</button></a>
        <a href="home.php"><button id="probut" type="submit">Home</button></a>
    </nav>
</header>
<div class="main_wrapper">
<div class="form">
    <h1 class="suhead">Profile</h1>
    <form method="POST">
        <div class="input"><input type="email" name="upemail" placeholder="E-mail" value=<?php echo $_SESSION['email']?>></div></br>
        <div class="input"><input type="text" name="upusername" placeholder="Username"></div></br>
        <h5>Set Notifications: 0 = OFF, 1 = ON</h5>
        <div class="input"><input type="number" name="notifications" min="0" max="1"></div></br>
        <div class="but">
            <button type="submit" name="submit" value="ok">Update E-mail/Username</button></br>
            <button type="submit" name="change" value="ok">Change Password?</button>
            <button type="submit" name="note" value="ok">Notifications: <?php
                if ($db['notification'] == 1)
                    echo "ON";
                else
                    echo "OFF";
            ?></button>
        </div>
    </form>
</div>
</div>
</body>
<div class="footer">&copykroutled</div>
</html>

<?php

$upemail = $_POST['upemail'];
$upusername = $_POST['upusername'];

$stmt = $pdo->prepare('SELECT * FROM users WHERE user_username = :username');
    $stmt->execute([':username' => $_SESSION["loggedin"]]);
    $db = $stmt->fetch();

if ($_POST['change'] == 'ok')
{
    header('Location: email.php');
}

if ($_POST['submit'] == 'ok')
{
    $pdo->prepare("UPDATE `users` SET user_email = ? WHERE user_username = ?")->execute([$upemail, $_SESSION['loggedin']]);
    $pdo->prepare("UPDATE `users` SET user_username = ? WHERE user_username = ?")->execute([$upusername, $_SESSION['loggedin']]);
    $_SESSION['loggedin'] = $upusername;
}

if ($_POST['note'] == 'ok')
{
    $stmt = $pdo->prepare('SELECT * FROM users WHERE user_username = :username');
    $stmt->execute([':username' => $_SESSION["loggedin"]]);
    $db = $stmt->fetch();
    if ($_POST['notifications'] == 1)
    {
        $pdo->prepare("UPDATE `users` SET notification = ? WHERE user_username = ?")->execute(['1', $_SESSION['loggedin']]);
    }
    elseif ($_POST['notifications'] == 0)
    {
        $pdo->prepare("UPDATE `users` SET notification = ? WHERE user_username = ?")->execute(['0', $_SESSION['loggedin']]);
    }
    
}
?>