<?php
session_start();
require_once("../../coordinator/inner/db_connection.php");
class loadtimeslot extends db_connection
{

    function  __construct($getdate)
    {
        parent::__construct();
        date_default_timezone_set("Asia/Kolkata");
        $date2 = date('Y-m-d');
        $date1 = $getdate;
        $getsomedate = $this->conn->prepare("SELECT * FROM `timeslot` WHERE `coordinatorid` = ?");
        $getsomedate->bindParam(1, $_SESSION['$coordinatorinfo']);
        $getsomedate->execute();
        $fetch = $getsomedate->fetchAll(PDO::FETCH_ASSOC);
        $coordinatordate = "0";
        foreach ($fetch as $row) {
            $coordinatordate = $row['attendancerecord'];
           
            break;
        }
        

        $diff = abs(strtotime($date2) - strtotime($date1));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        if ($days > $coordinatordate) {
            
            echo 5;
            exit();
        }
        $output = "<option value='0' selected>Select a Time Slot</option>";
        $start = "";
        $end = "";
        $sql = $this->conn->prepare("SELECT * FROM `timeslot` WHERE `coordinatorid` = ?");
        $sql->bindParam(1, $_SESSION['$coordinatorinfo']);
        $sql->execute();
        $fetch = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($fetch as $row) {
            $start = $row['start'];
            $end = $row['end'];
            break;
        }

        $slots = $this->getTimeSlot(30, $start, $end);
        $length = count($slots);

        for ($i = 1; $i <= $length; $i++) {

            $output .= "<option value='{$slots[$i]['slot_start_time']}'>{$slots[$i]['slot_start_time']}</option>";
        }
        echo $output;
    }

    public function getTimeSlot($interval, $start_time, $end_time)
    {
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);
        $startTime = $start->format('H:i');
        $endTime = $end->format('H:i');
        $i = 0;
        $time = [];
        while (strtotime($startTime) <= strtotime($endTime)) {
            $start = $startTime;
            $end = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($startTime)));
            $startTime = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($startTime)));
            $i++;
            if (strtotime($startTime) <= strtotime($endTime)) {
                $time[$i]['slot_start_time'] = $start;
                $time[$i]['slot_end_time'] = $end;
            }
        }
        return $time;
    }
}








if (isset($_POST['connection'])) {
    $run = new loadtimeslot($_POST['getdate']);
    $run->closeConnection();
} else {
    header("Location:../teacherlogin.html");
}