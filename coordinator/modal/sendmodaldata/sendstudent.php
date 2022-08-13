<?php
require_once("../../inner/db_connection.php");
class sendStudent extends db_connection
{
    private $email;
    private $batchid;
    function __construct($email, $batchid)
    {
        parent::__construct();
        $this->email = $email;
        $this->batchid = $batchid;
        if ($this->checkValid()) {
            $sql = $this->conn->prepare("SELECT * FROM `student` WHERE `studentemail` = ?");
            $sql->bindParam(1, $email);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                // student email already exits 
                echo 2;
            } else {
                $password = rand(10000, 100000);
                $sql = $this->conn->prepare("INSERT INTO `student`(`studentemail`,`studentpassword`, `batchid`,`creationtime`) VALUES (?,?,?,current_timestamp())");
                $sql->bindParam(1, $this->email);
                $sql->bindParam(2, $password);
                $sql->bindParam(3, $this->batchid);
                if ($sql->execute()) {
                    // data send 
                    echo 3;
                } else {
                    //data not send
                    echo 1;
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
