<?php
include_once("../inner/db_connection.php");
class deleteassignedsubject extends db_connection
{
    function __construct($getsubjectid, $getteacherid, $getsemesterid)
    {
        parent::__construct();
        $check =  $this->conn->prepare("SELECT * FROM `subject` WHERE `subjectid` = ?");
        $check->bindParam(1, $getsubjectid);
        $check->execute();
        $count = $check->rowCount();

        if ($count > 0) {
            $sqlpre = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE semesterid = ? && subjectid = ? && teacherid = ?");
            $sqlpre->bindParam(1, $getsemesterid);
            $sqlpre->bindParam(2, $getsubjectid);
            $sqlpre->bindParam(3, $getteacherid);
            $sqlpre->execute();
            $countlec = $sqlpre->rowCount();
            if ($countlec == 0) {
                $sql = $this->conn->prepare("DELETE FROM `assignedsubject` WHERE semesterid = ? && subjectid = ? && teacherid = ?");
                $sql->bindParam(1, $getsemesterid);
                $sql->bindParam(2, $getsubjectid);
                $sql->bindParam(3, $getteacherid);
                if ($sql->execute()) {
                    echo 3;
                } else {
                    echo 1;
                }
            } else {
                $disabled = "disabled";
                $sql = $this->conn->prepare("UPDATE `assignedsubject` SET `assignedstatus`= ? WHERE  semesterid = ? && subjectid = ? && teacherid = ?");
                $sql->bindParam(1, $disabled);
                $sql->bindParam(2, $getsemesterid);
                $sql->bindParam(3, $getsubjectid);
                $sql->bindParam(4, $getteacherid);
                if ($sql->execute()) {
                    echo 5;
                } else {
                    echo 1;
                }
            }
        } else {
            echo 1;
        }
    }
}


if (isset($_POST['subjectid']) && isset($_POST['connection'])) {
    $run = new deleteassignedsubject($_POST['subjectid'], $_POST['teacherid'], $_POST['semesterid']);

    $run->closeConnection();
} else {
    header("Location:../coordinatorlogin_signup.html");
}