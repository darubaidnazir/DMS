<?php
include_once("../../inner/db_connection.php");
class sendsubject extends db_connection
{

    function __construct($getsubjectname, $getsubjectcode, $getCoordinatorid, $subjectlevel)
    {
        parent::__construct();
        require_once("../../../coordinator/checkDataExists/coordinator.php");
        if ($countCoordinator > 0) {
            if ($getsubjectcode == ""  ||  $getsubjectname == "" || $subjectlevel == "") {
                //not valid 
                echo 1;
            } else if ($subjectlevel == "T" || $subjectlevel == "L") {
                $sql1 = $this->conn->prepare("SELECT * FROM `subject` WHERE `subjectcode` = ? && `coordinatorid` = ?");
                $sql1->bindParam(1, $getsubjectcode);
                $sql1->bindParam(2, $getCoordinatorid);
                $sql1->execute();
                $count = $sql1->rowCount();
                if ($count > 0) {
                    echo 2;
                    //subejct code present
                } else {
                    $sql = $this->conn->prepare("INSERT INTO `subject` ( `subjectname`, `subjectcode`, `coordinatorid`,`subjectlevel`, `creationtime`) VALUES (?,?,?,?,current_timestamp())");
                    $sql->bindParam(1, $getsubjectname);
                    $sql->bindParam(2, $getsubjectcode);
                    $sql->bindParam(3, $getCoordinatorid);
                    $sql->bindParam(4, $subjectlevel);
                    if ($sql->execute()) {
                        echo 3;
                        //send
                    } else {
                        //not send
                        echo 1;
                    }
                }
            }
        } else {
            echo 0;
        }
    }
}























if (isset($_POST["get_Coordinator"]) && isset($_POST['connection']) && isset($_POST['get_Subjectname'])) {
    $run = new sendsubject($_POST['get_Subjectname'], $_POST['get_Subjectcode'], $_POST["get_Coordinator"], $_POST['subjectlevel']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}