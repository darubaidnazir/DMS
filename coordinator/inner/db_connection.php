<?php
class db_connection{
      private  $db_name = "mysql:host=localhost;dbname=DMStest";
      private  $username = "root";
      private  $password = "";
      protected $conn ;
      function __construct(){

      
        try{
        $this->conn = new PDO($this->db_name,$this->username,$this->password);

        }
        catch(PDOException $obj){
             // echo 'Connection Failed';
             echo 0;
              die();
        }
       

      }

     public function closeConnection(){

      $this->conn = null;
     

     }
}

//if(!isset($_POST['connection'])){
//header("location:home.php");
//}
?>