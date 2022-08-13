<?php
include_once("../inner/db_connection.php");
class deleteteacher extends db_connection
{
    function __construct($getteacherid)
    {
        parent::__construct();
        $sql = $this->conn->prepare("DELETE FROM `teacher` WHERE `teacherid` = ?");
        $sql->bindParam(1, $getteacherid);
        if ($sql->execute()) {
            //deleted 
            echo 3;
        } else {
            echo 1;
            //not deleted
        }
    }
}


if (isset($_POST['get_Teacherid']) && isset($_POST['connection'])) {
    $run = new deleteteacher($_POST['get_Teacherid']);

    $run->closeConnection();
} else {
    header("Location:../coordinatorlogin_signup.html");
}