<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<?php
if(isset($_POST['sendotp'])){

require('textlocal.class.php');
require('credentials.php');

$textlocal = new Textlocal(false, false, API_KEY);

$numbers = array(MOBILE);
$sender = '4424';
$otp = mt_rand(10000, 99999);
$message = 'hello'. $_POST['name'] .'  This is your OTP: ' . $otp;

try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    setcookie('otp', $otp);
    echo "OTP Successfully Sent";
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
}
if(isset($_POST['ver'])){
    $otp = $_POST['otp'];
    if($_COOKIE['otp']== $otp){
        echo "your number is verified";
    }else{
        echo 'Please enter Correct OTP';
    }
}
?>

<body>
<form action="otp.php" method="post">
<table align="center">
    <tr>
        <td>name</td>
        <td><input type="text" name="name" id="name" placeholder="enter your name"></td>
    </tr>
    <tr>
        <td>phone number</td>
        <td><input type="text" name="num" placeholder="valid!with country code"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="login" value="sing(login)[send otp]" style="color: blue; border: 0px;"></td>
    </tr>
    <tr>
        <td>verify OTP:</td>
        <td><input type="text" name="otp" placeholder="enter recieved otp"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="ver" value="verify otp" style="background-color: green; border: 0px;"></td>
    </tr>
</table>
</form>
</body>
</html>