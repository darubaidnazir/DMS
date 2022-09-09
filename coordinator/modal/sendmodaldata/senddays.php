<?php
session_start();
if (!isset($_SESSION['userid']) || !isset($_POST['getdays'])) {
    header('Location:../../../coordinator/coordinatorlogin_signup.html');
    exit;
} else {


    require_once("../../dbcon.php");
    if (is_numeric($_POST['getdays'])) {
        $sql = $conn->prepare("UPDATE `timeslot` SET `updateattendance`= ? WHERE coordinatorid = ?");
        $sql->bindParam(1, $_POST['getdays']);
        $sql->bindParam(2, $_SESSION["userid"]);
        if ($sql->execute()) {
            echo 3;
        } else {
            echo 1;
        }
    } else {
        echo 0;
    }
}
$conn = null;