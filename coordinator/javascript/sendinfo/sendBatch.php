<?php
  require_once("../../inner/db_connection.php");
  class sendBatch extends db_connection{
         private $get_Year;
         private $get_Branch;
         private $get_Coordinatorid;

    function __construct($getYear,$getBranch,$getCoordinatorid){
        parent::__construct(); 

        $this->get_Branch = trim(htmlspecialchars($getBranch));
        $this->get_Year = trim(htmlspecialchars($getYear));
        $this->get_Coordinatorid = trim(htmlspecialchars($getCoordinatorid));
           require_once("../../../coordinator/checkDataExists/branch.php");
           require_once("../../../coordinator/checkDataExists/coordinator.php");
        if ($this->checkValid()){
            //data is valid 
            if ($countCoordinator > 0 && $countBranch > 0){
            $this->sendData();
            }else{
                echo 0;
            }
        }else{
            //data is not valid to send into database
            echo 1;
        }
        


    }

    private function checkValid(){
       if(strlen($this->get_Year) != 4  || !is_numeric($this->get_Year) ){
        return false;
       }

     return true;
    }
    private function sendData(){
        $sql = $this->conn->prepare("SELECT * FROM `batch` WHERE `branchid` = ? && batchyear = ?");
        $sql->bindParam(1,$this->get_Branch);
        $sql->bindParam(2,$this->get_Year);
        $sql->execute();
        if($sql->rowCount() > 0){
                // Batch year aleady present with this branch
                echo 2;
        }else{
            $sql = $this->conn->prepare("INSERT INTO `batch`(`batchyear`, `branchid` , `creationdate`) VALUES (?,?,current_timestamp())");
            $sql->bindParam(1,$this->get_Year);
            $sql->bindParam(2,$this->get_Branch);
           
            if(  $sql->execute() ){
                //data send
                echo 3;
            }else{
                // data not send 
                echo 1;
            }

        }
        

        }
   

    }

  
  

if(isset($_POST["get_Coordinator"]) && isset($_POST['connection']) && isset($_POST['get_Branch'])){
      $run = new sendBatch($_POST['get_Year'],$_POST['get_Branch'],$_POST["get_Coordinator"]);
      $run->closeConnection();
}else{
    header("Location:../../../coordinatorlogin_signup.html");
}

?>