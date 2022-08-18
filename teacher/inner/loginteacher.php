<?php
require_once("../../coordinator/inner/db_connection.php");
class login extends db_connection
{
  protected $teacherusername;
  protected $password;
  function __construct($email, $password)
  {
    parent::__construct();
    $this->teacherusername = trim(htmlspecialchars($email));
    $this->password = trim(htmlspecialchars($password));
    if ($this->validate()) {
      if ($this->checkEmailExists()) {
        echo 3;
      } else {
        echo 1;
        // email or password wrong
      }
    } else {
      echo 0;
      // input validate
    }
  }
  private function validate()
  {
    return true;
  }
  private function checkEmailExists()
  {
    $sql = $this->conn->prepare("SELECT * FROM `teacher` WHERE `teacherusername` = ?");
    $sql->bindParam(1, $this->teacherusername);
    $sql->execute();
    if ($sql->rowCount() > 0) {
      $result = $sql->fetch(PDO::FETCH_ASSOC);
      $pass = $result['teacherpassword'];
      $status = $result['teacherstatus'];
      if (password_verify($this->password, $pass) && $status  != 'disabled') {
        session_start();
        $_SESSION['active'] = true;
        $_SESSION['teacheruserid'] = $result['teacherid'];
        $_SESSION['teacherusername'] = $result['teacherusername'];
        echo 3;
        exit();

        return true;
      } else {

        return false;
      }
    } else {
      return false;
    }
  }
}

if (isset($_POST['email_']) && isset($_POST['connection'])) {
  $run = new login($_POST['email_'], $_POST['pass_word']);

  $run->closeConnection();
} else {
  header("Location:../teacherlogin.html");
}