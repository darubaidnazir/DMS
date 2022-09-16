<?php
require_once("../../coordinator/inner/db_connection.php");

class loadBatch extends db_connection
{

    function  __construct($batchid)
    {
        parent::__construct();
        $output = "<option value='0'>Select a Semester No</option>";
        $sql = $this->conn->prepare("SELECT * FROM semester WHERE batchid = ?");
        $sql->bindParam(1, $batchid);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {

                $output .= "<option value='{$row['semesterid']}'>{$row['semesterno']}</option>";
            }
        } else {
            $output .= "";
        }

        echo $output;
    }
}



if (isset($_POST['connection']) && isset($_POST['batchid'])) {
    $run =  new loadBatch($_POST['batchid']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}