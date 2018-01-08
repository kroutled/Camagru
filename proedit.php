<?php
    include_once "config/database.php";
    session_start();
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
        <div class="but">
            <button type="submit" name="submit" value="ok">Update E-mail/Username</button></br>
            <button type="submit" name="change" value="ok">Change Password?</button>
            <div class="logbut">
                <button>Notifications: <?php echo "ON"?></button>
            </div>
        </div>
    </form>
</div>
</div>
</body>
</html>

<?php

$upemail = $_POST['upemail'];
$upusername = $_POST['upusername'];

if ($_POST['change'] == 'ok')
{
    header('Location: email.php');
}

if ($_POST['submit'] == 'ok')
{
    $stmt = $pdo->prepare("UPDATE `users` SET user_email = $upemail, user_username = $upusername WHERE user_username = :username");
    print("heyoo");
    $stmt->execute(array($_SESSION['loggedin']));
    header('Location: home.php');
}
?>