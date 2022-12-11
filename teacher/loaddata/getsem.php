<?php
require_once("../../coordinator/inner/db_connection.php");

class loadStudentLab extends db_connection
{

    function  __construct($semesterid, $group)

    {
        $output = "";
        parent::__construct();
        if ($group == 'G1' || $group == 'G2') {

            $sql = $this->conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ? ");
            $sql->bindParam(1, $semesterid);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $rows) {
                $newbatchid = $rows['batchid'];
                break;
            }
            $sql = $this->conn->prepare("SELECT *  FROM `student` WHERE `batchid` = ? && group_id = ? ORDER BY `studentrollno` ASC");
            $sql->bindParam(1, $newbatchid);
            $sql->bindParam(2, $group);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $resultnew = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultnew as $row) {
                    $my_array1 = str_split($row['studentrollno']);
                    $length = count($my_array1);
                    $name = $my_array1[$length - 2];
                    $name .= $my_array1[$length - 1];

                    $output .= "

<label class='attendancebutton'>{$name}
    <input type='checkbox' id='checkbox1' value='{$row['studentid']}'>

</label>";

                    unset($my_array1);
                }
            } else {
                echo 1;
            }
        } else if ($group == 'BOTH') {
            $sql = $this->conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ? ");
            $sql->bindParam(1, $semesterid);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $rows) {
                $newbatchid = $rows['batchid'];
                break;
            }
            $sql = $this->conn->prepare("SELECT *  FROM `student` WHERE `batchid` = ? ORDER BY `studentrollno` ASC ");
            $sql->bindParam(1, $newbatchid);

            $sql->execute();
            $resultnew = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultnew as $row) {
                $my_array1 = str_split($row['studentid']);
                $length = count($my_array1);
                $name = $my_array1[$length - 2];
                $name .= $my_array1[$length - 1];

                $output .= "

<label class='attendancebutton'>{$name}
    <input type='checkbox' id='checkbox1' value='{$row['studentid']}'>

</label>";

                unset($my_array1);
            }
        } else {
            die();
        }



        echo $output;
    }
}



if (isset($_POST['connection']) && isset($_POST['semesterid'])) {
    $run =  new loadStudentLab($_POST['semesterid'], $_POST['group']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}