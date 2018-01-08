<?php
    date_default_timezone_set('Africa/Johannesburg');
    include 'config/database.php';
    include 'comments.php';
    session_start();

    if (isset($_POST['commentSubmit']))
        setComments();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
    <link rel="stylesheet" href="style.css">
    <?php include_once "config/database.php"; ?> 
</head>
<body>
<?php
    $stmt = $pdo->prepare("SELECT file_name FROM uploads");
    $stmt->execute();
    $posts = $stmt->fetchAll();

?>
<header>
    <nav>
        <div>
            <?php
                if (isset($_SESSION["loggedin"]))
                {
                    echo'<a href="home.php"><button id="gallbut" type="submit">Home</button></a>';
                }
                else
                {
                echo '<div>
                    <a href="login.php"><button id="gallbut" type="submit">Login</button></a>
                    </div>';
                }
            ?>
        </div>
    </nav>
</header>
<?php foreach($posts as $item) { ?>
<div class="gallimg">
    <img class = "gallimg" src="/Camagru/uploads/<?= $item['file_name'] ?>">
    <?php
            echo"<form method='POST' action=''>
                    <input type='hidden' name='uid' value=''>
                    <input type='hidden' name='dates' value='".date('Y-m-d H:i:s')."'>
                    <textarea name='message'></textarea></br>
                    <button name='commentSubmit' type='submit'>Comment</button>
                </form></br>
                <a href='like.php?type=article&id='>Like</a>";
    ?>
</div>
<?php } ?>
</body>
</html>