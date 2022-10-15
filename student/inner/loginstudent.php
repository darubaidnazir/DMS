<?php
if(!isset($_POST['email_']) || !isset($_POST['connection']) || $_POST['connection'] != true){
    header("Location:../studentlogin.html");
    exit();
}
require_once("../../coordinator/dbcon.php");
$email = $_POST['email_'];  
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo 0;
    exit();
}
$sql = $conn->prepare("SELECT * FROM student where studentemail = ?");
$sql->bindParam(1,$email);
$sql->execute();
$count_rows = $sql->rowCount();
if ($count_rows == 1){
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if($result['studentstatus'] == "inactive"){
        echo 2;//registered but inactive

    }
    else if($result['studentstatus'] == "active"){
        echo 4;//active student
    }

    
    else if($result['studentstatus'] == "disabled"){
        echo 3;//disabled
    }
    else{
        echo 0;
}

}else{
    echo 1;//student not registered
    
}


?>