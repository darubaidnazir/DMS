<?php
require_once("../../coordinator/inner/db_connection.php");
class loadupdaterecord extends db_connection
{

    function  __construct($getsemesterid, $getsubjectid, $getstudentid, $getvalue)
    {
        parent::__construct();
        $output = "";
        $output .= "<div class-'m-3'><p class='fw-bold text-uppercase'> Student Record</p><table class='table table-success table-striped'><tr>
        <td class='table-secondary''>Current Status</td>
        <td class='table-secondary'>Action</td>
    </tr>";
        $sql = $this->conn->prepare("SELECT * FROM `studentabsent` WHERE `semesterid` = ? && `subjectid` = ? && `studentid` = ? && `markdate`= ?");
        $sql->bindParam(1, $getsemesterid);
        $sql->bindParam(2, $getsubjectid);
        $sql->bindParam(3, $getstudentid);
        $sql->bindParam(4, $getvalue);
        $sql->execute();
        $count = $sql->rowCount();
        if ($count == 0) {
            $output .= "<tr style='color:white;font-weight:bold;'>
                <td style='color:green;' class='table-primary'>Present</td>
                <td style='color:green;' class='table-primary'><button class='btn btn-danger' id='marknew'  data-value='0'>Mark Absent </button></td>
                </tr>";
        } else {
            $output .= "<tr style='color:white;font-weight:bold;'>
            <td style='color:red;' class='table-primary'>Absent</td>
            <td style='color:green;' class='table-primary'><button class='btn btn-success' id='marknew' data-value='1'>Mark Present </button></td>
            </tr>";
        }
        echo $output;
    }
}








if (isset($_POST['connection']) && isset($_POST['getsemesterid'])) {
    $run =  new loadupdaterecord($_POST['getsemesterid'], $_POST['getsubjectid'], $_POST['getstudentid'], $_POST['getvalue']);
    $run->closeConnection();
} else {
    header("Location:../../../teacherlogin.html");
}
