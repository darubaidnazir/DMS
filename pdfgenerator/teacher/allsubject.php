<?php
session_start();
if (!isset($_SESSION['active']) || $_SESSION['active'] != true) {
    header("Location:../../../DMS/coordinator/coordinatorlogin_signup.html");
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
    function headerTable($year, $semno)
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

        $this->Ln(5);
        $this->SetFont('Times', 'B', 12);
        $this->Cell(40, 10, 'Enrollment NO', 1, 0, 'C');
    }
    function createHeader($subjectname)
    {

        $this->Cell(30, 10, $subjectname, 1, 0, 'C');
    }
    function createline()
    {
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


    function viewTable($studentname)
    {
        $this->Cell(40, 10, $studentname, 1, 0, 'C');
    }
    function viewSubject($percentage)
    {
        $this->Cell(30, 10, $percentage, 1, 0, 'C');
    }
}













require("../../coordinator/dbcon.php");
if (isset($_POST['subjectlecturepdf']) &&  $_POST['selectsemesterno'] != 0 && $_POST['select_batch_id'] != 0) {
    $semesterid = $_POST['selectsemesterno'];
    $batchid = $_POST['select_batch_id'];
    $subjectLevel = $_POST['subjectlevel'];
    if ($subjectLevel == 'T' || $subjectLevel == 'L') {

        $pdf = new myPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('L', 'A4', 0);
        $pdf->headerTable("2019", "4");
        $sql2 = $conn->prepare("SELECT * FROM `subject` INNER JOIN `assignedsubject` ON subject.subjectid = assignedsubject.subjectid INNER JOIN `teacher` ON teacher.teacherid = assignedsubject.teacherid WHERE assignedsubject.semesterid = ? && assignedsubject.assignedstatus != 'disabled' && subject.subjectlevel= ?");
        $sql2->bindParam(1, $semesterid);
        $sql2->bindParam(2, $subjectLevel);
        $sql2->execute();
        $subjects = $sql2->fetchAll();
        foreach ($subjects as $subjects_row) {
            $pdf->createHeader($subjects_row['subjectname']);
        }
        $pdf->createline();
        if ($subjectLevel == "T") {
            $sql1 = $conn->prepare("SELECT * FROM student where batchid = ?");
            $sql1->bindParam(1, $batchid);
            $sql1->execute();
            $student_rollno = $sql1->fetchAll();
            foreach ($student_rollno as $rollno) {
                $pdf->viewTable($rollno['studentemail']);
                foreach ($subjects as $subjects_row) {


                    $totalclasssql = $conn->prepare("SELECT * FROM `lectureplan` WHERE  `subjectid` = ? && `semesterid` = ?");
                    $totalclasssql->bindParam(1, $subjects_row['subjectid']);
                    $totalclasssql->bindParam(2, $semesterid);
                    $totalclasssql->execute();
                    $fetchclass = $totalclasssql->fetchAll(PDO::FETCH_ASSOC);
                    $totalclass = 0;



                    foreach ($fetchclass as $countclass) {

                        $totalclass = $totalclass + $countclass['lecturehour'];
                    }


                    $findabsent = $conn->prepare("SELECT * FROM `studentabsent` WHERE `studentid`= ? && `subjectid` = ?  && `semesterid` = ?");
                    $findabsent->bindParam(1,  $rollno['studentid']);
                    $findabsent->bindParam(2,  $subjects_row['subjectid']);
                    $findabsent->bindParam(3, $semesterid);
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
                    $pdf->viewSubject($percentage);
                }
                $pdf->createline();
            }
        } else {
            $group = array("G1", "G2");
            $groups = "BOTH";
            for ($i = 0; $i <= 1; $i++) {
                $sql1 = $conn->prepare("SELECT * FROM student where batchid = ? && group_id = ?");
                $sql1->bindParam(1, $batchid);
                $sql1->bindParam(2, $group[$i]);
                $sql1->execute();
                $student_rollno = $sql1->fetchAll();
                foreach ($student_rollno as $rollno) {
                    $pdf->viewTable($rollno['studentemail']);
                    foreach ($subjects as $subjects_row) {


                        $totalclasssql = $conn->prepare("SELECT * FROM `lectureplan` WHERE  `subjectid` = ? && `semesterid` = ? && groups = ? UNION SELECT * FROM `lectureplan` WHERE  `subjectid` = ? && `semesterid` = ? && groups = ?");
                        $totalclasssql->bindParam(1, $subjects_row['subjectid']);
                        $totalclasssql->bindParam(2, $semesterid);
                        $totalclasssql->bindParam(3, $group[$i]);
                        $totalclasssql->bindParam(4, $subjects_row['subjectid']);
                        $totalclasssql->bindParam(5, $semesterid);
                        $totalclasssql->bindParam(6, $groups);
                        $totalclasssql->execute();
                        $fetchclass = $totalclasssql->fetchAll(PDO::FETCH_ASSOC);
                        $totalclass = 0;



                        foreach ($fetchclass as $countclass) {

                            $totalclass = $totalclass + $countclass['lecturehour'];
                        }


                        $findabsent = $conn->prepare("SELECT * FROM `studentabsent` WHERE `studentid`= ? && `subjectid` = ?  && `semesterid` = ?");
                        $findabsent->bindParam(1,  $rollno['studentid']);
                        $findabsent->bindParam(2,  $subjects_row['subjectid']);
                        $findabsent->bindParam(3, $semesterid);
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
                        $pdf->viewSubject($percentage);
                    }
                    $pdf->createline();
                }
            }
        }
        $pdf->Output();
    } else {
        header("Location:../../coordinator/dashboard.php");
        $conn = null;
        die();
    }
} else {
    header("Location:../../coordinator/dashboard.php");
    $conn = null;
    die();
}

$conn = null;