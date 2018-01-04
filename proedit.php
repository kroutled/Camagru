<?php
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
    <h1>Profile</h1>
    <form method="POST">
        <div class="input"><input type="email" name="email" placeholder="E-mail"></div></br>
        <div class="input"><input type="text" name="username" placeholder="Username"></div></br>
        <div class="input"><input type="password" name="pwd" placeholder="Password"></div></br>
        <div class="but">
            <button type="submit" name="submit" value="ok">Update</button></br>
        </div>
    </form>
</div>
</div>
</body>
</html>