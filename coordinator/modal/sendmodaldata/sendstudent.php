<?php
require_once("../../inner/db_connection.php");
class sendStudent extends db_connection
{
    private $email;
    private $getBatchid;
    function __construct($email, $getBatchid)
    {
        parent::__construct();
        $this->email = $email;
        $this->getBatchid = $getBatchid;
        require_once("../../../coordinator/checkDataExists/batch.php");
        if ($this->checkValid()) {
            $sql = $this->conn->prepare("SELECT * FROM `student` WHERE `studentemail` = ?");
            $sql->bindParam(1, $email);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                // student email already exits 
                echo 2;
            } else {
                if ($countBatch > 0) {
                    $password = rand(10000, 100000);
                    $sql = $this->conn->prepare("INSERT INTO `student`(`studentemail`,`studentpassword`, `batchid`,`creationtime`) VALUES (?,?,?,current_timestamp())");
                    $sql->bindParam(1, $this->email);
                    $sql->bindParam(2, $password);
                    $sql->bindParam(3, $this->getBatchid);
                    if ($sql->execute()) {

                        // data send 
                        $sql = $this->conn->prepare("SELECT * FROM `student` WHERE `studentemail` = ?");
                        $sql->bindParam(1, $email);
                        $sql->execute();
                        foreach ($sql->fetchAll(PDO::FETCH_ASSOC) as $student) {
                            $studentid = $student['studentid'];
                            break;
                        }
                        $getallsemester = $this->conn->prepare("SELECT * FROM `semester` WHERE `batchid` = ?");
                        $getallsemester->bindParam(1, $this->getBatchid);
                        $getallsemester->execute();
                        foreach ($getallsemester->fetchALL(PDO::FETCH_ASSOC) as $allsem) {
                            $getalllecture = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE `semesterid` = ?");
                            $getalllecture->bindParam(1, $allsem['semesterid']);
                            $getalllecture->execute();
                            if ($getalllecture->rowCount() > 0) {

                                foreach ($getalllecture->fetchAll(PDO::FETCH_ASSOC) as $plan) {


                                    $insert = $this->conn->prepare("INSERT INTO `studentabsent`(`studentid`, `subjectid`, `semesterid`, `markdate`, `lecturehour`) VALUES (?,?,?,?,?)");
                                    $insert->bindParam(1, $studentid);
                                    $insert->bindParam(2, $plan['subjectid']);
                                    $insert->bindParam(3, $plan['semesterid']);
                                    $insert->bindParam(4, $plan['lecturedate']);
                                    $insert->bindParam(5, $plan['lecturehour']);
                                    $insert->execute();
                                }
                            } else {
                                continue;
                            }
                        }
                        echo 3;
                    } else {
                        //data not send
                        echo 1;
                    }
                } else {
                    echo 0;
                }
            }
        } else {
            // data is invalid
            echo 1;
        }
    }
    private function checkvalid()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
}



if (isset($_POST['connection']) && isset($_POST["get_Batchid"])) {
    $run = new sendStudent($_POST["get_Email"], $_POST['get_Batchid']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}