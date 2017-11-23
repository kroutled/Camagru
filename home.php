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
                        echo '<form class ="logout" action="logout.php" method="POST">
                        <button id="logout" type="submit" name="submit">Logout</button>
                              </form>';
                    }
                ?>
            </div>
        </div>
        <button id="gallbut" action="gallery.php" method="POST">Gallery</button>
    </nav>
</header>
<!--This is where the Camera starts -->
<div class="main_wrapper">
    <div class="booth_wrapper">
        <div class="booth">
            <video id="video"></video>
            <a href="#" id="capture" class="booth-capture-button">Take Photo</a>
            <canvas id="canvas" width="100%" height="100%"></canvas>
        </div>
        <div class="overlays">
            <form method="GET">
                <input type="radio" name="burger" value="images/burger.png" checked>
                <img src="images/burger.png" style="height: 75px; width: 75px"></br>
                <input type="radio" name="pika" value="images/pikachu.png">
                <img src="images/pikachu.png" style="height: 75px; width: 75px"></br>
                <input type="radio" name="reset" value="images/reset.png">
                <img src="images/reset.png" style="height: 75px; width: 75px"></br>
            </form>
            <!--
            <div style = "width:30%; height:30%;">
                <button class="layover"><img src = "images/pikachu.png"></button>
            </div>
            <div>
                <button class="layover"><img src = "images/reset.png"></button>
            </div>
            <div>
                <button class="layover"><img src = "images/burger.png"></button>
            </div>
                -->
        </div>
        <div class="save">
        </div>
    </div>
</div>
<!--
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
-->
<!-- this is where the camera stops! -->
<footer>@kroutled</footer>
</body>
</html>

<?php
?>