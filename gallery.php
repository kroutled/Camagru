<?php
    date_default_timezone_set('Africa/Johannesburg');
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
<div>
    <img src="/Camagru/uploads/<?= $item['file_name'] ?>">
    <?php
        echo "
        <form method='POST' action=''>
            <input type='hidden' name='uid' value='Anonymous'>
            <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
            <textarea name='message'></textarea></br>
            <button name='submit' type='submit'>Comment</button>
        </form>";
    ?>
</div>
<?php } ?>
</body>
</html>