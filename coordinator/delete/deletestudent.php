<?php
include_once("../inner/db_connection.php");
class deletestudent extends db_connection
{
    function __construct($getstudentid)
    {
        parent::__construct();
        $sqlpre = $this->conn->prepare("SELECT * FROM student INNER JOIN batch on student.batchid = batch.batchid WHERE student.studentid = ?");
        $sqlpre->bindParam(1, $getstudentid);
        $sqlpre->execute();
        $result = $sqlpre->fetch(PDO::FETCH_ASSOC);
        if ($result["currentsemester"] > 0) {
            echo 2;
        } else {
            $sql = $this->conn->prepare("DELETE FROM `student` WHERE `studentid` = ?");
            $sql->bindParam(1, $getstudentid);
            if ($sql->execute()) {
                //deleted 
                echo 3;
            } else {
                echo 1;
                //not deleted
            }
        }
    }
}


if (isset($_POST['get_Studentid']) && isset($_POST['connection'])) {
    $run = new deletestudent($_POST['get_Studentid']);

    $run->closeConnection();
} else {
    header("Location:../coordinatorlogin_signup.html");
}