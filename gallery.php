<?php
    date_default_timezone_set('Africa/Johannesburg');
    session_start();
    include 'config/database.php';
    include 'comments.php';
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
<?php foreach($posts as $item) { ?>
<div class="gallimg">
    <img src="/Camagru/uploads/<?= $item['file_name'] ?>">
    <?php
        echo "
        <form method='POST' action='".setComments()."'>
            <input type='hidden' name='uid' value='Anonymous'>
            <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
            <textarea name='message'></textarea></br>
            <button name='commentSubmit' type='submit'>Comment</button>
        </form>";
    ?>
</div>
<?php } ?>
</body>
</html>