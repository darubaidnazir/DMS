<?php

session_start();
if (!isset($_SESSION['active']) || !isset($_SESSION['userid'])) {
    header("Location:../coordinator/coordinatorlogin_signup.html");
    exit();
}
$coordinatorid = $_SESSION["userid"];
require_once("../coordinator/dbcon.php");
$output = "<option selected value='0'>Select a Branch</option>";
$sql_1 =
    $conn->prepare("SELECT * FROM `branch` WHERE `coordinatorid` = ?");
$sql_1->bindParam(1, $coordinatorid);
$sql_1->execute();
if ($sql_1->rowCount() > 0) {
    while ($row_1 = $sql_1->fetch(PDO::FETCH_ASSOC)) {
        $output .= "<option
    value='{$row_1['branchid']}'> {$row_1['branchname']}</option>";
    }
    echo $output;
} else {
    echo $output;
}
$conn =
    null;