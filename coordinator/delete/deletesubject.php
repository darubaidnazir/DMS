<?php
include_once("../inner/db_connection.php");
class deletesubject extends db_connection
{
    function __construct($getsubjectid)
    {
        parent::__construct();
        $check =  $this->conn->prepare("SELECT * FROM `subject` WHERE `subjectid` = ?");
        $check->bindParam(1, $getsubjectid);
        $check->execute();
        $count = $check->rowCount();

        if ($count > 0) {
            $sqlpre = $this->conn->prepare("SELECT * FROM `subject` INNER join lectureplan on subject.subjectid = lectureplan.subjectid WHERE subject.subjectid = ?");
            $sqlpre->bindParam(1, $getsubjectid);
            $sqlpre->execute();
            $count = $sqlpre->rowCount();
            if ($count == 0) {
                $sql = $this->conn->prepare("DELETE FROM `assignedsubject` WHERE `subjectid` = ?");
                $sql->bindParam(1, $getsubjectid);
                if ($sql->execute()) {
                    $sql = $this->conn->prepare("DELETE FROM `subject` WHERE `subjectid` = ?");
                    $sql->bindParam(1, $getsubjectid);
                    if ($sql->execute()) {
                        echo 3;
                    } else {
                        echo 1;
                    }
                } else {
                    echo 1;
                }
            } else {
                echo 2;
            }
        } else {
            echo 1;
        }
    }
}


if (isset($_POST['get_Subjectid']) && isset($_POST['connection'])) {
    $run = new deletesubject($_POST['get_Subjectid']);

    $run->closeConnection();
} else {
    header("Location:../coordinatorlogin_signup.html");
}