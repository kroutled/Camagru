<?php
 session_start();
 if (!isset($_SESSION['loggedin']))
 {
     header('Location: login.php');
     exit();
 }
 ?>

<!DOCTYPE html>
<html>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
<head>
</head>
<body>
<header>
    <nav>
        <div>
            <div>
                <?php
                    if (isset($_SESSION["loggedin"]))
                    {
                        echo '<form action="logout.php" method="POST">
                        <button type="submit" name="submit">Logout</button>
                              </form>';
                    }
                ?>
            </div>
        </div>
    </nav>
</header>
<!--This is where the Camera starts -->

<body>
</html>

<?php
?>