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
    <video id="video" width="100%" height="100%"></video>
    <a href="#" id="capture" class="booth-capture-button">Take Photo</a>
    <canvas id="canvas" width="400" height="300"></canvas>
</div>
<div class="superimp">
    hello
</div>
<script>
(function()
{
    var video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
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
        console.log("Error");
    });

    document.getElementById('capture').addEventListener('click', function()
    {
        context.drawImage(video, 0, 0, 400, 300);
    })
})();
</script>
<!-- this is where the camera stops! -->
</body>
</html>

<?php
?>