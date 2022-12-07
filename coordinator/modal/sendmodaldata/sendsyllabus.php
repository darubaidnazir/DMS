<?php
session_start();
require_once("../../../coordinator/inner/db_connection.php");
class sendsyllabus extends db_connection
{
    protected $syllabus;
    protected $coordinatorid;
    protected $subjectid;
    function  __construct($syllabus, $subjectid, $coordinatorid)
    {

        parent::__construct();
        $this->syllabus = $syllabus;
        $this->subjectid = $subjectid;
        $this->coordinatorid = $coordinatorid;
        $this->test_input();
        if ($this->syllabusIsValid()) {
            $checkforcoordinator = $this->conn->prepare("SELECT * FROM `subject` WHERE `subjectid` = ? && `coordinatorid` = ?");
            $checkforcoordinator->bindParam(1, $this->subjectid);
            $checkforcoordinator->bindParam(2, $this->coordinatorid);
            $checkforcoordinator->execute();
            if ($checkforcoordinator->rowCount() > 0) {
                $insert = $this->conn->prepare("INSERT INTO `syllabus`(`subjectid`, `syllabusdetails`) VALUES (?,?)");
                $insert->bindParam(1, $this->subjectid);
                $insert->bindParam(2, $this->syllabus);
                if ($insert->execute()) {
                    echo 3; //success
                } else {
                    echo 2; //fail
                }
            } else {
                echo 0; ///subject did not exits
            }
        } else {
            echo 1; //inValid Data
        }
    }
    function syllabusIsValid()
    {
        if (!preg_match("/^[a-zA-z-0-9-.]*$/", $this->syllabus)) {
            return TRUE;
        } else {
            return true;
        }
    }
    function test_input()
    {
        $this->syllabus = trim($this->syllabus);
        $this->syllabus = stripslashes($this->syllabus);
        $this->syllabus = htmlspecialchars($this->syllabus);
    }
}



if (isset($_POST['connection']) && isset($_POST['get_subjectid'])) {
    $coordinatorid = $_SESSION['userid'];
    $run =  new sendsyllabus($_POST['get_syllabus'], $_POST['get_subjectid'], $coordinatorid);
    $run->closeConnection();
} else {
    header("Location:../../coordinatorlogin_signup.html");
    session_destroy();
}