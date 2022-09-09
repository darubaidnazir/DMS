<?php
session_start();
if (!isset($_SESSION['userid']) || !isset($_POST['getstart'])) {
    header('Location:../../../coordinator/coordinatorlogin_signup.html');
    exit;
} else {


    require_once("../../../coordinator/dbcon.php");
    $sql = $conn->prepare("SELECT * FROM `timeslot` WHERE `coordinatorid` = ?");
    $sql->bindParam(1, $_SESSION['userid']);
    $sql->execute();
    if (timeisvalid($_POST['getstart'], $_POST['getend'])) {
        if ($sql->rowCount() > 0) {
            $update = $conn->prepare("UPDATE `timeslot` SET `start`= ?,`end`= ? WHERE coordinatorid = ?");
            $update->bindParam(1, $_POST['getstart']);
            $update->bindParam(2, $_POST['getend']);
            $update->bindParam(3, $_SESSION['userid']);
            if ($update->execute()) {
                echo 3;
            } else {
                echo 1;
            }
        } else {
            $insert = $conn->prepare("INSERT INTO `timeslot`(`start`, `end`, `coordinatorid`) VALUES (?,?,?)");
            $insert->bindParam(1, $_POST['getstart']);
            $insert->bindParam(2, $_POST['getend']);
            $insert->bindParam(3, $_SESSION['userid']);
            if ($insert->execute()) {
                echo 3;
            } else {
                echo 1;
            }
        }
    } else {
        echo 0;
    }
}
function timeisvalid($start, $end)
{
    $status = false;
    $timeslot = array("9:00", "09:15", "9:30", "09:45", "10:00", "10:15", "10:30", "10:45", "11:00", "11:15", "11:30", "11:45", "12:00", "12:15", "12:30", "12:45", "13:00", "13:15", "13:30", "13:45", "14:00", "14:15", "14:30", "14:45", "15:00", "15:15", "15:30", "15:45", "16:00", "16:15", "16:30", "16:45", "17:00", "17:15", "17:30", "17:45", "18:00");
    if (in_array($start, $timeslot) && in_array($end, $timeslot)) {
        $status = true;
    } else {
        $status = false;
    }
    return $status;
}
$conn = null;