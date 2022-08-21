<?php
require_once("../../coordinator/inner/db_connection.php");
class loaddate extends db_connection
{

    function  __construct($getsemesterid, $getsubjectid)
    {
        parent::__construct();
        $output = "<option value='0' selected>Select a Date & Lecture</option>";
        $sql = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE `semesterid` = ? && `subjectid` = ?");
        $sql->bindParam(1, $getsemesterid);
        $sql->bindParam(2, $getsubjectid);
        $sql->execute();
        if ($sql->rowCount() > 0) {

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $string = $row['lecturedate'];
                $string .= " - ";
                $string .= $row['lecturetopic'];
                $output .= "<option  value='{$row['lecturedate']}'>{$string}</option>";
            }
        } else {
        }
        echo $output;
    }
}








if (isset($_POST['connection']) && isset($_POST['getsemesterid'])) {
    $run =  new loaddate($_POST['getsemesterid'], $_POST['getsubjectid']);
    $run->closeConnection();
} else {
    header("Location:../../../teacherlogin.html");
}