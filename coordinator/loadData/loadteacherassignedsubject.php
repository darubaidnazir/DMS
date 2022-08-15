<?php
require_once("../../coordinator/inner/db_connection.php");
class loadteachersubject extends db_connection
{

    function __construct($getteacherid)
    {
        parent::__construct();
        $output = "";
        $output .= "<div class-'m-3'><p class='fw-bold text-uppercase'> Subject  assigned to this teacher</p><table class='table table-success table-striped'><tr>
        <td class='table-secondary'>S.No</td>
        <td class='table-secondary''>Subject Name</td>
        <td class='table-secondary''>Subject Code</td>
        <td class='table-secondary'>Batch Year</td>
        <td class='table-secondary'>Semester No</td>
    </tr>";
        $sql1 = $this->conn->prepare("Select * FROM `semester` INNER join `assignedsubject` on semester.semesterid = assignedsubject.semesterid INNER join subject on assignedsubject.subjectid = subject.subjectid INNER join batch on batch.batchid = semester.batchid WHERE assignedsubject.teacherid =  ?");
        $sql1->bindParam(1, $getteacherid);
        $sql1->execute();
        $resulttable = $sql1->fetchAll(PDO::FETCH_ASSOC);
        $Sno = 1;
        foreach ($resulttable as $rows) {
            if ($rows['semesterstatus'] == 1) {

                $output .= "<tr style='color:white;font-weight:bold;'>
        <td style='color:green;' class='table-primary'>{$Sno}</td>
        <td style='color:green;' class='table-primary'>{$rows["subjectname"]}</td>
        <td style='color:green;' class='table-primary'>{$rows["subjectcode"]}</td>
        <td style='color:green;' class='table-primary'>{$rows["batchyear"]}</td>
        <td style='color:green;' class='table-primary'>{$rows["semesterno"]}</td>
        
    </tr>";
                $Sno++;
            } else {
            }
        }



        $output .= "</table></div>";
        echo $output;
    }
}



if (isset($_POST['connection']) && isset($_POST['get_Teacherid'])) {
    $run =  new loadteachersubject($_POST['get_Teacherid']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}