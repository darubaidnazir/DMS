<?php
session_start();
$verify = $_POST["verify_otp"];
$old_otp = $_SESSION["otp"];
if($old_otp == $verify){
    echo 1;
}
else{
    echo 2;
}