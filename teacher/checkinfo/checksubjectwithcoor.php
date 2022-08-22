<?php
session_start();
if (!isset($_SESSION['active'])) {
    header("Location../../teacher/teacherlogin.html");
    die();
}
$coo = $_SESSION['coordinatorinfo'];
$check = $this->conn->prepare("SELECT * FROM `subject` WHERE subjectid = ? && `coordinatorid`= ?");
$check->bindParam(1, $getsemesterid);
$check->bindParam(1, $coo);
$check->execute();
$checkcountsemestercoo = $check->rowCount();