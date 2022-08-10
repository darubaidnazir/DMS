<?php
 require_once("db_connection.php");
 class login extends db_connection{
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
        $sql = $this->conn->prepare("SELECT * FROM coordinator WHERE email = ?");
        $sql->bindParam(1,$this->email);
        $sql->execute();
        if($sql->rowCount() > 0){
             $result = $sql->fetch(PDO::FETCH_ASSOC);
             $pass = $result['password'];
             if(password_verify($this->password,$pass)){
                session_start();
                $_SESSION['active'] = true;
                $_SESSION['userid'] = $result['id'];
                $_SESSION['username'] = $result['fullname'];
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
 
 //if (isset($_POST['emailogin']) && isset($_POST['connection'])){
    $run = new login($_POST['emaillogin'],$_POST['passwordlogin']);
   
    $run->closeConnection();
   //}else{
    // header("Location:home.php");
 //  }
  
?>