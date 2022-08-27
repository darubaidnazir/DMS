<?php
require_once("../../../coordinator/inner/db_connection.php");
class sendrequest extends db_connection
{

    function __construct($getsemesterid, $getsubjectid, $getteacherid, $getvalue)

    {
        parent::__construct();
        $val = 1;
        if ($getvalue == 1) {  /// accept
            $sql = $this->conn->prepare("UPDATE `assignedsubject` SET `updatepermission`= ? WHERE `subjectid`= ? && `semesterid` = ? && `teacherid` = ?");
            $sql->bindParam(1, $val);
            $sql->bindParam(2, $getsubjectid);
            $sql->bindParam(3, $getsemesterid);
            $sql->bindParam(4, $getteacherid);
            if ($sql->execute()) {
                echo 3;
            } else {
                echo 1;
            }
        } else if ($getvalue ==  2) { // reject
            $val = 0;
            $sql = $this->conn->prepare("UPDATE `assignedsubject` SET `updatepermission`= ? WHERE `subjectid`= ? && `semesterid` = ? && `teacherid` = ?");
            $sql->bindParam(1, $val);
            $sql->bindParam(2, $getsubjectid);
            $sql->bindParam(3, $getsemesterid);
            $sql->bindParam(4, $getteacherid);
            if ($sql->execute()) {
                echo 4;
            } else {
                echo 1;
            }
        } else {
        }
    }
}



if (isset($_POST['connection']) && isset($_POST["getsemesterid"])) {
    $run = new sendrequest($_POST["getsemesterid"], $_POST['getsubjectid'], $_POST['getteacherid'], $_POST['getvalue']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}