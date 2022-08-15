<?php
require_once("../../coordinator/inner/db_connection.php");
class loadsemestersubject extends db_connection
{

    function __construct($getsemesterid, $getcoodinatorid)
    {
        parent::__construct();
        $output = "";


        $output .= "  <p class='fw-bold text-uppercase'> Select a Subject to be assigned to this semester</p>
        
        <div class='m-5'>
        <span id='messagesubjects' style='color:red;'></span>
        <select id='assignedselect' class='form-select' aria-label='Default select example'><option selected value='0'>Open this to Select a Subject</option>";

        $sql = $this->conn->prepare("SELECT * FROM `subject` WHERE `coordinatorid` = ?");
        $sql->bindParam(1, $getcoodinatorid);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $addstring = $row['subjectname'];
            $addstring .= "-";
            $addstring .= $row['subjectcode'];
            $output .= " 
            
            <option value='{$row["subjectid"]}'>{$addstring}</option>";
        }
        $output .= "</select>   
        <select id='assignedselectteacher' class='form-select' aria-label='Default select example'><option selected value='0'>Open this to Select a Teacher</option>";
        $status = "disabled";
        $sql0 =  $this->conn->prepare("SELECT * FROM `teacher` WHERE `coordinatorid` = ? &&  `teacherstatus` != ?");
        $sql0->bindParam(1, $getcoodinatorid);
        $sql0->bindParam(2, $status);
        $sql0->execute();
        $result0 = $sql0->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result0 as $row0) {
            $output .= "<option value='{$row0['teacherid']}'>{$row0['teacherusername']}</option>";
        }


        $output .= "</select><div class='d-grid gap-2 d-md-flex justify-content-md-end'>
        <a class='btn btn-danger'  id='assignsubjecthere' data-id='{$getsemesterid}' href='#'> Assign</a>
    </div>
";




        $output .= "<div class-'m-3'><p class='fw-bold text-uppercase'> Subject  assigned to this semester</p><table class='table table-success table-striped'><tr>
        <td class='table-secondary'>S.No</td>
        <td class='table-secondary''>Subject Name</td>
        <td class='table-secondary''>Subject Code</td>
        <td class='table-secondary''>Teacher Assigned</td>
        <td class='table-secondary'>Action</td>
    </tr>";
        $sql1 = $this->conn->prepare("SELECT * FROM `subject` INNER JOIN `assignedsubject` ON subject.subjectid = assignedsubject.subjectid INNER JOIN `teacher` ON teacher.teacherid = assignedsubject.teacherid WHERE assignedsubject.semesterid = ?");
        $sql1->bindParam(1, $getsemesterid);
        $sql1->execute();
        $resulttable = $sql1->fetchAll(PDO::FETCH_ASSOC);
        $Sno = 1;
        foreach ($resulttable as $rows) {

            $output .= "<tr style='color:white;font-weight:bold;'>
        <td style='color:green;' class='table-primary'>{$Sno}</td>
        <td style='color:green;' class='table-primary'>{$rows["subjectname"]}</td>
        <td style='color:green;' class='table-primary'>{$rows["subjectcode"]}</td>
        <td style='color:green;' class='table-primary'>{$rows["teacherusername"]}</td>
        <td style='color:green;' class='table-primary'>
            <button type='button' class='btn btn-danger btn-sm'>Remove</button>
        </td>
    </tr>";
            $Sno++;
        }



        $output .= "
</table>
</div>";

        echo $output;
    }
}



if (isset($_POST['connection']) && isset($_POST['get_Semesterid'])) {
    $run =  new loadsemestersubject($_POST['get_Semesterid'], $_POST["get_Coordinatorid"]);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}