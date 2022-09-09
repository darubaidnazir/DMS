<?php
require_once("../../coordinator/inner/db_connection.php");
class loadupdaterecord extends db_connection
{

    function  __construct($getsemesterid, $getsubjectid, $getstudentid, $getvalue)
    {
        parent::__construct();
        $accesslevel = 0;
        if (!isset($_POST['accesslevel'])) {
            $accesslevel = 1;
        }

        if ($accesslevel == 0) {
            $sql = $this->conn->prepare("SELECT * FROM `updateattendance` WHERE `studentid`= ? && `subjectid` = ? && `semesterid` = ? && `updatedate` = ?");
            $sql->bindParam(1, $getstudentid);
            $sql->bindParam(2, $getsubjectid);
            $sql->bindParam(3, $getsemesterid);
            $sql->bindParam(4, $getvalue);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            $count = $sql->rowCount();

            $output = "";

            $output .= "<div class-'m-3'><p class='fw-bold text-uppercase'> Student Record
            <br> <span style='color:red;' id='mess'></span></p><table class='table table-success table-striped'><tr>
            <td class='table-secondary''>Current Status</td>
            <td class='table-secondary'>Remark</td>
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
                    <td class='table-primary' > <input type='text' class='form-control' placeholder='enter a remark...' id='remakmessage'/></td>
                    <td style='color:green;' class='table-primary'><button class='btn btn-danger' id='marknew'  data-value='0'>Mark Absent </button></td>
                    </tr>";
            } else {
                $output .= "<tr style='color:white;font-weight:bold;'>
                <td style='color:red;' class='table-primary'>Absent</td>
                <td class='table-primary'> <input type='text' class='form-control' placeholder='enter a remark...' id='remakmessage'/></td>
                <td style='color:green;' class='table-primary'><button class='btn btn-success' id='marknew' data-value='1'>Mark Present </button></td>
                </tr>";
            }

            $output .= "<div class-'m-3'><p class='fw-bold text-uppercase'> Student Record
                <br> <span style='color:red;' id='mess'></span></p><table class='table table-success table-striped'><tr>
                <td class='table-secondary''>Updated Mark</td>
                <td class='table-secondary''>Updated BY</td>
                <td class='table-secondary'>Remark</td>
                <td class='table-secondary'>Update Time</td>
                <td class='table-secondary'>Attendance Date</td>
                </tr>";
            foreach ($result as $record) {
                $marked = $record['action'];
                $marked2 = $record['updatedby'];
                if ($marked2 == 1) {
                    $marked2 = "Teacher";
                } else if ($marked2 == 0) {
                    $marked2 = "Coordinator";
                }
                if ($marked == 1) {
                    $marked = "Present";
                } else {
                    $marked = "Absent";
                }

                $output .= "<tr style='color:white;font-weight:bold;'>
                    <td style='color:green;' class='table-primary'>{$marked}</td>
                    <td style='color:red;' class='table-primary'>{$marked2}</td>
                    <td style='color:white;' class='table-primary' >{$record["message"]}</td>
                    <td style='color:white;' class='table-primary' >{$record["time"]}</td>
                    <td style='color:green;' class='table-primary'>{$record["updatedate"]}</td>
                    </tr>";
            }


            echo $output;
        } else if ($accesslevel == 1) {
            $sql = $this->conn->prepare("SELECT * FROM `updateattendance` WHERE `studentid`= ? && `subjectid` = ? && `semesterid` = ? && `updatedate` = ?");
            $sql->bindParam(1, $getstudentid);
            $sql->bindParam(2, $getsubjectid);
            $sql->bindParam(3, $getsemesterid);
            $sql->bindParam(4, $getvalue);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            $count = $sql->rowCount();

            $output = "";
            if ($count == 0) {
                $output .= "<div class-'m-3'><p class='fw-bold text-uppercase'> Student Record
            <br> <span style='color:red;' id='mess'></span></p><table class='table table-success table-striped'><tr>
            <td class='table-secondary''>Current Status</td>
            <td class='table-secondary'>Remark</td>
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
                    <td class='table-primary' > <input type='text' class='form-control' placeholder='enter a remark...' id='remakmessage'/></td>
                    <td style='color:green;' class='table-primary'><button class='btn btn-danger' id='marknew'  data-value='0'>Mark Absent </button></td>
                    </tr>";
                } else {
                    $output .= "<tr style='color:white;font-weight:bold;'>
                <td style='color:red;' class='table-primary'>Absent</td>
                <td class='table-primary'> <input type='text' class='form-control' placeholder='enter a remark...' id='remakmessage'/></td>
                <td style='color:green;' class='table-primary'><button class='btn btn-success' id='marknew' data-value='1'>Mark Present </button></td>
                </tr>";
                }
            } else {
                $output .= "<div class-'m-3'><p class='fw-bold text-uppercase'> Student Record
                <br> <span style='color:red;' id='mess'></span></p><table class='table table-success table-striped'><tr>
                <td class='table-secondary''>Updated Mark</td>
                <td class='table-secondary''>Updated BY</td>
                <td class='table-secondary'>Remark</td>
                <td class='table-secondary'>Update Time</td>
                <td class='table-secondary'>Attendance Date</td>
                </tr>";
                foreach ($result as $record) {
                    $marked = $record['action'];
                    $marked2 = $record['updatedby'];
                    if ($marked2 == 1) {
                        $marked2 = "Teacher";
                    } else if ($marked2 == 0) {
                        $marked2 = "Coordinator";
                    }
                    if ($marked == 1) {
                        $marked = "Present";
                    } else {
                        $marked = "Absent";
                    }

                    $output .= "<tr style='color:white;font-weight:bold;'>
                    <td style='color:green;' class='table-primary'>{$marked}</td>
                    <td style='color:red;' class='table-primary'>{$marked2}</td>
                    <td style='color:white;' class='table-primary' >{$record["message"]}</td>
                    <td style='color:white;' class='table-primary' >{$record["time"]}</td>
                    <td style='color:green;' class='table-primary'>{$record["updatedate"]}</td>
                    </tr>";
                }
            }

            echo $output;
        }
    }
}








if (isset($_POST['connection']) && isset($_POST['getsemesterid'])) {
    $run =  new loadupdaterecord($_POST['getsemesterid'], $_POST['getsubjectid'], $_POST['getstudentid'], $_POST['getvalue']);
    $run->closeConnection();
} else {
    header("Location:../../../teacherlogin.html");
}