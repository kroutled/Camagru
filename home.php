<?php
 session_start();
 include "config/database.php";
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
        <a href="gallery.php"><button id="gallbut" type="submit">Gallery</button></a>
    </nav>
</header>
<!--This is where the Camera starts -->
<div class="main_wrapper">
    <div class="booth_wrapper">
        <div class="booth">
            <video id="video" width="400" height="300"></video>
            <a href="#" id="capture" class="booth-capture-button">Take Photo</a>
            <canvas id="canvas" width=400 height=400></canvas>
            <input type="submit" onclick="saveImg();">Submit
        </div>
        <div class="overlays">
            <button class="laid" type="submit"><img src="images/burger.png"></button>
            <button class="laid" type="submit"></button>
            <button class="laid" type="submit"></button>
            <!-- <form method="GET">
                <input class="olp" type="radio" name="burger" value="images/burger.png"/>
                <img src="images/burger.png" style="height: 75px; width: 75px"></br>
                <input class="olp" type="radio" name="pika" value="images/pikachu.png">
                <img src="images/pikachu.png" style="height: 75px; width: 75px"></br>
                <input class="olp" type="radio" name="reset" value="images/reset.png">
                <img src="images/reset.png" style="height: 75px; width: 75px"></br>
            </form> -->
        </div>
        <div class="save">
        </div>
    </div>
</div>

<script>
(function()
{
    var video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
    vendorUrl = window.URL || window.webkitURL;

    navigator.getMedia =    navigator.getUserMedia 
                        ||  navigator.webkitGetUserMedia 
                        ||  navigator.mozGetUserMedia 
                        ||  navigator.msGetUserMedia;

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
        context.drawImage(video, 0, 0, 400, 340);
    })
})();

function saveImg() {
    canvas = document.getElementById("canvas");
    var sendcanv= canvas.toDataURL('image/png');
    var photoshot = 'picture=' + encodeURIComponent(JSON.stringify(sendcanv));
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./upload.php", true);
    xhttp.setRequestHeader ("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        console.log (this.responseText);
    }
    xhttp.send(photoshot); 
}
</script>
<!-- this is where the camera stops! -->

</body>
</html>