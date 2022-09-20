<?php

require_once("../../coordinator/inner/db_connection.php");
class checktimeslot extends db_connection
{

    function  __construct($getdate, $getsemesterid, $gethour, $gettime)
    {
        parent::__construct();
        $timestamp = strtotime($gettime) + 60 * 60 * $gethour;
        $endtime = date('H:i', $timestamp);
        $status = "";
        $sql = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE  `semesterid` = ? && `lecturedate` = ?");
        $sql->bindParam(1, $getsemesterid);
        $sql->bindParam(2, $getdate);
        $sql->execute();
        $fetched = $sql->fetchAll(PDO::FETCH_ASSOC);
        if ($sql->rowCount() > 0) {
            foreach ($fetched as $row) {
                if ($gettime  >= $row['timeslotstart'] && $gettime < $row['timeslotend']) {
                    $status = 1;

                    break;
                } else if ($gettime <= $row['timeslotstart'] && $endtime > $row['timeslotstart']) {
                    $status = 4;

                    break;
                } else {
                    $status = 3;
                }
            }
        } else {
            $status = 3;
        }
        echo $status;
    }
}








if (isset($_POST['connection'])) {
    $run = new checktimeslot($_POST['getdate'], $_POST['getsemesterid'], $_POST['gethour'], $_POST['gettime']);
    $run->closeConnection();
} else {
    header("Location:../teacherlogin.html");
}