<?php
  require_once("../../inner/db_connection.php");
  class deleteBranch extends db_connection{
              
               private $getBranchid;
               private $getCoordinatorid;
               
    function __construct($getBranchid,$getCoordinatorid){
        parent::__construct(); 
           require_once("../../../coordinator/checkDataExists/branch.php");
           require_once("../../../coordinator/checkDataExists/coordinator.php");

        if ($countBranch > 0 && $countCoordinator > 0){
    
      
        $this->getBranchid = $getBranchid;
        $this->getCoordintorid = $getCoordinatorid;
        
        $sql = $this->conn->prepare("SELECT * FROM `batch` WHERE `branchid` = ?");
        $sql->bindParam(1,$getBranchid);
        
        $sql->execute();
        if ( $sql->rowCount() > 0){
           // Some batch is present in the bracnh cant delete this branch
           echo 1;

        }else{
            $sql = $this->conn->prepare("DELETE FROM `branch` WHERE `branchid` = ? && `coordinatorid` = ?");
        $sql->bindParam(1,$getBranchid);
        $sql->bindParam(2,$getCoordinatorid);
        if($sql->execute()){
            //deleted 
            echo 3;
        }else{
            //not deleted 
            echo 2;
        }

        }
    }
         


    }else{
      echo 0;
    }
  }
  
if(isset($_POST["get_Coordinator"]) && isset($_POST['connection']) && isset($_POST['get_Branchid'])){
    $run = new deleteBranch($_POST['get_Branchid'],$_POST["get_Coordinator"]);
    $run->closeConnection();
}else{
  header("Location:../../../coordinatorlogin_signup.html");
}

?>