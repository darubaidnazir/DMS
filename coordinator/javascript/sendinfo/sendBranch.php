<?php
  require_once("../../inner/db_connection.php");
  class sendBranch extends db_connection{
         private $get_Branch;
         private $get_Semester;
         private $get_Coordinator;

    function __construct($getBranch,$getSemester,$getCoordinator){
        parent::__construct(); 
        $this->get_Branch = trim(htmlspecialchars($getBranch));
        $this->get_Semester = trim(htmlspecialchars($getSemester));
        $this->get_Coordinator = trim(htmlspecialchars($getCoordinator));

        if ($this->checkValid()){
            //data is valid 
            $this->sendData();
        }else{
            //data is not valid to send into database
            echo 1;
        }
        


    }

    private function checkValid(){
        if($this->get_Semester > 13 || !is_numeric($this->get_Semester) || !preg_match("/^[a-zA-Z-,-.' ]*$/", $this->get_Branch) ){
            return false;
           }

     return true;
    }
    private function sendData(){
        $sql = $this->conn->prepare("SELECT * FROM `branch` WHERE `coordinatorid` = ? &&  `branchname` = ? ");
        $sql->bindParam(1,$this->get_Coordinator);
        $sql->bindParam(2,$this->get_Branch);
        $sql->execute();
        if ( $sql->rowCount() > 0 ){
              // name already present in the branch
              echo 2;
        }else{
            $sql = $this->conn->prepare("INSERT INTO `branch`(`branchname`, `totalsemester`, `coordinatorid`, `creationdate`) VALUES (?,?,?,current_timestamp())");
            $sql->bindParam(1,$this->get_Branch);
            $sql->bindParam(2,$this->get_Semester);
            $sql->bindParam(3,$this->get_Coordinator);
            if( $sql->execute()){
                //data send
                echo 3;
            }else{
              //data not send
              echo 1;
            }

        }

    }


  }
  

if(isset($_POST["get_Coordinator"]) && isset($_POST['connection']) && isset($_POST['get_Branch'])){
      $run = new sendBranch($_POST['get_Branch'],$_POST['get_Semester'],$_POST["get_Coordinator"]);
      $run->closeConnection();
}else{
    header("Location:../../../coordinatorlogin_signup.html");
}

?>