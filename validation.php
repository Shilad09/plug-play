<style>
    .alert {
    padding: 20px;
    background-color: rgb(37 39 42);
    color: white;
    margin-bottom: 15px;
}
a:link{
    text-decoration: none;
    background-color: rgb(245, 128, 219);
}
a:hover{
    cursor: pointer;
}
</style>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<?php
error_reporting(0);
session_start();
if(isset($_SESSION['serverOTP'])){
    $serverOTP = $_SESSION['serverOTP'];
    session_destroy();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo $serverOTP;
    if ($serverOTP == $_POST["otp-input"]) {
        echo "<div class='alert' id='alert-id'>
        <p id='otp-msg'>Verification successful <a href='login.php'>Click Here</a> to login</p>
    </div>";
    }
    else {
        echo "<script>alert('OTP does not match, please enter a valid OTP!');</script>";
        // echo var_dump($serverOTP);
    }
}
?>
