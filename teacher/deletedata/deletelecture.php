<?php
require_once("../../coordinator/inner/db_connection.php");
class deletelecture extends db_connection
{

    function __construct($getdate, $getsubjectid, $getsemesterid)
    {
        parent::__construct();
        date_default_timezone_set("Asia/Calcutta");

        $check = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE `subjectid` = ? && `semesterid` = ? && `lecturedate` = ? ");
        $check->bindParam(1, $getsubjectid);
        $check->bindParam(2, $getsemesterid);
        $check->bindParam(3, $getdate);
        $check->execute();
        $fetch = $check->fetch(PDO::FETCH_ASSOC);
        $date = $fetch['creationtime'];
        $todaydate = date("Y-m-d");
        if ($date === $todaydate) {


            $deletelecture = $this->conn->prepare("DELETE FROM `lectureplan` WHERE `subjectid` = ? && `semesterid` = ? && `lecturedate` = ?");
            $deletelecture->bindParam(1, $getsubjectid);
            $deletelecture->bindParam(2, $getsemesterid);
            $deletelecture->bindParam(3, $getdate);
            if ($deletelecture->execute()) {

                $deletelecture = $this->conn->prepare("DELETE FROM `studentabsent` WHERE `subjectid` = ? && `semesterid` = ? && `markdate` = ?");
                $deletelecture->bindParam(1, $getsubjectid);
                $deletelecture->bindParam(2, $getsemesterid);
                $deletelecture->bindParam(3, $getdate);
                if ($deletelecture->execute()) {
                    echo 3;
                } else {
                    echo 0;
                }
            } else {

                echo 0;
            }
        } else {

            echo 1;
        }
    }
}




















if (isset($_POST['connection']) && isset($_POST['getdate'])) {
    $run =  new deletelecture($_POST['getdate'], $_POST['getsubjectid'], $_POST['getsemesterid']);
    $run->closeConnection();
} else {
    header("Location:../../../teacherlogin.html");
}