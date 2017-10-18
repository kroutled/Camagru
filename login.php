<!DOCTYPE html>
<html>
<head>
    <title>Camagru Login</title>
    <link rel="stylesheet" href="style.css">
    <?php include "config/database.php"; ?>
</head>
<body>
    <h2 class="suhead">Login</h2>
        <form action="" method="POST">  
            <div class="input"><input type="text" name="uid" placeholder="Username/email"></div></br>
            <div class="input"><input type="password" name="pwd" placeholder="Password"></div></br>
            <div class="but">
                <button type="submit">Login</button></br>
            </div>
        </form>
        <div class="logbut">
        <a href="index.php"><button class="logbut" type="submit">Sign up</button></a>
        </div>
</body>
</html>