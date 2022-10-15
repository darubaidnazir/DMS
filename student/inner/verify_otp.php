<?php
session_start();
if(!isset($_SESSION['otp']) || $_POST['connection'] != true || !isset($_POST['connection'])){
    header("Location:../studentlogin.html");
    die();
}
$verify = $_POST["verify_otp"];
$old_otp = $_SESSION["otp"];
if($old_otp == $verify){
    echo 1;
   
}
else{
    echo 2;
}
session_destroy();