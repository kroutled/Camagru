<?php
    date_default_timezone_set('Africa/Johannesburg');
    include 'config/database.php';
    include 'comments.php';

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
<nav>
<div class="gallbut">
    <a href="home.php"><button type="submit">Home</button></a>
</div>
<div class="gallbut">
    <a href="index.php"><button type="submit">Signup</button></a>
</div>
<div class="gallbut">
    <a href="login.php"><button type="submit">Login</button></a>
</div>
</nav>
<?php foreach($posts as $item) { ?>
<div class="gallimg">
    <img src="/Camagru/uploads/<?= $item['file_name'] ?>">
        <form method='POST' action=''>
            <input type='hidden' name='uid' value='Anonymous'>
            <input type='hidden' name='dates' value='".date('Y-m-d H:i:s')."'>
            <textarea name='message'></textarea></br>
            <button name='commentSubmit' type='submit'>Comment</button>
        </form>
</div>
<?php } ?>
</body>
</html>