<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home | PlugNPlay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

    * {
        font-family: 'Poppins', sans-serif;
    }

    footer {
        width: 100%;
        position: absolute;
        background: linear-gradient(to right, rgb(37 39 42), rgb(83, 94, 109));
        color: #fff;
        padding: 100px 0 30px;
        /* border-top-left-radius: 125px;*/
        font-size: 13px;
        line-height: 20px;
        margin-top: 5rem;
    }

    .row {
        width: 85%;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-between;
    }

    .col {
        flex-basis: 25%;
        padding: 10px;
    }

    .col:nth-child(2),
    col:nth-child(3) {
        flex-basis: 15%;
    }

    .col h3 {
        width: fit-content;
        margin-bottom: 40px;
        position: relative;
    }

    .email {
        width: fit-content;
        border-bottom: 1px solid #ccc;
        margin: 20px 0;
    }

    ul li {
        list-style: none;
        margin-bottom: 12px;
    }

    ul li a {
        text-decoration: none;
        color: #fff;
    }

    form {
        padding-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #ece9e9;
        margin-bottom: 50px;
    }

    form .far {
        font-size: 18px;
        margin-right: 10px;
    }

    form input {
        width: 100%;
        background: transparent;
        color: white;
        border: 0;
        outline: none;
    }

    form button {
        background: transparent;
        border: 0;
        outline: none;
        cursor: pointer;
    }

    form .fa-sharp {
        font-size: 16px;
        color: #ccc;
    }

    .social-media .fa-brands {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        text-align: center;
        line-height: 40px;
        font-size: 20px;
        color: #000;
        background: #fff;
        margin-right: 15px;
        cursor: pointer;
    }

    hr {
        width: 90%;
        border: 0;
        border-bottom: 1px solid #ccc;
        margin: 20px auto;
    }

    .copy {
        text-align: center;
    }

    .line {
        width: 100%;
        height: 5xp;
        background: white;
        border-radius: 3px;
        position: absolute;
        top: 25px;
        left: 0;
    }

    @media (max-width: 700px) {
        footer {
            bottom: unset;
        }

        .col {
            flex-basis: 100%;

        }

        .col:nth-child(2),
        col:nth-child(3) {
            flex-basis: 100%;
        }
    }

    .btn-login {
        text-decoration: none;
    }

    .btn-login:hover {
        color: #fff;
        text-decoration: none;
    }

    video {
        margin: 30px 0px 10px 170px;
    }

    .alert {
        padding: 20px;
        background-color: rgb(37 39 42);
        color: white;
        margin-bottom: 15px;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }
    .row-video-list{
        display: flex;
        flex-direction:column;
    }
</style>
<?php session_start(); 
require "dbconnect.php";?>
</head>

<body>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['value'])){
        if(isset($_COOKIE['admin'])){
            echo 'cookie';
            $cookieName = 'admin';
            $cookiePath = '/';
            setcookie($cookieName, '', time() - 1, $cookiePath);
            session_unset();
        }
        else{
            session_unset();
        }
    }
    ?>
