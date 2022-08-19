<?php

require_once("../../coordinator/inner/db_connection.php");

class sendattendance extends db_connection
{

    function __construct($getsemesterid, $getsubjectid, $getlectureplan, $getlecturedate, $getlectureno, $getdefaultplan, $getid)
    {
        parent::__construct();

        $sql = $this->conn->prepare("INSERT INTO `lectureplan`(`semesterid`, `subjectid`, `lecturedate`, `lecturehour`, `lecturetopic`) VALUES (?,?,?,?,?)");
        $sql->bindParam(1, $getsemesterid);
        $sql->bindParam(2, $getsubjectid);
        $sql->bindParam(3, $getlecturedate);
        $sql->bindParam(4, $getlectureno);
        $sql->bindParam(5, $getlectureplan);
        if ($sql->execute()) {
            $count = count($getid);
            for ($i = 0; $i < $count; $i++) {
                $sql = $this->conn->prepare("INSERT INTO `studentabsent`(`studentid`, `subjectid`, `semesterid`, `date`) VALUES (?,?,?,?)");
                $sql->bindParam(2, $getsubjectid);
                $sql->bindParam(3, $getsemesterid);
                $sql->bindParam(4, $getlecturedate);
                $sql->bindParam(1, $getid[$i]);
                $sql->execute();
            }
            echo 3;
        } else {

            echo 0;
        }
    }
}
if (isset($_POST['connection']) && isset($_POST['getsubjectid'])) {

    $run = new sendattendance($_POST['getsemesterid'], $_POST['getsubjectid'], $_POST['getlectureplan'], $_POST['getlecturedate'], $_POST['getlectureno'], $_POST['getdefaultplan'], $_POST['getid']);
} else {

    header("Location:../../teacher/teacherlogin.html");
}