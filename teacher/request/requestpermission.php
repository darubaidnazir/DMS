<?php
require_once("../../coordinator/inner/db_connection.php");
class loaddate extends db_connection
{

    function  __construct($getsemesterid, $getsubjectid, $getteacherid)
    {
        parent::__construct();
        $info = 2;
        $sql = $this->conn->prepare("UPDATE `assignedsubject` SET `updatepermission`= ? WHERE `teacherid`= ? && `subjectid` = ? && `semesterid` = ?");
        $sql->bindParam(1, $info);
        $sql->bindParam(2, $getteacherid);
        $sql->bindParam(3, $getsubjectid);
        $sql->bindParam(4, $getsemesterid);
        if ($sql->execute()) {
            echo 3;
        } else {
            echo 1;
        }
    }
}








if (isset($_POST['connection']) && isset($_POST['getsemesterid'])) {
    $run =  new loaddate($_POST['getsemesterid'], $_POST['getsubjectid'], $_POST['getteacherid']);
    $run->closeConnection();
} else {
    header("Location:../../../teacherlogin.html");
}