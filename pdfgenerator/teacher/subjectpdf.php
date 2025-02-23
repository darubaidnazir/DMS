<?php
session_start();
if ($_SESSION['active'] != true) {
    header('Location:../../teacher/teacherlogin.html');
    die();
}

require_once("../fpdf.php");
class myPDF extends FPDF
{

    function header()

    {
        $this->Image('../logo.png', 15, 10);
        $this->SetFont("Arial", 'B', 14);
        $this->Cell(276, 5, 'Department of Computer Science and Engineering', 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times', '', 12);
        $this->Cell(276, 10, 'North Campus,University of Kashmir,Delina,Baramulla', 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times', '', 14);
        $this->Cell(276, 10, 'ATTENDANCE STATUS ', 0, 0, 'C');
        $this->Ln(15);
    }
    function headerTable($title, $coursecode, $year, $semno)
    {
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Times', '', 10);
        $this->Cell(40, 5, 'Batch/Semester: ' . $year . '/' . $semno, 0, 0, 'C');
        $this->SetFont('Times', '', 10);
        $this->Cell(200, 5, 'Minimum Attendance Required = 75%', 0, 0, 'C');
        $this->Cell(23, 5, 'Session:' . date("Y"), 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times', '', 10);
        $date = date("d-m-Y");
        $this->Cell(32, 5, 'Date:' . $date, 0, 0, 'C');
        $this->Cell(180, 5, 'Title: ' . $title, 0, 0, 'C');
        $this->Cell(60, 5, 'Course Code: ' . $coursecode, 0, 0, 'C');
        $this->Ln(5);
        $this->SetFont('Times', 'B', 12);

        $this->Cell(70, 10, 'Enrollment NO', 1, 0, 'C');
        $this->Cell(70, 10, 'Student Name ', 1, 0, 'C');
        $this->Cell(30, 10, 'Total Class', 1, 0, 'C');
        $this->Cell(30, 10, 'Present', 1, 0, 'C');
        $this->Cell(30, 10, 'Absent', 1, 0, 'C');
        $this->Cell(40, 10, 'Percentage', 1, 0, 'C');
        $this->Ln();
    }

    function Footer()
    {
        $this->SetTextColor(0, 0, 0);
        $this->SetY(-15);
        $this->SetFont('Times', '', 10);
        $this->Cell(500, 10, 'Coordinator', 0, 0, 'C');
        $this->Ln(2);
        $this->SetFont('Arial', 'I', 8);

        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }


    function viewTable($row, $totalclass, $presentcount, $absentcount, $percentage)
    {
        if ($percentage < 75) {
            $this->SetFont('Times', 'B', 12);

            $this->Cell(70, 10, $row["studentrollno"], 1, 0, 'C');
            $this->Cell(70, 10, $row["studentname"], 1, 0, 'C');
            $this->Cell(30, 10, $totalclass, 1, 0, 'C');
            $this->Cell(30, 10, $presentcount, 1, 0, 'C');
            $this->Cell(30, 10, $absentcount, 1, 0, 'C');
            $this->Cell(40, 10, $percentage . "%", 1, 0, 'C');
            $this->Ln();
        } else {
            $this->SetFont('Times', 'B', 12);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(70, 10, $row["studentrollno"], 1, 0, 'C');
            $this->Cell(70, 10, $row["studentname"], 1, 0, 'C');
            $this->Cell(30, 10, $totalclass, 1, 0, 'C');
            $this->Cell(30, 10, $presentcount, 1, 0, 'C');
            $this->Cell(30, 10, $absentcount, 1, 0, 'C');
            $this->Cell(40, 10, $percentage . "%", 1, 0, 'C');
            $this->Ln();
        }
    }
}


require_once("../../coordinator/dbcon.php");
if (isset($_POST['pdf_button']) && $_POST['pdf_generator_free'] != 0) {

    $result = explode(',', $_POST['pdf_generator_free']);

    $getsemeterid = $result[0];
    $getsubjectid = $result[1];
    $title = $result[2];
    $coursecode = $result[3];
    $getbatchid = $conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ?");
    $getbatchid->bindParam(1, $getsemeterid);
    $getbatchid->execute();
    $fetch = $getbatchid->fetchAll(PDO::FETCH_ASSOC);
    $batchid = "";
    $currentsemester = "";
    foreach ($fetch as $some) {
        $batchid = $some["batchid"];

        break;
    }
    $getbatchid = $conn->prepare("SELECT * FROM `subject` WHERE `subjectid` = ?");
    $getbatchid->bindParam(1, $getsubjectid);
    $getbatchid->execute();
    $fetch = $getbatchid->fetchAll(PDO::FETCH_ASSOC);

    foreach ($fetch as $some) {
        $subjectlevel = $some["subjectlevel"];
        break;
    }
    $sometry = $conn->prepare("SELECT * FROM `batch` where `batchid` = ?");
    $sometry->bindParam(1, $batchid);
    $sometry->execute();
    $someresult = $sometry->fetchAll(PDO::FETCH_ASSOC);
    foreach ($someresult as $try) {
        $year = $try['batchyear'];
        $semno = $try['currentsemester'];
        break;
    }
    if ($semno == 1) {
        $semno .= "-IST";
    } else if ($semno == 2) {
        $semno .= "nd";
    } else if ($semno == 3) {
        $semno .= "rd";
    } else {
        $semno .= "th";
    }
    if ($subjectlevel == "L") {
        $group = array("G1", "G2");
        $groups = "BOTH";


        $pdf = new myPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('L', 'A4', 0);
        $pdf->headerTable($title, $coursecode, $year, $semno);
        for ($i = 0; $i <= 1; $i++) {
            $getallstudent = $conn->prepare("SELECT * FROM `student` WHERE `batchid` = ? && group_id = ?");
            $getallstudent->bindParam(1, $batchid);
            $getallstudent->bindParam(2, $group[$i]);
            $getallstudent->execute();

            $fetchallstudent = $getallstudent->fetchAll(PDO::FETCH_ASSOC);
            $totalclasssql = $conn->prepare("SELECT * FROM `lectureplan` WHERE  `subjectid` = ? && `semesterid` = ? && groups = ? UNION SELECT * FROM `lectureplan` WHERE  `subjectid` = ? && `semesterid` = ? && groups = ?");
            $totalclasssql->bindParam(1, $getsubjectid);
            $totalclasssql->bindParam(2, $getsemeterid);
            $totalclasssql->bindParam(3, $group[$i]);
            $totalclasssql->bindParam(4, $getsubjectid);
            $totalclasssql->bindParam(5, $getsemeterid);
            $totalclasssql->bindParam(6, $groups);
            $totalclasssql->execute();
            $fetchclass = $totalclasssql->fetchAll(PDO::FETCH_ASSOC);
            $totalclass = 0;

            foreach ($fetchclass as $countclass) {

                $totalclass = $totalclass + $countclass['lecturehour'];
            }


            foreach ($fetchallstudent as $row) {
                $findabsent = $conn->prepare("SELECT * FROM `studentabsent` WHERE `studentid`= ? && `subjectid` = ?  && `semesterid` = ?");
                $findabsent->bindParam(1, $row['studentid']);
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
                $pdf->viewTable($row, $totalclass, $presentcount, $absentcount, $percentage);
            }
        }
        $pdf->Output();
        $conn = null;
    } else {


        $getallstudent = $conn->prepare("SELECT * FROM `student`  WHERE `batchid` = ? ORDER BY `studentrollno` ASC");
        $getallstudent->bindParam(1, $batchid);
        $getallstudent->execute();
        if ($getallstudent->rowCount() == 0) {
            $output = "";
        } else {

            $output = "";
        }
        $fetchallstudent = $getallstudent->fetchAll(PDO::FETCH_ASSOC);
        $totalclasssql = $conn->prepare("SELECT * FROM `lectureplan` WHERE  `subjectid` = ? && `semesterid` = ?");
        $totalclasssql->bindParam(1, $getsubjectid);
        $totalclasssql->bindParam(2, $getsemeterid);
        $totalclasssql->execute();
        $fetchclass = $totalclasssql->fetchAll(PDO::FETCH_ASSOC);
        $totalclass = 0;



        foreach ($fetchclass as $countclass) {

            $totalclass = $totalclass + $countclass['lecturehour'];
        }


        $pdf = new myPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('L', 'A4', 0);
        $pdf->headerTable($title, $coursecode, $year, $semno);

        foreach ($fetchallstudent as $row) {
            $findabsent = $conn->prepare("SELECT * FROM `studentabsent` WHERE `studentid`= ? && `subjectid` = ?  && `semesterid` = ?");
            $findabsent->bindParam(1, $row['studentid']);
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
            $pdf->viewTable($row, $totalclass, $presentcount, $absentcount, $percentage);
        }

        $pdf->Output();
        $conn = null;
    }
} else {
    header("location:../../teacher/teacherlogin.html");
    die();
    $conn = null;
}
