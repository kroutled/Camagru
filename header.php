<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<form>
<input type="text" name="uid" placeholder="Username/email">
<input type="password" name="passwd" placeholder="Password">
<button>Login</button>
</form>
</header>
<?php include_once "footer.php" ?>