<?php

require_once("../../coordinator/inner/db_connection.php");

class sendattendance extends db_connection
{

    function __construct($getsemesterid, $getsubjectid, $getlectureplan, $getlecturedate, $getlectureno, $getdefaultplan, $getid)
    {
        parent::__construct();


        $check = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE `semesterid` = ? && `subjectid` = ? && `lecturedate` = ?");
        $check->bindParam(1, $getsemesterid);
        $check->bindParam(2, $getsubjectid);
        $check->bindParam(3, $getlecturedate);
        $check->execute();
        $countdate = $check->rowCount();
        if ($countdate > 0) {

            echo 4;
        } else {



            $sql = $this->conn->prepare("INSERT INTO `lectureplan`(`semesterid`, `subjectid`, `lecturedate`, `lecturehour`, `lecturetopic`) VALUES (?,?,?,?,?)");
            $sql->bindParam(1, $getsemesterid);
            $sql->bindParam(2, $getsubjectid);
            $sql->bindParam(3, $getlecturedate);
            $sql->bindParam(4, $getlectureno);
            $sql->bindParam(5, $getlectureplan);
            if ($sql->execute()) {
                $count = count($getid);
                for ($i = 0; $i < $count; $i++) {
                    $checkstudent = $this->conn->prepare("SELECT * FROM `student` WHERE `studentid` = ?");
                    $checkstudent->bindParam(1, $getid[$i]);
                    $checkstudent->execute();
                    if ($checkstudent->rowCount() == 1) {

                        $sql = $this->conn->prepare("INSERT INTO `studentabsent`(`studentid`, `subjectid`, `semesterid`, `markdate`,`lecturehour`) VALUES (?,?,?,?,?)");
                        $sql->bindParam(2, $getsubjectid);
                        $sql->bindParam(3, $getsemesterid);
                        $sql->bindParam(4, $getlecturedate);
                        $sql->bindParam(1, $getid[$i]);
                        $sql->bindParam(5, $getlectureno);
                        $sql->execute();
                    } else {
                        continue;
                    }
                }
                echo 3;
            } else {

                echo 0;
            }
        }
    }
}
if (isset($_POST['connection']) && isset($_POST['getsubjectid'])) {
    $run = new sendattendance($_POST['getsemesterid'], $_POST['getsubjectid'], $_POST['getlectureplan'], $_POST['getlecturedate'], $_POST['getlectureno'], $_POST['getdefaultplan'], $_POST['getid']);
    $run->closeConnection();
} else {

    header("Location:../../teacher/teacherlogin.html");
}