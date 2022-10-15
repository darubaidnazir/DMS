<?php
require_once("../../../coordinator/inner/db_connection.php");
class SendExtra extends db_connection
{

    function  __construct($percentage, $remark, $studentid, $semesterid)
    {
        parent::__construct();
        if ($percentage == "" || $percentage == 0 || $percentage > 99 || $remark == "" || !is_numeric($percentage)) {
            echo 1;
        } else {
            $sql = $this->conn->prepare("SELECT * FROM `extraattendance` WHERE studentid = ? and semesterid = ?");
            $sql->bindParam(1, $studentid);
            $sql->bindParam(2, $semesterid);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $sql = $this->conn->prepare("UPDATE `extraattendance` SET `studentid`= ?,`semesterid`= ? ,`percentage`= ?,`remark`= ? WHERE studentid = ? and semesterid = ?");
                $sql->bindParam(1, $studentid);
                $sql->bindParam(2, $semesterid);
                $sql->bindParam(3, $percentage);
                $sql->bindParam(4, $remark);
                $sql->bindParam(5, $studentid);
                $sql->bindParam(6, $semesterid);
                if ($sql->execute()) {
                    echo 2;
                } else {
                    echo 1;
                }
            } else {
                $sql = $this->conn->prepare("INSERT INTO `extraattendance`(`studentid`, `semesterid`, `percentage`, `remark`) VALUES (?,?,?,?)");
                $sql->bindParam(1, $studentid);
                $sql->bindParam(2, $semesterid);
                $sql->bindParam(3, $percentage);
                $sql->bindParam(4, $remark);
                if ($sql->execute()) {
                    echo 3;
                } else {
                    echo 1;
                }
            }
        }
    }
}



if (isset($_POST['connection']) && isset($_POST['studentid'])) {
    $run =  new SendExtra($_POST['percentage'], $_POST['remark'], $_POST['studentid'], $_POST['semesterid']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}