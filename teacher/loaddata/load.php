<?php
require_once("../../coordinator/inner/db_connection.php");
class loadteachersubject extends db_connection
{

    function __construct($getteacherid, $getsemesterid)
    {
        parent::__construct();
        require_once('../checkinfo/checksemesterid.php');
        require_once('../checkinfo/checkteacherid.php');
        if ($checkcountsemester > 0 && $checkcountteacher > 0) {
            $output = "";
            $output .= "<div class-'m-3'><p class='fw-bold text-uppercase'> Subject  assigned to this Semester</p><table class='table table-success table-striped'><tr>
        <td class='table-secondary'>S.No</td>
        <td class='table-secondary''>Subject Name</td>
        <td class='table-secondary''>Subject Code</td>
        <td class='table-secondary'>Batch Year</td>
        <td class='table-secondary'>Semester No</td>
        <td class='table-secondary'>Action</td>
    </tr>";
            $sql1 = $this->conn->prepare("Select * FROM `semester` INNER join `assignedsubject` on semester.semesterid = assignedsubject.semesterid INNER join subject on assignedsubject.subjectid = subject.subjectid INNER join batch on batch.batchid = semester.batchid WHERE assignedsubject.teacherid = ? && assignedsubject.semesterid = ?");
            $sql1->bindParam(1, $getteacherid);
            $sql1->bindParam(2, $getsemesterid);
            $sql1->execute();
            $resulttable = $sql1->fetchAll(PDO::FETCH_ASSOC);
            $Sno = 1;
            foreach ($resulttable as $rows) {
                if ($rows['semesterstatus'] == 1) {
                    $totalstudent = $this->conn->prepare("SELECT * FROM `student` WHERE `batchid` = ?");
                    $totalstudent->bindParam(1, $rows["batchid"]);
                    $totalstudent->execute();
                    $countstudent = $totalstudent->rowCount();

                    $output .= "<tr style='color:white;font-weight:bold;'>
        <td style='color:green;' class='table-primary'>{$Sno}</td>
        <td style='color:green;' class='table-primary'>{$rows["subjectname"]}</td>
        <td style='color:green;' class='table-primary'>{$rows["subjectcode"]}</td>
        <td style='color:green;' class='table-primary'>{$rows["batchyear"]}</td>
        <td style='color:green;' class='table-primary'>{$rows["semesterno"]}</td>";

                    if ($countstudent > 0) {
                        $output .= " <td style='color:green;' class='table-primary'><a class='btn btn-danger' href='attendance?semesterid={$rows['semesterid']}&teacherid={$getteacherid}&subjectname={$rows['subjectname']}&subjectid={$rows['subjectid']}'>Mark Attendance</a></td>
        
</tr>";
                    } else {
                        $output .= " <td style='color:green;' class='table-primary'><a class='btn btn-danger'  style='pointer-events: none' href='attendance?semesterid={$rows['semesterid']}&teacherid={$getteacherid}&subjectid={$rows['subjectid']}'>Mark Attendance</a></td>
        
                        </tr>";
                    }


                    $Sno++;
                } else {
                }
            }



            $output .= "</table></div>";
            echo $output;
        } else {
        }
    }
}



if (isset($_POST['connection']) && isset($_POST['get_Teacherid'])) {
    $run =  new loadteachersubject($_POST['get_Teacherid'], $_POST['get_Semesterid']);
    $run->closeConnection();
} else {
    header("Location:../../../teacherlogin.html");
}