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
</div>
<?php } ?>
    <h1>COMMENTS!</h1>
</body>
</html>

<?php
    
?>