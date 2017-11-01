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
<div class="booth">
    <video id="video" width="400" height="300"></video>
</div>
<script>
(function()
{
    var video = document.getElementById('video'),
    vendorUrl = window.URL || window.webkitURL;

    navigator.getMedia = navigator.getUserMedia 
                        || navigator.webkitGetUserMedia 
                        || navigator.mozGetUserMedia 
                        || navigator.msGetUserMedia;

    navigator.getMedia({
        video: true,
        audio: false
    }, function(stream){
        video.src = vendorUrl.createObjectURL(stream);
        video.play();
    }, function(error){
        //an error occured
        //error.code
    });
})();
</script>
</body>
</html>

<?php
?>