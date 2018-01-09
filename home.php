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
        <a href="proedit.php"><button id="probut" type="submit">Profile</button></a>
    </nav>
</header>
<!--This is where the Camera starts -->
<div class="main_wrapper">
    <div class="booth_wrapper">
        <div class="booth">
            <video id="video" width="400" height="300"></video>
            <a href="#" id="capture" class="booth-capture-button">Take Photo</a>
            <canvas id="canvas" width=400 height=400></canvas>
            <input action="home.php" id ="saveimg" type="submit" onclick="saveImg();">
        </div>
        <div class="overlays">

            <button class="test"><img class ="test" src="images/burger.png"></button></br>
            <a href="#"><img class ="test" src="images/reset.png"></a></br>
            <a href="#"><img class ="test" src="images/pikachu.png"></a></br>
    
        </div>
        <div class="save">
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit">UPLOAD</button>
            </form>
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
    xhttp.open("POST", "./saveimg.php", true);
    xhttp.setRequestHeader ("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        console.log (this.responseText);
    }
    xhttp.send(photoshot); 
}
</script>
<!-- this is where the camera stops! -->
<div class="footer">&copykroutled</div>
</body>
</html>