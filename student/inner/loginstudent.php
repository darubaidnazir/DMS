<?php

require_once("../../coordinator/dbcon.php");


$email = $_POST['email_'];  


$sql = $conn->prepare("SELECT * FROM student where studentemail = ?");
$sql->bindParam(1,$email);
$sql->execute();
$count_rows = $sql->rowCount();
if ($count_rows == 1){
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if($result['studentstatus'] == "inactive"){
        echo 2;//registered but inactive
        session_start();
        $_SESSION["email"]=$email;

    }
    else if($result['studentstatus'] == "disabled"){
        echo 3;//disabled
    }
    else{
        echo 4;//active student
    }
}
else{
    echo 1;//student not registered
    
}

?>