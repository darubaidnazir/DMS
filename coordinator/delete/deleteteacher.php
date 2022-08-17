<?php
include_once("../inner/db_connection.php");
class deleteteacher extends db_connection
{
    function __construct($getteacherid)
    {
        parent::__construct();


        $check =  $this->conn->prepare("SELECT * FROM `teacher` WHERE `teacherid` = ?");
        $check->bindParam(1, $getteacherid);
        $check->execute();
        $count = $check->rowCount();
        if ($count > 0){
        $sqlpre = $this->conn->prepare("SELECT * FROM `assignedsubject` WHERE `teacherid` = ?");
        $sqlpre->bindParam(1, $getteacherid);
        $sqlpre->execute();
        $count = $sqlpre->rowCount();
        if ($count == 0) {
            $sql = $this->conn->prepare("DELETE FROM `teacher` WHERE `teacherid` = ?");
            $sql->bindParam(1, $getteacherid);
            if ($sql->execute()) {
                //deleted 
                echo 3;
            } else {
                echo 1;
                //not deleted
            }
        } else {
            $status = "disabled";
            $sql1 = $this->conn->prepare("UPDATE `teacher` SET `teacherstatus`= ?  WHERE `teacherid`= ?");
            $sql1->bindParam(1, $status);
            $sql1->bindParam(2, $getteacherid);
            $sql1->execute();
            echo 2;
        }
    }
        else{
            echo 0;
        }
    }
}


if (isset($_POST['get_Teacherid']) && isset($_POST['connection'])) {
    $run = new deleteteacher($_POST['get_Teacherid']);

    $run->closeConnection();
} else {
    header("Location:../coordinatorlogin_signup.html");
}