<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/">
                &nbsp;<i class="fa-solid fa-headphones"></i>
                &nbsp;PlugNPlay<?php 
                // echo $_COOKIE['admin']; 
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" style="margin-top: 10px;">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#videos">Watchlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#contact">Contact</a>
                    </li>
                    <?php
                    // echo $_COOKIE['admin'];
                    if(isset($_COOKIE['admin'])){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='adminPanel.php'>Admin Panel</a>
                        </li>";
                    }
                    // else{
                    //     echo "<script> window.location.reload(); </script>";
                    // }
                    ?>
                    <li class="nav-item" style="margin: 0 15px 0 10px;">
                    <button class="btn btn-primary">
                        <?php
                        if(isset($_SESSION['admin_check'])){
                        echo  "<a class='btn-login' id='logoutButton' href='' onclick='logout()'>Logout</a>";
                        }
                        else{
                            echo  "<a class='btn-login' id='logoutButton' href='login.php'>Login</a>";
                        }
                        ?> 
                    </button>
                    </li>
                            <?php
                            if(!isset($_SESSION['admin_check'])){
                                echo "<li class='nav-item'>
                                <button class='btn btn-primary'><a class='btn-login' href='register.php'>Register</a></button>
                                </li>";
                            }
                            ?>
                </ul>
            </div>
        </nav>
    </header>
    <?php
    // require "secure.php";
    if(isset($_SESSION["id"])){
        $userID = $_SESSION['id'];
        
        $sql = "SELECT * FROM `registration` WHERE `id` = '$userID'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $name = $row['name'];
            }
        }
        echo "<div class='alert' id='alert-id'>
        <span class='closebtn' id='closebtnid' onclick='cancleFunc()'>×</span>
        Welcome $name!
        </div>";
        session_destroy();
    }
    ?>
    <main class="container" style="margin-top: 3rem;">
        <div class="hero-image">
            <h2><b>Welcome to PulgNPlay video playing portal</b></h2>
            <p style="text-align: justify;">
                We are a dedicated platform that provides a centralized hub for educational
                and entertaining videos related to college life. Our goal is to showcase the talent, knowledge, and
                creativity within our college community. With a vast collection of recorded lectures, tutorials,
                student projects, and campus events, our platform caters to diverse academic and extracurricular
                interests. Students and faculty can also upload and share their own videos, fostering peer-to-peer
                learning and collaboration. We curate content from guest speakers and industry professionals,
                offering unique perspectives to broaden horizons. Our user-friendly interface and search functionality
                make it easy to discover relevant videos, accessible across various devices. We prioritize a safe and
                respectful environment, ensuring uploaded content adheres to guidelines. Join our vibrant community as
                we harness the power of video to shape the future of education within our college.
            </p>
        </div>
        <section id="videos">
            <h2><b>Our Videos</b></h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "videos";
        
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        if(!$conn){
            die("Failed to connect" . mysqli_connect_error($conn));
        }
        
        $sql = "SELECT * FROM `videoplayer` ORDER BY `id`";

        $result = mysqli_query($conn, $sql);
        $arrDESC = array();
        if(mysqli_num_rows($result) > 0){
            $dbLength = mysqli_num_rows($result);
            while($row = mysqli_fetch_assoc($result)){
                $videoID = $row["id"];
                $videoURL = 'uploads/' . $row["name"];
                $videoTITLE = $row["title"];
                $videoDESC = $row["description"];
                $videoUPLOAD_TIME = $row["date"];

                array_push($arrDESC, $videoDESC);

                echo "<div class='row-video-list' id='boxContentId'>
                <div>
                <video controls height='500' controlsList='nodownload'>
                <source src=".$videoURL." type='video/mp4'>
                </video>
                <p style='text-align: justify; margin-top: 15px; margin-left: 170px;'><big>".$videoTITLE."</big></p>
                <p style='margin-left: 170px;'><i><small>".$videoDESC."</small></i></p>
                <p style='margin-left: 170px;'><i><small>Upload time: ".$videoUPLOAD_TIME."</small></i></p>
                <p style='margin-left: 170px;'><i><small>Last update time: May 23, 2023, 4:03 p.m.</small></i></p>
                </div>";
            }
        }
        else{
            echo "NO videos found in database";
        }
        ?>
        </section>
    </main>
    <footer>
        <div class="row">
            <div class="col" id="about" style="margin-right: 80px;">
                <h3>About <div class="line"><span></span></div>
                </h3>
                <p style="text-align: justify;">
                    Welcome to PlugNPlay! We're a dedicated platform showcasing educational and entertaining videos
                    related to college life. Discover lectures, tutorials, student projects, and campus events. Share
                    your own videos, collaborate with peers, and explore diverse perspectives. Join us in shaping the
                    future of education within our college community.
                </p>
            </div>
            <div class="col" style="margin-right: 40px;">
                <h3>Office <div class="line"><span></span></div>
                </h3>
                <p><i class="fa-solid fa-star"></i>&nbsp;&nbsp;
                    PlugNplay
                </p>
                <p><i class="fa-solid fa-map-marker"></i>&nbsp;&nbsp;&nbsp;
                    PlugNPlay (ADDRESS)
                </p>
                <p><i class="fa-solid fa-envelope-open"></i>&nbsp;&nbsp;
                    <span class="email">plugnplay150523@gmail.com</span>
                </p>
            </div>
            <div class="col" id="contact">
                <h3>Contact<div class="line"><span></span></div>
                </h3>
                <form>
                    <i class="fa-solid fa-envelope"></i>
                    &nbsp;&nbsp;
                    <input type="email" name="contact" placeholder="Enter your email id" required>
                    <button><i class="fa-sharp fa-solid fa-arrow-right"></i></button>
                </form>
                <div class="social-media">
                    <a href="#" target="_blank"><i
                            class="fa-brands fa-facebook-f"></i></a>
                    <a target="_blank" href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" target="_blank"><i
                            class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <hr>
        <p class="copy">PlugNPlay © 2023 - All Rights Reserved</p>
    </footer>
</body>
<script>
    function cancleFunc(){
    let div = document.getElementById("alert-id");
    div.style.display = "none" ;
}

function logout() {
      var value = 1;
      
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "index.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = xhr.responseText;
            console.log(response);
          } 
          else {
            alert("Error: " + xhr.status);
          }
        }
      };
      
      xhr.send("value=" + encodeURIComponent(value));
    }

    document.getElementById('logoutButton').addEventListener('click', function(){
        location.reload();
    });
</script>
</html>