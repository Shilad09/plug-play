<!DOCTYPE html>
<html>

<head>
    <title>Register | PlugNPlay</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<?php
error_reporting(0);
require "dbconnect.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendOtp($email, $otp){
    require "vendor/autoload.php";
            
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "plugnplay150523@gmail.com";
                $mail->Password = "bvmkbplswgmejwtx";
                $mail->SMTPSecure = "tls";
                $mail->Port = 587;
                
                $mail->setFrom("plugnplay150523@gmail.com", "PlugNPlay");
                
                $mail->addAddress($email);
                $mail->Subject = "Email Verification";
                $mail->Body = "The OTP for verifying your email is " . $otp;
                
                $mail->send();

                return true;
                
            }
            catch (Exception $e) {
                echo "Otp could not be sent. Error: " . $mail->ErrorInfo;
                return false;
            }

}


?>
</head>

<body>
<?php
$var = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $name = $_POST["fullname"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $cpass = $_POST["cpassword"];
    $otp = mt_rand(1000, 9999);
    $_SESSION['serverOTP'] = $otp;
    if ($pass == $cpass) {

        $sql = "INSERT INTO `registration` (`name`, `username`, `password`, `otp`) VALUES ('$name', '$email', '$pass', '$otp')";
        if (!mysqli_query($conn, $sql)) {
            echo "ERROR: " . mysqli_error($conn);
        } else {
            $var = sendOtp($email, $otp);
        }
            
        }
    else {
        echo "<script>alert('Password does not match'); window.location.href = 'register.php';</script>";
        exit();
    }

    mysqli_close($conn);
}
if(!$var){
    echo "<div class='login-page'>
    <div class='form'>
        <form id='post-form' class='login-form' method='post' action='register.php'>
            <input type='text' name='fullname' placeholder='Full name' id='fullname' class='next' required />
            <input type='email' name='email' placeholder='Email' id='email' class='next' required />
            <input type='password' name='password' placeholder='Password' id='password' class='next' required />
            <input type='password' name='cpassword' placeholder='Confirm password' id='cpassword' class='next'
            required />
            <button>Register</button>
            <p class='message'>Already have an account? <a href='login.php'>Login here</a></p>
            <p class='message'><a href='index.php'><big>Back to home</big></a></p>
            </form>
            </div>
            </div>";
}
else{
        echo "<div class='login-page'>
                <div class='form'>
                    <form id='post-form' class='login-form' method='post' action='validation.php'>
                        <input type='text' name='otp-input' placeholder='OTP' id='otp' required/>
                        <button>Verify</button>
                    </form>
                </div>
            </div>";
}
?>


</body>

<style>
    /* #otp,
    .alert {
        display: none;
    } */
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


</style>

<script src="script.js">
</script>

</html>