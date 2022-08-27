<?php
require_once("../../coordinator/inner/db_connection.php");
class  loadrequest extends db_connection
{

    function __construct($getcoordinatorid)
    {
        parent::__construct();
        $output = "";
        $sql = $this->conn->prepare("SELECT * FROM `coordinator` INNER
        JOIN `teacher` on coordinator.coordinatiorid = teacher.coordinatorid INNER JOIN `assignedsubject` on teacher.teacherid = assignedsubject.teacherid INNER JOIN   subject on assignedsubject.subjectid = subject.subjectid  WHERE  coordinator.coordinatiorid = ? and assignedsubject.updatepermission != 0");
        $sql->bindParam(1, $getcoordinatorid);
        $sql->execute();
        $fetch = $sql->fetchAll(PDO::FETCH_ASSOC);
        $Sno = 1;
        foreach ($fetch as $row) {
            $checkgrant = $row['updatepermission'];

            $output .= "<tr style='color:white;font-weight:bold;'>
            <td style='color:green;' class='table-primary'>{$Sno}</td>
            <td style='color:green;' class='table-primary'>{$row['teacherusername']}</td>
            <td style='color:green;' class='table-primary'>{$row['subjectname']}</td> ";
            if ($checkgrant == 1) {
                $output   .= "  <td style='color:green;' class='table-primary'>
            <button type='button' class='btn btn-primary' disabled id='grantpermission' data-teacherid='{$row['teacherid']}' data-semesterid='{$row['semesterid']}' data-subjectid='{$row['subjectid']}'> Granted</button>
            </td>
            <td style='color:green;' class='table-primary'>
            <button type='button' class='btn btn-danger' id='rejectpermission' data-teacherid='{$row['teacherid']}' data-semesterid='{$row['semesterid']}' data-subjectid='{$row['subjectid']}'>Cancle</button>
            </td>

        </tr>";
            } else {
                $output   .= "  <td style='color:green;' class='table-primary'>
            <button type='button' class='btn btn-primary' id='grantpermission' data-teacherid='{$row['teacherid']}' data-semesterid='{$row['semesterid']}' data-subjectid='{$row['subjectid']}'> Grant</button>
            </td>
            <td style='color:green;' class='table-primary'>
            <button type='button' class='btn btn-danger' id='rejectpermission' data-teacherid='{$row['teacherid']}' data-semesterid='{$row['semesterid']}' data-subjectid='{$row['subjectid']}'>Cancle</button>
            </td>

        </tr>";
            }

            $Sno++;
        }
        echo $output;
    }
}
if (!isset($_POST['connection']) || !isset($_POST['getcoordinatorid'])) {
    header("Location:../../coordinator/coordinatorlogin_signup.html");
} else {
    $run =  new loadrequest($_POST["getcoordinatorid"]);
    $run->closeConnection();
}