<?php
 require_once("../../coordinator/inner/db_connection.php");
 class loginStudent extends db_connection{
      protected $email;
      protected $password;
      function __construct($email , $password){
          parent::__construct(); 
          $this->email = trim(htmlspecialchars($email));
          $this->password = trim(htmlspecialchars($password));
          if($this->validate()){
            if($this->checkEmailExists()){ 
               //  echo 3;    
            }else{
              echo 1;
              // email or password wrong
             }
          }else{
            echo 0;
            // input validate
           }
      }
      private function validate(){
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
          return false;
        }  
        return true;
      }
      private function checkEmailExists(){
        $sql = $this->conn->prepare("SELECT * FROM student WHERE studentemail = ?");
        $sql->bindParam(1,$this->email);
        $sql->execute();
        if($sql->rowCount() > 0){
             $result = $sql->fetch(PDO::FETCH_ASSOC);
             $pass = $result['studentpassword'];
             if(password_verify($this->password,$pass)){
                session_start();
                $_SESSION['active'] = true;
                $_SESSION['studentid'] = $result['studentid'];
                $_SESSION['studentname'] = $result['studentname'];
                 echo 3;
                exit();
                
                return true;
              }else{
              
                return false;
              }
        }else{
            return false;
        }

      }
 }
 
 if (isset($_POST['email_login']) && isset($_POST['connection'])){
    $run = new loginStudent($_POST['email_login'],$_POST['password_login']);
   
    $run->closeConnection();
   }else{
     header("Location:../studentlogin.html");
  }
  
?>