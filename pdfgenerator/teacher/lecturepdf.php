<?php
session_start();
if ($_SESSION['active'] != true) {
    header('Location:../../../../teacher/teacherlogin.html');
    die();
}
require_once("../fpdf.php");
require_once("../../coordinator/dbcon.php");

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
        $this->Cell(276, 10, 'LECTURE STATUS', 0, 0, 'C');
        $this->Ln(15);
    }
    function headerTable($title, $coursecode, $year, $semno)
    {
        $this->SetFont('Times', '', 10);
        $this->Cell(40, 5, 'Batch/Semester: ' . $year . '/' . $semno, 0, 0, 'C');
        $this->SetFont('Times', '', 10);
        $this->Ln();
        $this->Cell(28, 5,  'Date: 10-12-2022', 0, 0, 'C');

        $this->Cell(180, 5, 'Title: ' . $title, 0, 0, 'C');
        $this->Cell(10, 5,  'Course Code: ' . $coursecode, 0, 0, 'C');
        $this->Ln(5);
        $this->SetFont('Times', 'B', 12);
        $this->Cell(70, 10, 'Lecture Topic', 1, 0, 'C');
        $this->Cell(30, 10, ' Total Hour ', 1, 0, 'C');
        $this->Cell(40, 10, ' Start Time', 1, 0, 'C');
        $this->Cell(30, 10, ' End Time', 1, 0, 'C');
        $this->Cell(30, 10, ' Date', 1, 0, 'C');
        $this->Cell(40, 10, 'Total Student', 1, 0, 'C');
        $this->Cell(20, 10, 'Present', 1, 0, 'C');
        $this->Cell(20, 10, 'Absent', 1, 0, 'C');
        $this->Ln();
    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Times', '', 10);
        $this->Cell(500, 10, 'Coordinator', 0, 0, 'C');
        $this->Ln(2);
        $this->SetFont('Arial', 'I', 8);

        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }


    function viewTable($lecturetopic, $lecturehour, $timeslotstart, $timeslotend, $lecturedate, $totalstudent, $present, $countabsent)
    {
        $this->SetFont('Times', 'B', 12);

        $this->Cell(70, 10, $lecturetopic, 1, 0, 'C');
        $this->Cell(30, 10, $lecturehour, 1, 0, 'C');
        $this->Cell(40, 10, $timeslotstart, 1, 0, 'C');
        $this->Cell(30, 10, $timeslotend, 1, 0, 'C');
        $this->Cell(30, 10, $lecturedate, 1, 0, 'C');
        $this->Cell(40, 10, $totalstudent, 1, 0, 'C');
        $this->Cell(20, 10, $present, 1, 0, 'C');
        $this->Cell(20, 10, $countabsent, 1, 0, 'C');
        $this->Ln();
    }
}



if (isset($_POST['subjectlecturepdf']) && $_POST['subjectlecture'] != 0) {
    $result = explode(',', $_POST['subjectlecture']);

    $getsubjectid = $result[0];
    $getsemeterid = $result[1];
    $title = $result[2];
    $coursecode = $result[3];
    $sql = $conn->prepare("SELECT * FROM `lectureplan` WHERE `subjectid` = ? && `semesterid` = ? ORDER BY `lecturedate` ASC");
    $sql->bindParam(1, $getsubjectid);
    $sql->bindParam(2, $getsemeterid);
    $sql->execute();
    $getbatch = $conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ?");
    $getbatch->bindParam(1, $getsemeterid);
    $getbatch->execute();
    $getresult = $getbatch->fetchAll(PDO::FETCH_ASSOC);
    foreach ($getresult as $getrow) {
        $batchid = $getrow['batchid'];
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
    $getbatch = $conn->prepare("SELECT * FROM `student` WHERE `batchid` = ?");
    $getbatch->bindParam(1, $batchid);
    $getbatch->execute();
    $totalstudent = $getbatch->rowCount();

    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L', 'A4', 0);
    $pdf->headerTable($title, $coursecode, $year, $semno);
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    if ($sql->rowCount() > 0) {

        $Sno = 1;
        foreach ($result as $row) {
            $date = $row["lecturedate"];
            $getbatch = $conn->prepare("SELECT * FROM `studentabsent` WHERE `subjectid` = ? && `semesterid` = ? && `markdate`
= ? ");
            $getbatch->bindParam(1, $getsubjectid);
            $getbatch->bindParam(2, $getsemeterid);
            $getbatch->bindParam(3, $date);
            $getbatch->execute();
            $countabsent = $getbatch->rowCount();
            $present = $totalstudent - $countabsent;

            $pdf->viewTable($row["lecturetopic"], $row["lecturehour"], $row["timeslotstart"], $row["timeslotend"], $row["lecturedate"], $totalstudent, $present, $countabsent);
        }
    }

    $pdf->Output();
} else {
    header("Location:../../teacher/teacherlogin.html");
}