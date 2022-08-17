<?php
include_once("../../inner/db_connection.php");
class sendteacher extends db_connection
{
    private $getusername;
    private $getempid;
    private $getphonenumber;
    private $getposition;
    private $getCoordinatorid;
    function __construct($getusername, $getempid, $getphonenumber, $getposition, $getCoordinatorid)
    {
        parent::__construct();
        require_once("../../../coordinator/checkDataExists/coordinator.php");
        $this->getusername = $getusername;
        $this->getempid = $getempid;
        $this->getphonenumber = $getphonenumber;
        $this->getposition = $getposition;
        $this->getCoordinatorid = $getCoordinatorid;
        if ($this->checkValid()) {
            if($countCoordinatorid > 0 ){
            $this->sendData();
            }else{
                echo 0;
            }
        } else {
            // echo "no valid infom
            echo 1;
        }
    }
    private function checkvalid()
    {
        return true;
    }
    private function sendData()
    {
        $sql = $this->conn->prepare("SELECT * FROM `teacher` WHERE `teacherusername` = ?");
        $sql->bindParam(1, $this->getusername);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            // username is present 
            echo 2;
        } else {
            $password =  rand(100000, 100000);
            $sql = $this->conn->prepare("INSERT INTO `teacher` (`teacherusername`, `teacherempid`, `teacherphonenumber`, `teacherposition`, `teacherpassword`, `coordinatorid`,`creationtime`) VALUES (?,?,?,?,?,?,current_timestamp())");
            $sql->bindParam(1, $this->getusername);
            $sql->bindParam(2, $this->getempid);
            $sql->bindParam(3, $this->getphonenumber);
            $sql->bindParam(4, $this->getposition);
            $sql->bindParam(5, $password);
            $sql->bindParam(6, $this->getcoordinator);


            if ($sql->execute()) {
                echo 3;
                //data sent
            } else {
                //not sne
                echo 1;
            }
        }
    }
}

if (isset($_POST['connection']) && isset($_POST['get_Username'])) {
    $run =  new sendteacher($_POST['get_Username'], $_POST['get_Empid'], $_POST['get_Phonenumber'], $_POST['get_Position'], $_POST['get_Coordinator']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}