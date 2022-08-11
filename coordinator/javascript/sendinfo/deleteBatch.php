<?php
  require_once("../../inner/db_connection.php");
  class deleteBatch extends db_connection{
              
               private $getBatchid;
               private $getCoordinator;
               
    function __construct($getBatchid,$getCoordinator){
        parent::__construct(); 
        $this->getBatchid = $getBatchid;
        $this->getCoordintor = $getCoordinator;
        
        $sql = $this->conn->prepare("SELECT * FROM `batch` WHERE `batchid` = ?");
        $sql->bindParam(1,$getBatchid);
         $sql->execute();
         $result = $sql->fetch(PDO::FETCH_ASSOC);

        if ($result['currentsemester'] == 0 ){
           
            $sql = $this->conn->prepare("DELETE FROM `batch` WHERE `batchid` = ?");
            $sql->bindParam(1,$getBatchid);
            if($sql->execute()){
                //deleted 
                echo 3;
            }else{
                //not deleted 
                echo 2;
            }
        }else{
           // one o5 more semester active or ceated
           echo 1;

        }
    }
         


  }
  
if(isset($_POST["get_Coordinator"]) && isset($_POST['connection']) && isset($_POST['get_Batchid'])){
    $run = new deleteBatch($_POST['get_Batchid'],$_POST["get_Coordinator"]);
    $run->closeConnection();
}else{
  header("Location:../../../coordinatorlogin_signup.html");
}

?>