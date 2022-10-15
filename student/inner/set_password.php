<?php
if(!isset($_POST['email_login']) || !isset($_POST['connection']) || !isset($_POST['login_password'])){
    header("Location:../studentlogin.html");
    die();
}else{
require_once("../../coordinator/dbcon.php");
$password=$_POST["login_password"];
$email = $_POST['email_login'];
$confirmpassword = $_POST['confirmpassword'];
if(filter_var($email, FILTER_VALIDATE_EMAIL) && $password === $confirmpassword){
$status="active";
$newpassword =  password_hash($password,PASSWORD_DEFAULT);
$sql = $conn->prepare("UPDATE student SET studentpassword= ?,studentstatus=? WHERE studentemail=?");
$sql->bindparam(1,$newpassword);
$sql->bindparam(2,$status);
$sql->bindparam(3,$email);
$sql->execute();
if($sql->rowCount() == 1){
    echo 1;
}
else{
    echo 2;
}
}else{
    echo 0;
}
}
