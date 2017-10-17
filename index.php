<!DOCTYPE html>
<html>
<head>
    <title>Camagru</title>
    <link rel="stylesheet" href="style.css">
    <?php include "config/database.php"; ?>
</head>
<body>
    <h2 class="suhead">Register</h2>
        <form action="" method="POST">  
            <div class="input"><input type="text" name="first" placeholder="First Name"></div></br>
            <div class="input"><input type="text" name="last" placeholder="Last Name"></div></br>
            <div class="input"><input type="text" name="email" placeholder="E-mail"></div></br>
            <div class="input"><input type="text" name="uid" placeholder="Username"></div></br>
            <div class="input"><input type="password" name="pwd" placeholder="Password"></div></br>
            <button type="submit">Sign up</button>
        </form>
</body>
</html>