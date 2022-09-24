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
    $timeslot = array("09:00", "09:05", "09:10", "09:15", "09:20", "09:25", "09:30", "09:35", "09:40", "09:45", "09:50", "09:55", "10:00", "10:05", "10:10", "10:15", "10:20", "10:25", "10:30", "10:35", "10:40", "10:45", "10:50", "10:55", "11:00", "11:05", "11:10", "11:15", "11:20", "11:25", "11:30", "11:35", "11:40", "11:45", "11:50", "11:55", "12:00", "12:05", "12:10", "12:15", "12:20", "12:25", "12:30", "12:35", "12:40", "12:45", "12:50", "12:55", "13:00", "13:05", "13:10", "13:15", "13:20", "13:25", "13:30", "13:35", "13:40", "13:45", "13:50", "13:55", "14:00", "14:05", "14:10", "14:15", "14:20", "14:25", "14:30", "14:35", "14:40", "14:45", "14:50", "14:55", "15:00", "15:05", "15:10", "15:15", "15:20", "15:25", "15:30", "15:35", "15:40", "15:45", "15:50", "15:55", "16:00", "16:05", "16:10", "16:15", "16:20", "16:25", "16:30", "16:35", "16:40", "16:45", "16:50", "16:55", "17:00", "17:05", "17:10", "17:15", "17:20", "17:25", "17:30", "17:35", "17:40", "17:45", "17:50", "17:55", "18:00", "18:05", "18:10", "18:15", "18:20", "18:25", "18:30", "18:35", "18:40", "18:45", "18:50", "18:55", "19:00", "19:05", "19:10", "19:15", "19:20", "19:25");
    if (in_array($start, $timeslot) && in_array($end, $timeslot)) {
        $status = true;
    } else {
        $status = false;
    }
    return $status;
}
$conn = null;