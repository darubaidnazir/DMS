<?php
$db_name = "mysql:host=localhost;dbname=DMStest";
$username = "root";
$password = "";
try{
$conn = new PDO($db_name, $username, $password);
}catch(PDOException $obj){
echo 'Connection error';
}
?>