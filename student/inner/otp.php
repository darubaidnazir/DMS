<?php
if(!isset($_POST['email_otp']) || !isset($_POST['connection']) || $_POST['connection'] != true){
    header("Location:../studentlogin.html");
    exit();
}
$email = $_POST["email_otp"];
$random = rand(10000,99999);
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo 0;
}else{
$to_email = $email;
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
}