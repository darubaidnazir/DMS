<?php
require_once("../../inner/db_connection.php");
class sendassign extends db_connection
{

    function __construct($getsemesterid, $getsubjectid, $getteacherid)

    {
        parent::__construct();

        $check =  $this->conn->prepare("SELECT * FROM `teacher` WHERE `teacherid` = ?");
        $check->bindParam(1, $getteacherid);
        $check->execute();
        $countteacher = $check->rowCount();
        $check =  $this->conn->prepare("SELECT * FROM `subject` WHERE `subjectid` = ?");
        $check->bindParam(1, $getsubjectid);
        $check->execute();
        $countsubject = $check->rowCount();
        $check =  $this->conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ?");
        $check->bindParam(1, $getsemesterid);
        $check->execute();
        $countsemester = $check->rowCount();
        if($countteacher > 0 && $countsemester >0 && $countsubject > 0){
        $sql = $this->conn->prepare("SELECT * FROM `assignedsubject` WHERE semesterid = ? && subjectid = ?");
        $sql->bindParam(1, $getsemesterid);
        $sql->bindParam(2, $getsubjectid);
        $sql->execute();
        $count = $sql->rowCount();
        if ($count > 0) {
            // already assigned
            echo 2;
        } else {
            $sql = $this->conn->prepare("INSERT INTO `assignedsubject`(`subjectid`, `semesterid`,`teacherid`) VALUES (?,?,?)");
            $sql->bindParam(2, $getsemesterid);
            $sql->bindParam(1, $getsubjectid);
            $sql->bindParam(3, $getteacherid);
            if ($sql->execute()) {
                echo 3;
                //done
            } else {
                echo 1;
                //something wongs
            }
        }
    } else{
        echo 0;
    }
}
   
}



if (isset($_POST['connection']) && isset($_POST["get_Semesterid"])) {
    $run = new sendassign($_POST["get_Semesterid"], $_POST['get_Subjectid'], $_POST['get_Teacherid']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}