<?php
include_once("../../inner/db_connection.php");
class opensemester extends db_connection
{
    function __construct($getBatchid)
    {
        parent::__construct();
        require_once("../../../coordinator/checkDataExists/batch.php");
        if ($countBatch > 0) {
            $sql = $this->conn->prepare("SELECT * FROM `batch` WHERE `batchid` = ?");
            $sql->bindParam(1, $getBatchid);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $sem = 1;
            $status = 1;
            $statusclose = 0;
            $semesterno = $result["currentsemester"];
            $sql5 = $this->conn->prepare("SELECT * FROM `batch` INNER JOIN `branch` ON batch.branchid = branch.branchid WHERE `batchid` = ? ");
            $sql5->bindParam(1, $getBatchid);
            $sql5->execute();
            $resultmain = $sql5->fetch(PDO::FETCH_ASSOC);
            $totalsemester = $resultmain["totalsemester"];
            if ($semesterno == $totalsemester) {
                $sql3 = $this->conn->prepare("UPDATE `semester` SET `closedate`= current_timestamp() ,`semesterstatus`= ? WHERE `batchid` = ? && `semesterno` = ?");
                $sql3->bindParam(1, $statusclose);
                $sql3->bindParam(2, $getBatchid);
                $sql3->bindParam(3, $semesterno);
                $sql3->execute();
                $sql1 = $this->conn->prepare("UPDATE `batch` SET `batchstatus`= ? WHERE `batchid` = ?");

                $sql1->bindParam(1, $statusclose);
                $sql1->bindParam(2, $getBatchid);
                $sql1->execute();
                echo 5; //semester close
            } else {
                if ($semesterno == 0) {
                    $sql2 =  $this->conn->prepare("INSERT INTO `semester`(`semesterno`, `batchid`, `semesterstatus` ,`opendate`) VALUES (?,?,?,current_timestamp())");
                    $sql2->bindParam(1, $sem);
                    $sql2->bindParam(2, $getBatchid);
                    $sql2->bindParam(3, $status);
                    if ($sql2->execute()) {

                        $sql1 = $this->conn->prepare("UPDATE `batch` SET `currentsemester`= ? ,`batchstatus`= ? WHERE `batchid` = ?");
                        $sql1->bindParam(1, $sem);
                        $sql1->bindParam(2, $status);
                        $sql1->bindParam(3, $getBatchid);
                        $sql1->execute();
                        echo 3; // First Semester Started
                    } else {
                        echo 1;
                    }
                } else {

                    // semester not started
                    $sql3 = $this->conn->prepare("UPDATE `semester` SET `closedate`= current_timestamp() ,`semesterstatus`= ? WHERE `batchid` = ? && `semesterno` = ?");
                    $sql3->bindParam(1, $statusclose);
                    $sql3->bindParam(2, $getBatchid);
                    $sql3->bindParam(3, $semesterno);
                    if ($sql3->execute()) {

                        $semesterno = $semesterno + 1;
                        $sql2 =  $this->conn->prepare("INSERT INTO `semester`(`semesterno`, `batchid`, `semesterstatus` ,`opendate`) VALUES (?,?,?,current_timestamp())");
                        $sql2->bindParam(1, $semesterno);
                        $sql2->bindParam(2, $getBatchid);
                        $sql2->bindParam(3, $status);
                        if ($sql2->execute()) {

                            $sql1 = $this->conn->prepare("UPDATE `batch` SET `currentsemester`= ? ,`batchstatus`= ? WHERE `batchid` = ?");
                            $sql1->bindParam(1, $semesterno);
                            $sql1->bindParam(2, $status);
                            $sql1->bindParam(3, $getBatchid);
                            $sql1->execute();
                            echo 4; // previous closed new opened


                        } else {
                            echo 1;
                        }
                    } else {
                        echo 1;
                    }
                }
            }
        } else {
            echo 0;
        }
    }
}










if (isset($_POST['connection']) && isset($_POST["get_Batchid"])) {
    $run = new opensemester($_POST['get_Batchid']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}