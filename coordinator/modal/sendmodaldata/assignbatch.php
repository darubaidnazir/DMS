<?php
require_once("../../../coordinator/inner/db_connection.php");

class  SendBatchToSyllabus extends db_connection
{

    function  __construct($batchid, $syllabusid, $subjectid)
    {
        parent::__construct();
        $check1 = $this->conn->prepare("SELECT * FROM `assignedsyllabus` WHERE batchid = ? && subjectid = ? ");
        $check1->bindParam(1, $batchid);
        $check1->bindParam(2, $subjectid);
        $check1->execute();
        if ($check1->rowCount() > 0) {
            echo 5; //pressnt sylbus
        } else {
            $check = $this->conn->prepare("SELECT * FROM `assignedsyllabus` WHERE `batchid` = ? AND `syllabusid` =?");
            $check->bindParam(1, $batchid);
            $check->bindParam(2, $syllabusid);
            $check->execute();
            if ($check->rowCount() > 0) {
                echo 2; //already assigned
            } else {

                $insert = $this->conn->prepare("INSERT INTO `assignedsyllabus`(`syllabusid`, `batchid`,`subjectid`) VALUES (?,?,?)");
                $insert->bindParam(1, $syllabusid);
                $insert->bindParam(2, $batchid);
                $insert->bindParam(3, $subjectid);
                if ($insert->execute()) {
                    echo 3; //successe
                } else {
                    echo 0; //error
                }
            }
        }
    }
}



if (isset($_POST['connection']) && isset($_POST['get_batchid'])) {
    $run =  new SendBatchToSyllabus($_POST['get_batchid'], $_POST['get_syllabus'], $_POST['get_subjectids']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}