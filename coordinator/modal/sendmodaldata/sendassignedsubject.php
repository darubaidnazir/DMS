<?php
require_once("../../inner/db_connection.php");
class sendassign extends db_connection
{

    function __construct($getsemesterid, $getsubjectid, $getteacherid)

    {
        parent::__construct();
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
    }
}



if (isset($_POST['connection']) && isset($_POST["get_Semesterid"])) {
    $run = new sendassign($_POST["get_Semesterid"], $_POST['get_Subjectid'], $_POST['get_Teacherid']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}