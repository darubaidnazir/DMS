<?php
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
        $this->Cell(276, 10, 'ATTENDANCE STATUS (Till 09-11-2022)', 0, 0, 'C');
        $this->Ln(15);
        $this->SetFont('Times', '', 10);
        $this->Cell(40, 5, 'Batch/Semester: 2018/', 0, 0, 'C');
        $this->SetFont('Times', '', 10);
        $this->Cell(200, 5, 'Minimum Attendance Required = 75%', 0, 0, 'C');
        $this->Cell(23, 5, 'Session:' . date("Y"), 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times', '', 10);
        $date = date("d-m-Y");
        $this->Cell(28, 5, 'Date:' . $date, 0, 0, 'C');
        $this->Cell(203, 5, 'Title: Compiler Design', 0, 0, 'C');
        $this->Cell(25, 5, 'Course Code: CSE-1275L', 0, 0, 'C');


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
        $this->SetY(-15);
        $this->SetFont('Times', '', 10);
        $this->Cell(500, 10, 'Coordinator', 0, 0, 'C');
        $this->Ln(2);
        $this->SetFont('Arial', 'I', 8);

        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function headerTable()
    {
    }
    function viewTable($row, $totalclass, $presentcount, $absentcount, $percentage)
    {
        if ($percentage < 75) {
            $this->SetFont('Times', 'B', 12);
            $this->SetTextColor(220, 50, 50);
            $this->Cell(70, 10, $row["studentemail"], 1, 0, 'C');
            $this->Cell(70, 10, $row["studentname"], 1, 0, 'C');
            $this->Cell(30, 10, $totalclass, 1, 0, 'C');
            $this->Cell(30, 10, $presentcount, 1, 0, 'C');
            $this->Cell(30, 10, $absentcount, 1, 0, 'C');
            $this->Cell(40, 10, $percentage . "%", 1, 0, 'C');
            $this->Ln();
        } else {
            $this->SetFont('Times', 'B', 12);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(70, 10, $row["studentemail"], 1, 0, 'C');
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
$getsemeterid = "901054";
$getsubjectid = "901054";
$getbatchid = $conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ?");
$getbatchid->bindParam(1, $getsemeterid);
$getbatchid->execute();
$fetch = $getbatchid->fetchAll(PDO::FETCH_ASSOC);
$batchid = "";
foreach ($fetch as $some) {
    $batchid = $some["batchid"];

    break;
}
$getallstudent = $conn->prepare("SELECT * FROM `student` WHERE `batchid` = ?");
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
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);

$pdf->headerTable();
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