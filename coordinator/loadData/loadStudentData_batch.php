<?php
 require_once("../inner/db_connection.php");
 class loadStudentData_batch extends db_connection{
             private $getBranchid ;
             public $output="";
             function __construct($getBranchid){
                parent::__construct();
                $this->getBranchid = $getBranchid;
                $sql = $this->conn->prepare("SELECT * FROM `batch` WHERE `branchid` = ?");
                $sql->bindParam(1,$getBranchid);
                $sql->execute();
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($result as $row){
                    $this->output.= "<option value='{$row["batchid"]}'> {$row["batchyear"]}</option>";
                }

                echo $this->output;
             }
            







 }
 if(!isset($_POST['connection']) && !isset($_POST['get_Branchid'])){
    header("location:home.php");
    }else{
    $run =  new loadStudentData_batch($_POST["get_Branchid"]);
    $run->closeConnection();

    }
