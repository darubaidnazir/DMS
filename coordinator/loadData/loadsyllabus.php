<?php
session_start();
require_once("../../coordinator/inner/db_connection.php");
class loadsyllabus extends db_connection
{

    function  __construct($getsubjectid, $getpageno, $coordinatorid)

    {
        parent::__construct();
        $limitpage = 1;
        $page = $getpageno;
        $offset = ($page - 1) * $limitpage;
        if ($offset < 0) {
            $offset = 0;
        }
        $getname = $this->conn->prepare("SELECT * FROM `subject` WHERE `subjectid` = ?");
        $getname->bindParam(1, $getsubjectid);
        $getname->execute();
        foreach ($getname->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $subjectname = $row['subjectname'];
            $subjectname .= " - ";
            $subjectname .= $row['subjectcode'];
            break;
        }
        $output = "<h1 style='text-align: center; color: red;'> {$subjectname}</h1>
        

        <h4 style='color:green'>Detailed Syllabus</h4>";
        $getsyllabus = $this->conn->prepare("SELECT * FROM `syllabus` WHERE `subjectid` = ? ");
        $getsyllabus->bindParam(1, $getsubjectid);
        $getsyllabus->execute();
        $total_records = $getsyllabus->rowCount();
        $totalpage = ceil($total_records / $limitpage);
        $getsyllabus = $this->conn->prepare("SELECT * FROM `syllabus` WHERE `subjectid` = ?  LIMIT {$offset} ,{$limitpage}");
        $getsyllabus->bindParam(1, $getsubjectid);
        $getsyllabus->execute();
        if ($getsyllabus->rowCount() > 0) {
            foreach ($getsyllabus->fetchAll(PDO::FETCH_ASSOC) as $row2) {
                $output .= "<p>{$row2['syllabusdetails']}</p>";
                $getbatch = $this->conn->prepare("SELECT * FROM `assignedsyllabus` INNER JOIN batch ON assignedsyllabus.batchid = batch.batchid WHERE assignedsyllabus.syllabusid = ?");
                $getbatch->bindParam(1, $row2['syllabusid']);
                $getbatch->execute();
                $output .= "<h3 style='color:green'>Asigned syllabus  to batch year</h3>
                <p>";
                foreach ($getbatch->fetchAll(PDO::FETCH_ASSOC) as $batchname) {
                    $output .= "<button class='btn btn-dark'>{$batchname['batchyear']}</button>";
                    $output .= "   ";
                }

                $output .= " </p>";
                $output .= "
                <p style='text-align:center;margin:10px'>
               <h2 style='color:green'>Assign syllabus to a batch</h2>
                <label for='select_a_batch_for_syllabus'>Select a Batch</label>
                <select class='form-control' id='select_a_batch_for_syllabus' name='select_a_batch_for_syllabus'>";

                $getbranch = $this->conn->prepare("SELECT * FROM `batch` INNER JOIN branch ON batch.branchid = branch.branchid WHERE branch.coordinatorid = ? && batch.batchstatus != 0");
                $getbranch->bindParam(1, $coordinatorid);
                $getbranch->execute();
                $total_r = $getbranch->rowCount();
                if ($total_r > 0) {
                    foreach ($getbranch->fetchAll(PDO::FETCH_ASSOC) as $branch) {
                        $branchway = $branch['branchname'];
                        $branchway .= " - ";
                        $branchway .= $branch['batchyear'];

                        $output .= "<option value='{$branch['batchid']}'>{$branchway}</option>";
                    }
                } else {
                    $output .= "<option selected value='0'>Select a Batch</option>";
                }
                $output .= "    </select>
                <input type='hidden' name='syllabus_id' id='syllabus_id' value='{$row2['syllabusid']}' >
                <button style='margin: 0 auto;
                display: block;' class='btn btn-danger' id='select_a_batch_for_syllabus_button'>Assign</button>
                </p>";
            }
            $output .= ' <div id="paginationsyllabus" style="text-align:center;">';
            for ($i = 1; $i <= $totalpage; $i++) {
                if ($i == $getpageno) {
                    $output .= "<a class='btn btn-primary' data-subjectid='{$getsubjectid}' id='{$i}' href=''>{$i}</a> ";
                } else {
                    $output .= "<a class='btn btn-secondary' data-subjectid='{$getsubjectid}' style='margin:3px' id='{$i}' href=''>{$i}</a>";
                }
            }
            $output .= "</div>";
        } else {

            $output .= "<h2>No Syllabus added!</h2>";
        }
        echo $output;
    }
}



if (isset($_POST['connection']) && isset($_POST['get_subjectid'])) {
    $coordinatorid = $_SESSION['userid'];
    $run =  new loadsyllabus($_POST['get_subjectid'], $_POST['get_pageno'], $coordinatorid);
    $run->closeConnection();
} else {
    session_destroy();
    header("Location:../../../coordinatorlogin_signup.html");
}
