<?php
require_once("../../coordinator/inner/db_connection.php");
class loadStudent_Extra extends db_connection
{

    function  __construct($semesterid, $rollno)
    {
        parent::__construct();
        $output = "";
        if (is_numeric($rollno)) {
            $sql = $this->conn->prepare("SELECT * FROM semester WHERE semesterid = ? and semesterstatus ='1'");
            $sql->bindParam(1, $semesterid);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $result =  $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $batchid = $row['batchid'];
                    break;
                }
                $sql = $this->conn->prepare("SELECT * FROM student WHERE batchid = ? and studentrollno= ? and studentstatus ='active'");
                $sql->bindParam(1, $batchid);
                $sql->bindParam(2, $rollno);
                $sql->execute();
                if ($sql->rowCount() > 0) {
                    $result =  $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        $output .= "<input class='form-control' value='{$row['studentname']}'disabled style='margin:2px'> <span style='color:red' id='inp_message'></span><input class='form-control' type='number' min='0' max='99' id='percentage_student' placeholder='Enter extra percentage'> <button style='margin:5px'id='send_extra' data-semesterid='{$semesterid}' data-studentid='{$row['studentid']}' class='btn btn-primary'>Add Extra</button>";
                    }
                } else {
                    $output .= "No Student Data Available! Please try again";
                    //no stduent
                }
            } else {
                $output .= "No Batch Found! ";
                // no batch
            }
        } else {
            echo 2;
        }
        echo $output;
    }
}



if (isset($_POST['connection']) && isset($_POST['semesterid'])) {
    $run =  new loadStudent_Extra($_POST['semesterid'], $_POST['rollno']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}