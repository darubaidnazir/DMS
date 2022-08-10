<?php
include_once('db_connection.php');
class registations extends db_connection{
       protected $email;
       protected $username;
       protected $phonenumber;
       protected $department;
       protected $password;
       protected $confirmpassword;
     function __construct($username,$email,$phonenumber,$department,$password,$confirmpassword){
                      $this->username =  trim(htmlspecialchars($username));
                      $this->email = trim(htmlspecialchars($email));
                      $this->phonenumber = trim(htmlspecialchars($phonenumber));
                      $this->department = trim(htmlspecialchars($department));
                      $this->password = trim(htmlspecialchars($password));
                      $this->confirmpassword = trim(htmlspecialchars($confirmpassword));
                      parent::__construct();       
              if ($this->validate_data()){
                        
                          if ($this->checkEmail()){
                           $this->registerEmail();

                    }else{

                       echo 2;
                         }
        }else{
           echo 1;
        }
       
     }
      private function validate_data(){
        if (!preg_match("/^[a-zA-Z-0-9' ]*$/", $this->username)) {
          return false;

        }

        if (!preg_match("/^[a-zA-Z-' ]*$/", $this->department)) {
          return false;
         }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
          return false;
        }if (!preg_match('/^[0-9]*$/', $this->phonenumber)) {
          return false;
         } 
         if(strlen($this->phonenumber) > 10 && strlen($this->phonenumber) < 10 ){
          return false;
         }
         if (strlen($this->password) < 8 && strlen($this->confirmpassword) < 8){
          return false;
         }
         if($this->password !== $this->confirmpassword){
          return false;
         }
       
        return true;
      }
      private function checkEmail(){

        $sql = $this->conn->prepare("SELECT * FROM coordinator WHERE email = ?");
        $sql->bindParam(1,$this->email);
        $sql->execute();
        if($sql->rowCount() > 0){
             return false;
        }else{
            return true;
        }



        
      }
      private function registerEmail(){
        $newpassword = password_hash($this->password,PASSWORD_DEFAULT);
        try{
         $sql = $this->conn->prepare("INSERT INTO `coordinator`(`fullname`, `email`, `phonenumber`, `department`, `password`,`createdate`) VALUES (?,?,?,?,?,current_timestamp())");
        $sql->bindParam(1,$this->username);
        $sql->bindParam(2,$this->email);
        $sql->bindParam(3,$this->phonenumber);
        $sql->bindParam(4,$this->department);
        $sql->bindParam(5,$newpassword);
        

        
        if ($sql->execute()){
           
            echo 3;
        }else{
             echo "User registations failed";
             echo 0;
        }
  }catch(PDOException $obj1){
    
    echo 0;
  }
      }

    }

 // if (isset($_POST['email_']) && isset($_POST['connection'])){
  $run = new registations($_POST['user_name'],$_POST["email_"],$_POST["phone_number"],$_POST["depart_ment"],$_POST["pass_word"],$_POST["password_2"]); 
  $run->closeConnection();
 // }else{
  //  header("Location:home.php");
  //}







?>