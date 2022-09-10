<?php
session_start();
require_once("../inner/db_connection.php");
class loadStudentData_batch extends db_connection
{
   public $output = " <option selected value='0'>Select a Batch</option>";
   function __construct()
   {
      parent::__construct();

      $sql = $this->conn->prepare("SELECT * FROM `batch` INNER JOIN `branch` on branch.branchid = batch.branchid WHERE branch.coordinatorid = ?");
      $sql->bindParam(1, $_SESSION['userid']);
      $sql->execute();
      $result = $sql->fetchAll(PDO::FETCH_ASSOC);

      foreach ($result as $row) {
         $this->output .= "<option value='{$row["batchid"]}'> {$row["batchyear"]} - {$row["branchname"]}</option>";
      }

      echo $this->output;
   }
}
if (!isset($_POST['connection'])) {
   header("Location:../coordinatorlogin_signup.html");
} else {
   $run =  new loadStudentData_batch();
   $run->closeConnection();
}