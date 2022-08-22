<?php
session_start();
if (!isset($_SESSION['active'])) {
    header("Location../../teacher/teacherlogin.html");
    die();
}

$check = $this->conn->prepare("SELECT * FROM `semester` WHERE semesterid = ?");
$check->bindParam(1, $getsemesterid);
$check->execute();
$checkcountsemester = $check->rowCount();