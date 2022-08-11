<?php

 echo '<tr>
 <td data-title="S.No">1</td>
 <td data-title="Student Id">1542552</td>
 <td data-title="Student Id">Dar Ubaid Nazir</td>
 <td data-title="Student Enrollment">18048112009</td>
 <td data-title="Student Dob">01-04-2001</td>
 <td class="select">
     <div class="btn-group" role="group" aria-label="Basic mixed styles example">
         <button type="button" class="btn btn-danger">
             Edit
         </button>
         <button type="button" class="btn btn-warning">
             Remove
         </button>
         <button type="button" class="btn btn-success clickbutton"
             data-bs-toggle="modal" data-bs-target="#student-information">
             More Information
         </button>
     </div>
 </td>
</tr>';

 require_once("../inner/db_connection.php");
 class loadStudentData extends db_connection{
             private $getBranchid ;
             private $getBatchid;
             public $output="";
             function __construct($getBranchid,$getBatchid){
                parent::__construct();
                $this->getBranchid = $getBranchid;
                $this->getBatchid = $getBatchid;
                $sql = $this->conn->prepare("SELECT * FROM `branch` INNER JOIN ``WHERE `branchid` = ?");
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
    //$run =  new loadStudentData($_POST["get_Branchid"],$_POST["get_Batchid"]);
    //$run->closeConnection();

    }
?>
