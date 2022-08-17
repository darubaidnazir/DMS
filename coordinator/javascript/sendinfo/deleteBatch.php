<?php
require_once("../../inner/db_connection.php");
class deleteBatch extends db_connection
{

  private $getBatchid;
  private $getCoordinatorid;

  function __construct($getBatchid, $getCoordinatorid)
  {
    parent::__construct();

    require_once("../../../coordinator/checkDataExists/batch.php");
    require_once("../../../coordinator/checkDataExists/coordinator.php");
  
    if ($countBatch > 0 && $countCoordinator > 0){

    $this->getBatchid = $getBatchid;
    $this->getCoordinatorid = $getCoordinatorid;

    $sql = $this->conn->prepare("SELECT * FROM `batch` WHERE `batchid` = ?");
    $sql->bindParam(1, $getBatchid);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    $sql2 = $this->conn->prepare("SELECT * FROM `student` WHERE `batchid` = ?");
    $sql2->bindParam(1, $getBatchid);
    $sql2->execute();
    $count = $sql2->rowCount();
    if ($result['currentsemester'] == 0   && $count == 0) {

      $sql = $this->conn->prepare("DELETE FROM `batch` WHERE `batchid` = ?");
      $sql->bindParam(1, $getBatchid);
      if ($sql->execute()) {
        //deleted 
        echo 3;
      } else {
        //not deleted 
        echo 2;
      }
    } else {
      // one o5 more semester active or ceated
      echo 1;
    }
  }
}else{
  echo 0;
}
}

if (isset($_POST["get_Coordinator"]) && isset($_POST['connection']) && isset($_POST['get_Batchid'])) {
  $run = new deleteBatch($_POST['get_Batchid'], $_POST["get_Coordinator"]);
  $run->closeConnection();
} else {
  header("Location:../../../coordinatorlogin_signup.html");
}