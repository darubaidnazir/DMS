<?php
require_once("../../coordinator/inner/db_connection.php");
class sendupdated extends db_connection
{

    function  __construct($getsemesterid, $getsubjectid, $getstudentid, $getid, $getdate)
    {
        parent::__construct();

        if ($getid == 0) { //mark absend
            $getlecturehour = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE  `subjectid` = ? && `semesterid` = ? && `lecturedate`= ?");
            $getlecturehour->bindParam(1, $getsubjectid);
            $getlecturehour->bindParam(2, $getsemesterid);
            $getlecturehour->bindParam(3, $getdate);
            $getlecturehour->execute();
            $fetch = $getlecturehour->fetchAll(PDO::FETCH_ASSOC);
            $no = 1;
            foreach ($fetch as $row) {
                $no = $row['lecturehour'];
                break;
            }

            $sql = $this->conn->prepare(" INSERT INTO `studentabsent`(`studentid`, `subjectid`, `semesterid`, `markdate`, `lecturehour`) VALUES (?,?,?,?,?)");
            $sql->bindParam(1, $getstudentid);
            $sql->bindParam(2, $getsubjectid);
            $sql->bindParam(3, $getsemesterid);
            $sql->bindParam(4, $getdate);
            $sql->bindParam(5, $no);
            if ($sql->execute()) {
                echo 3;
            } else {
                echo 1;
            }
        } else if ($getid == 1) { //mark present delete

            $sql = $this->conn->prepare("DELETE FROM `studentabsent` WHERE `studentid`= ? && `subjectid` = ? && `semesterid` = ? && `markdate`= ?");
            $sql->bindParam(1, $getstudentid);
            $sql->bindParam(2, $getsubjectid);
            $sql->bindParam(3, $getsemesterid);
            $sql->bindParam(4, $getdate);
            if ($sql->execute()) {
                echo 3;
            } else {
                echo 1;
            }
        } else {
            echo 0;
        }
    }
}








if (isset($_POST['connection']) && isset($_POST['getsemesterid'])) {
    $run =  new sendupdated($_POST['getsemesterid'], $_POST['getsubjectid'], $_POST['getstudentid'], $_POST['getid'], $_POST['getdate']);
    $run->closeConnection();
} else {
    header("Location:../../../teacherlogin.html");
}