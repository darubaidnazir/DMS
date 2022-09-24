<?php
session_start();

require_once("../../coordinator/inner/db_connection.php");

class sendattendance extends db_connection
{

    function __construct($getsemesterid, $getsubjectid, $getlectureplan, $getlecturedate, $getlectureno, $getdefaultplan, $getid, $gettimeslot, $group)
    {
        parent::__construct();
        $timeslot = array("09:00", "09:05", "09:10", "09:15", "09:20", "09:25", "09:30", "09:35", "09:40", "09:45", "09:50", "09:55", "10:00", "10:05", "10:10", "10:15", "10:20", "10:25", "10:30", "10:35", "10:40", "10:45", "10:50", "10:55", "11:00", "11:05", "11:10", "11:15", "11:20", "11:25", "11:30", "11:35", "11:40", "11:45", "11:50", "11:55", "12:00", "12:05", "12:10", "12:15", "12:20", "12:25", "12:30", "12:35", "12:40", "12:45", "12:50", "12:55", "13:00", "13:05", "13:10", "13:15", "13:20", "13:25", "13:30", "13:35", "13:40", "13:45", "13:50", "13:55", "14:00", "14:05", "14:10", "14:15", "14:20", "14:25", "14:30", "14:35", "14:40", "14:45", "14:50", "14:55", "15:00", "15:05", "15:10", "15:15", "15:20", "15:25", "15:30", "15:35", "15:40", "15:45", "15:50", "15:55", "16:00", "16:05", "16:10", "16:15", "16:20", "16:25", "16:30", "16:35", "16:40", "16:45", "16:50", "16:55", "17:00", "17:05", "17:10", "17:15", "17:20", "17:25", "17:30", "17:35", "17:40", "17:45", "17:50", "17:55", "18:00", "18:05", "18:10", "18:15", "18:20", "18:25", "18:30", "18:35", "18:40", "18:45", "18:50", "18:55", "19:00", "19:05", "19:10", "19:15", "19:20", "19:25");
        if (in_array($gettimeslot, $timeslot)) {

            $groups = array("BOTH", "G1", "G2");
            for ($i = 0; $i <= 2; $i++) {
                $check = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE `semesterid` = ? && `subjectid` = ? && `lecturedate` = ? && groups = ?");
                $check->bindParam(1, $getsemesterid);
                $check->bindParam(2, $getsubjectid);
                $check->bindParam(3, $getlecturedate);
                $check->bindParam(4, $groups[$i]);
                $check->execute();
                $countdate = $check->rowCount();
                if ($countdate > 0) {
                    break;
                }
            }


            if ($countdate > 0) {

                echo 4;
            } else {





                $timestamp = strtotime($gettimeslot) + 60 * 60 * $getlectureno;
                $time = date('H:i', $timestamp);



                $sql = $this->conn->prepare("INSERT INTO `lectureplan`(`semesterid`, `subjectid`, `lecturedate`, `lecturehour`, `lecturetopic`,`timeslotstart`,`timeslotend`,`teacherid`,`groups`) VALUES (?,?,?,?,?,?,?,?,?)");
                $sql->bindParam(1, $getsemesterid);
                $sql->bindParam(2, $getsubjectid);
                $sql->bindParam(3, $getlecturedate);
                $sql->bindParam(4, $getlectureno);
                $sql->bindParam(5, $getlectureplan);
                $sql->bindParam(6, $gettimeslot);
                $sql->bindParam(7, $time);
                $sql->bindParam(8, $_SESSION['teacheruserid']);
                $sql->bindParam(9, $group);

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
        } else {
            echo 0;
        }
    }
}
if (isset($_POST['connection']) && isset($_POST['getsubjectid']) && $_POST['group']) {
    $run = new sendattendance($_POST['getsemesterid'], $_POST['getsubjectid'], $_POST['getlectureplan'], $_POST['getlecturedate'], $_POST['getlectureno'], $_POST['getdefaultplan'], $_POST['getid'], $_POST['gettimeslot'], $_POST['group']);
    $run->closeConnection();
} else {

    header("Location:../../teacher/teacherlogin.html");
}