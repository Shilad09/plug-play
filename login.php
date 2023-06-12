<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | PlugNPlay </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  
  <style>
    body {
    background-color: #D3D3D3;
    font-family: "Roboto", sans-serif;
}

.login-page {
    width: 360px;
    padding: 8% 0 0;
    margin: auto;
}

.form {
    position: relative;
    z-index: 1;
    background: #FFFFFF;
    max-width: 360px;
    margin: 0 auto 100px;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}

.form input {
    outline: 0;
    background: #f2f2f2;
    width: 100%;
    border: 0;
    margin: 0 0 15px;
    padding: 15px;
    box-sizing: border-box;
    font-size: 14px;
}

.form button {
    text-transform: uppercase;
    outline: 0;
    background: rgb(37 39 42);
    width: 100%;
    border: 0;
    padding: 15px;
    color: #FFFFFF;
    font-size: 14px;
    -webkit-transition: all 0.3 ease;
    transition: all 0.3 ease;
    cursor: pointer;
}

.form button:hover,
.form button:active,
.form button:focus {
    background: rgb(83, 94, 109);
}

.form .message {
    margin: 15px 0 0;
    color: #b3b3b3;
    font-size: 12px;
}

.form .message a {
    color: rgb(37 39 42);
    text-decoration: none;
}

.form .register-form {
    display: none;
}

.container {
    position: relative;
    z-index: 1;
    max-width: 300px;
    margin: 0 auto;
}

.container:before,
.container:after {
    content: "";
    display: block;
    clear: both;
}

.container .info {
    margin: 50px auto;
    text-align: center;
}

.container .info h1 {
    margin: 0 0 15px;
    padding: 0;
    font-size: 36px;
    font-weight: 300;
    color: #1a1a1a;
}

.container .info span {
    color: #4d4d4d;
    font-size: 12px;
}

.container .info span a {
    color: #000000;
    text-decoration: none;
}

.container .info span .fa {
    color: #EF3B3A;
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
</style>
<?php
session_start();
//  require "secure.php";
// Replace with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videologin";

// Establish the database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// else{
//   echo "Connect was successful</br>";
// }

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $user = $_POST["username"];
  $pass = $_POST["password"];

  $sql = "SELECT * FROM `registration` WHERE `username`='$user' AND `password`= '$pass'";
  $result = mysqli_query($conn, $sql);


  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $_SESSION['id'] = $row['id'];
      $_SESSION['admin_check'] = $row['admin_check'];
      if($_SESSION['admin_check'] == 1){
        $cookieName = "admin";
        $cookieValue = $_SESSION['admin_check'];
        $cookieExpiration = time() + 86400;
        $cookiePath = "/";
        setcookie($cookieName, $cookieValue, $cookieExpiration, $cookiePath);
      }
      header('location: index.php');
      exit();
    }
  }
  else{
    echo "<script>alert('Invalid Credentials!');</script>";
    echo "<script>window.location = 'login.php';</script>";
  }
}
// else{
//   echo "server method is not POST";
// }

mysqli_close($conn);
session_destroy();
?>

</head>
<body>
<div class="login-page">
        <div class="form" method="post" action="login.php">
            <form method="post" class="login-form">
                <input type="email" placeholder="Email" name="username" required />
                <input type="password" placeholder="Password" name="password" required />
                <button>Login</button>
                <p class="message">Not registered? <a href="register.php">Create an account</a></p>
                <p class="message"><a href="index.php"><big>Back to home</big></a></p>
            </form>
        </div>
    </div>
</body>
</html>
