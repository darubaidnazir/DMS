<?php
session_start();
require_once("../../coordinator/inner/db_connection.php");

class loadlecture extends db_connection

{


    function __construct($getsubjectid, $getsemeterid, $studentid)
    {
        parent::__construct();
        $output = " <main>
        <table>
            <thead>

                <tr>

                    <th>Total Class</th>
                    <th>Present Day's</th>
                    <th>Absent Day's</th>
                    <th>Percentage</th>
                    <th>Extra Attendance</th>
                    <th>Overall Attendance</th>
                </tr>
            </thead>";

        //------------------------------------------------------------------------------------------------------------------->
        $totalclasssql = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE  `subjectid` = ? && `semesterid` = ?");
        $totalclasssql->bindParam(1, $getsubjectid);
        $totalclasssql->bindParam(2, $getsemeterid);
        $totalclasssql->execute();
        $fetchclass = $totalclasssql->fetchAll(PDO::FETCH_ASSOC);
        $totalclass = 0;



        foreach ($fetchclass as $countclass) {

            $totalclass = $totalclass + $countclass['lecturehour'];
        }


        $findabsent = $this->conn->prepare("SELECT * FROM `studentabsent` WHERE `studentid`= ? && `subjectid` = ?  && `semesterid` = ?");
        $findabsent->bindParam(1, $studentid);
        $findabsent->bindParam(2, $getsubjectid);
        $findabsent->bindParam(3, $getsemeterid);
        $findabsent->execute();
        $fetchasbsentcount = $findabsent->fetchAll(PDO::FETCH_ASSOC);
        $absentcount = 0;
        foreach ($fetchasbsentcount  as $somecount) {
            $absentcount = $absentcount + $somecount['lecturehour'];
        }





        $presentcount = $totalclass - $absentcount;
        if ($totalclass == 0) {
            $percentage = 0;
        } else {
            $percentage = ceil($presentcount / $totalclass * 100);
        }
        $newsql = $this->conn->prepare("SELECT * FROM `extraattendance` WHERE studentid = ? and semesterid = ?");
        $newsql->bindParam(1, $studentid);
        $newsql->bindParam(2, $getsemeterid);
        $newsql->execute();
        $getpercentage = $newsql->fetchAll(PDO::FETCH_ASSOC);
        $Extrapercentage = 0;
        foreach ($getpercentage as $marks) {
            $Extrapercentage = $marks['percentage'];
            break;
        }
        $firstpercentage = $percentage;
        $percentage = $percentage +  (int) $Extrapercentage;
        if ($percentage > 100) {
            $percentage = 100;
        }
        $output .= "<tbody>
        <tr>
            <td data-title='Total Class'>{$totalclass}</td>
            <td data-title='Present'>{$presentcount}</td>
            <td data-title='Absent'>{$absentcount}</td>
            <td data-title='Percentage'>{$firstpercentage}%</td>
            <td data-title='Extra Percentage'>{$Extrapercentage}%</td>
            <td data-title=' Total Percentage'>{$percentage}%</td>
        </tr>
        <tr></tr>

    </tbody>
</table>
</main>

<main>
<table>

    <thead>

        <tr>
            <th>S.No</th>
            <th>Lecture Topic</th>
            <th>Lecture Hour</th>
            <th>Lecture Start time</th>
            <th>Lecture End time</th>
            <th>Lecture Date</th>
            <th>Total Student</th>
            <th>Present</th>
            <th>Absent</th>
            <th>Status</th>



        </tr>
    </thead>

    <tbody id='addlecturetable'>";

        //------------------------------------------------------------------------------------------------------------------->

        $sql = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE `subjectid` = ? && `semesterid` = ?");
        $sql->bindParam(1, $getsubjectid);
        $sql->bindParam(2, $getsemeterid);
        $sql->execute();
        $getbatch = $this->conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ?");
        $getbatch->bindParam(1, $getsemeterid);
        $getbatch->execute();
        $getresult = $getbatch->fetchAll(PDO::FETCH_ASSOC);
        foreach ($getresult as $getrow) {
            $batchid = $getrow['batchid'];
            break;
        }
        $getbatch = $this->conn->prepare("SELECT * FROM `student` WHERE `batchid` = ?");
        $getbatch->bindParam(1, $batchid);
        $getbatch->execute();
        $totalstudent = $getbatch->rowCount();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        if ($sql->rowCount() > 0) {

            $Sno = 1;
            foreach ($result  as $row) {
                $date = $row["lecturedate"];
                $getbatch = $this->conn->prepare("SELECT * FROM `studentabsent` WHERE `subjectid` = ? && `semesterid` = ?  && `markdate` = ? ");
                $getbatch->bindParam(1, $getsubjectid);
                $getbatch->bindParam(2, $getsemeterid);
                $getbatch->bindParam(3, $date);
                $getbatch->execute();
                $countabsent = $getbatch->rowCount();
                $present = $totalstudent - $countabsent;
                $getbatch1 = $this->conn->prepare("SELECT * FROM `studentabsent` WHERE `subjectid` = ? && `semesterid` = ?  && `markdate` = ? && `studentid` = ?");
                $getbatch1->bindParam(1, $getsubjectid);
                $getbatch1->bindParam(2, $getsemeterid);
                $getbatch1->bindParam(3, $date);
                $getbatch1->bindParam(4, $studentid);
                $getbatch1->execute();
                $countabsent1 = $getbatch1->rowCount();
                $Status = "";
                if ($countabsent1 == 0) {
                    $Status = "Present";
                    $StatusC = "success";
                } else if ($countabsent1 == 1) {
                    $Status = "Absent";
                    $StatusC = "danger";
                }

                $output .= " <tr>
            <td data-title='Sno'>{$Sno}
           </td>
           <td data-title='Lecture Topic'>{$row["lecturetopic"]}</td>
           <td data-title='Lecture Hour's'>{$row["lecturehour"]}</td>
           <td data-title='Lecture Start time'>{$row["timeslotstart"]}</td>
           <td data-title='Lecture End time'>{$row["timeslotend"]}</td>
           <td data-title='Lecture date'>{$row["lecturedate"]}</td><td data-title='Total Student'>{$totalstudent}</td><td data-title='Present'>{$present}</td><td data-title='Absent'>{$countabsent}</td>
           <td data-title='Status'><span class='btn btn-{$StatusC}' >{$Status}</span></td>
           </tr>";
                $Sno++;
            }
            $output .= "</tbody>

            </table>
        </main>";
        } else {

            $output .= "<tr><td>No Lecture Found</td></tr>";
        }

        echo $output;
    }
}























if (isset($_POST['connection']) && isset($_POST['getsubjectid'])) {
    $studentid = $_SESSION['studentid'];
    $run =  new loadlecture($_POST['getsubjectid'], $_POST['getsemesterid'], $studentid);
    $run->closeConnection();
} else {
    header("Location:../studentlogin.html");
    session_destroy();
}