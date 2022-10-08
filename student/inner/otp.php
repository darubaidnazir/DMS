<?php
$email = $_POST["email_otp"];
$random = rand(10000,99999);
//$random = "11111";
$to_email = "zaminahmaddar2614@gmail.com";
$subject = "OTP verification for student registration";
$body = $random;
$headers = "From:zaminahmaddar2614@gmail.com";
if(mail($to_email, $subject, $body, $headers)){
    session_start();
    $_SESSION["otp"]=$random;
    echo 1;
}
else{
    echo 2;
}
