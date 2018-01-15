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
<body onload="videoStream()">
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
            <div class="overlay_img">
                <img id="overlay" class="overlay"></img>
                <canvas id="canvas_img" width=640 height=480></canvas>
            </div>
            <div class="video_feed">
                <video id="video" width="100%" height="100%"></video>
                <canvas id="canvas" width=640 height=480></canvas>
            </div>
            <a href="#" id="capture" class="booth-capture-button" onclick="snapshot()">Take Photo</a>
            <a href="#" id="newPhoto" class="booth-capture-button" onclick="newPhoto()">Take Another Photo</a>
            <input action="home.php" id ="saveimg" type="submit" onclick="saveImg();">
        </div>
        <div class="overlays">

            <button class="ovbut" id="burger" onclick="changeOverlay('images/burger.png')">
                <img class ="test" src="images/burger.png">
            </button></br>
            <button class="ovbut" id="reset" onclick="changeOverlay('images/reset.png')">
                <img class ="test" src="images/reset.png">
            </button></br>
            <button class="ovbut" id="pikachu" onclick="changeOverlay('images/pikachu.png')">
                <img class ="test" src="images/pikachu.png">
            </button></br>
    
        </div>
<?php
    $username = $_SESSION['loggedin'];
    $stmt = $pdo->prepare('SELECT user_id FROM users WHERE user_username = :username');
    $stmt->execute(['username' => $username]);
    $userid = $stmt->fetch();

    $stmt = $pdo->prepare('SELECT file_name FROM uploads WHERE userid = :userid ORDER BY `date` DESC LIMIT 3');
    $stmt->execute(['userid' => $userid['user_id']]);
    $recent = $stmt->fetchAll();
?>
        <div class="save">
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit">UPLOAD</button>
            </form>
            <div class="recent">
            <?php
            
            
                foreach($recent as $item)
                {
                    echo '<img src="'.$item['file_name'].'"><br>';
                } 
            ?>
            </div>
        </div>
    </div>
</div>

<script>

function videoStream() {

    var video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        overlay = document.getElementById('canvas_img'),
        overlayContext = overlay.getContext('2d'),
        context = canvas.getContext('2d');

    vendorUrl = window.URL || window.webkitURL;

    navigator.getMedia =    navigator.getUserMedia 
                        ||  navigator.webkitGetUserMedia 
                        ||  navigator.mozGetUserMedia 
                        ||  navigator.msGetUserMedia;
    context.translate(640, 0);
    navigator.getMedia({
        video: true,
        audio: false
    }, function(stream){
        video.src = vendorUrl.createObjectURL(stream);
        video.play();
    }, function(error){
        console.log("Error");
    });
};

function snapshot() {
		var video = document.getElementById('video'),
			canvas = document.getElementById('canvas'),
			overlay = document.getElementById('canvas_img'),
			context = canvas.getContext('2d'),
			overlayContext = overlay.getContext('2d');

		context.scale(-1, 1);
		document.getElementById('video').style.display = "none";
		document.getElementById('overlay').style.display = "none";
		document.getElementById('canvas').style.display = "block";
		document.getElementById('canvas_img').style.display = "block";
		document.getElementById('newPhoto').style.display = "block";
		document.getElementById('capture').style.display = "none";
		var imgsrc = document.getElementById("overlay");

		context.drawImage(video, 0, 0, 640, 480);
		overlayContext.drawImage(imgsrc, 0, 0, 640, 480);
}

function newPhoto() {
	var video = document.getElementById('video'),
		canvas = document.getElementById('canvas'),
		overlay = document.getElementById('canvas_img'),
		context = canvas.getContext('2d'),
		overlayContext = overlay.getContext('2d');

	document.getElementById('video').style.display = "block";
	document.getElementById('overlay').style.display = "block";
	document.getElementById('canvas').style.display = "none";
	document.getElementById('canvas_img').style.display = "none";
	document.getElementById('newPhoto').style.display = "none";
	document.getElementById('capture').style.display = "block";
	overlayContext.clearRect(0, 0, 640, 480);
}

function saveImg() {
    canvas = document.getElementById("canvas");
    overlay = document.getElementById('canvas_img');
    var img_overlay = overlay.toDataURL('image/png');
    var sendcanv= canvas.toDataURL('image/png');
    var photoshot = 'picture=' + encodeURIComponent(JSON.stringify(sendcanv)) + "&overlay=" + encodeURIComponent(JSON.stringify(img_overlay)); 
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./save_photo.php", true);
    xhttp.setRequestHeader ("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        console.log (this.responseText);
    }
    xhttp.send(photoshot); 
}

function changeOverlay(input) {
    document.getElementById("capture").disabled = false;
    document.getElementById("overlay").src = input;
    document.getElementById("overlay").style.display = "block";
}
</script>
<!-- this is where the camera stops! -->
<div class="footer">&copykroutled</div>
</body>
</html>