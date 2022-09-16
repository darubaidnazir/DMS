<?php
require_once("../../coordinator/inner/db_connection.php");

class loadSemSubject extends db_connection
{

    function  __construct($semesterid)
    {
        parent::__construct();
        $output = "<option value='0'>Select a Subject</option>";
        $sql = $this->conn->prepare("SELECT * FROM `assignedsubject` INNER join subject on assignedsubject.subjectid = subject.subjectid INNER join semester on assignedsubject.semesterid = semester.semesterid WHERE semester.semesterid = ? && assignedsubject.assignedstatus != 'disabled'");
        $sql->bindParam(1, $semesterid);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $values = $row['subjectid'];
                $values .= ",";
                $values .= $row['semesterid'];
                $values .= ",";
                $values .= $row['subjectname'];
                $values .= ",";
                $values .= $row['subjectcode'];
                $output .= " <option
                value='{$values}'>{$row['subjectname']}</option>";
            }
        } else {
            $output .= "";
        }

        echo $output;
    }
}



if (isset($_POST['connection']) && isset($_POST['semesterid'])) {
    $run =  new loadSemSubject($_POST['semesterid']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}