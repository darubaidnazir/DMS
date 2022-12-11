<?php
require_once("../../coordinator/inner/db_connection.php");
class UpdateStudent extends db_connection
{
    private $name;
    private $rollno;
    private $regno;
    private $dob;
    function __construct($id, $name, $rollno, $regno, $dob)
    {
        parent::__construct();
        $this->name = $name;
        $this->rollno = $rollno;
        $this->regno = $regno;
        $this->dob = $dob;
        $check = $this->conn->prepare("SELECT * FROM `student` WHERE `studentid` = ?");
        $check->bindParam(1, $id);
        $check->execute();
        if ($check->rowCount() >  0) {
            $update = $this->conn->prepare("UPDATE `student` SET `studentname`= ?,`studentregno`= ? ,`studentrollno`= ? ,`studentdob`= ? WHERE `studentid` = ?");
            $update->bindParam(1, $this->name);
            $update->bindParam(2, $this->regno);
            $update->bindParam(3, $this->rollno);
            $update->bindParam(4, $this->dob);
            $update->bindParam(5, $id);
            if ($update->execute()) {
                echo 3; //sucess
            } else {
                echo 1; //failed
            }
        } else {
            echo 0; //erro
        }
    }
}



if (isset($_POST['connection']) && isset($_POST["get_studentid"])) {
    $run = new UpdateStudent($_POST["get_studentid"], $_POST["get_studentname"], $_POST["get_studentrollno"], $_POST["get_studentregno"], $_POST["get_studentdob"]);
    $run->closeConnection();
} else {
    header("Location:../studentlogin.html");
}