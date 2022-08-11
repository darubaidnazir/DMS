<?php
  require_once("../../inner/db_connection.php");
  class deleteBranch extends db_connection{
              
               private $getBranchid;
               private $getCoordinator;
               
    function __construct($getBranchid,$getCoordinator){
        parent::__construct(); 
        $this->getBranchid = $getBranchid;
        $this->getCoordintor = $getCoordinator;
        
        $sql = $this->conn->prepare("SELECT * FROM `batch` WHERE `branchid` = ?");
        $sql->bindParam(1,$getBranchid);
        
        $sql->execute();
        if ( $sql->rowCount() > 0){
           // Some batch is present in the bracnh cant delete this branch
           echo 1;

        }else{
            $sql = $this->conn->prepare("DELETE FROM `branch` WHERE `branchid` = ? && `coordinatorid` = ?");
        $sql->bindParam(1,$getBranchid);
        $sql->bindParam(2,$getCoordinator);
        if($sql->execute()){
            //deleted 
            echo 3;
        }else{
            //not deleted 
            echo 2;
        }

        }
    }
         


  }
  
if(isset($_POST["get_Coordinator"]) && isset($_POST['connection']) && isset($_POST['get_Branchid'])){
    $run = new deleteBranch($_POST['get_Branchid'],$_POST["get_Coordinator"]);
    $run->closeConnection();
}else{
  header("Location:../../../coordinatorlogin_signup.html");
}

?>