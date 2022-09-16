<?php
require_once("../../inner/db_connection.php");

class  SendGroup extends db_connection
{

    function  __construct($group, $id)
    {
        parent::__construct();
        if ($group == "G1" || $group == "G2") {
            $count = count($id);
            if ($count > 0) {
                for ($i = 0; $i < $count; $i++) {
                    $sql = $this->conn->prepare("UPDATE `student` SET `group_id`= ? WHERE studentid = ?");
                    $sql->bindParam(1, $group);
                    $sql->bindParam(2, $id[$i]);
                    $sql->execute();
                }
                echo 3;
            } else {
                echo 1;
            }
        } else {

            echo 1;
        }
    }
}



if (isset($_POST['connection']) && isset($_POST['group'])) {
    $run =  new SendGroup($_POST['group'], $_POST['id']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}