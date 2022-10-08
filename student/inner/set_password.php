<?php
session_start();
require_once("../../coordinator/dbcon.php");
$password=$_POST["login_password"];
$status="active";
$email=$_SESSION["email"];
$sql = $conn->prepare("UPDATE student SET studentpassword= ?,studentstatus=? WHERE studentemail=?");
$sql->bindparam(1,$password);
$sql->bindparam(2,$status);
$sql->bindparam(3,$email);
$sql->execute();
if($sql->rowCount() == 1){
    echo 1;
}
else{
    echo 2;
}
session_destroy();

