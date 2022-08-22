<?php
require_once("../../coordinator/inner/db_connection.php");

class loadlecture extends db_connection

{


    function __construct($getsubjectid, $getsemeterid)
    {
        parent::__construct();

        $output = "";
        $sql = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE `subjectid` = ? && `semesterid` = ?");
        $sql->bindParam(1, $getsubjectid);
        $sql->bindParam(2, $getsemeterid);
        $sql->execute();
        $getbatch = $this->conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ?");
        $getbatch->bindParam(1, $getsemeterid);
        $getbatch->execute();
        $getresult = $getbatch->fetchAll(PDO::FETCH_ASSOC);
        foreach ($getresult as $getrow) {
            $batchid = $getrow['batchid'];
            break;
        }
        $getbatch = $this->conn->prepare("SELECT * FROM `student` WHERE `batchid` = ?");
        $getbatch->bindParam(1, $batchid);
        $getbatch->execute();
        $totalstudent = $getbatch->rowCount();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        if ($sql->rowCount() > 0) {

            $Sno = 1;
            foreach ($result  as $row) {
                $date = $row["lecturedate"];
                $getbatch = $this->conn->prepare("SELECT * FROM `studentabsent` WHERE `subjectid` = ? && `semesterid` = ?  && `markdate` = ? ");
                $getbatch->bindParam(1, $getsubjectid);
                $getbatch->bindParam(2, $getsemeterid);
                $getbatch->bindParam(3, $date);
                $getbatch->execute();
                $countabsent = $getbatch->rowCount();
                $present = $totalstudent - $countabsent;


                $output .= " <tr>
            <td data-title='Sno'>{$Sno}
           </td>
           <td data-title='Lecture Topic'>{$row["lecturetopic"]}</td>
           <td data-title='Lecture Hour's'>{$row["lecturehour"]}</td>
           <td data-title='Lecture date'>{$row["lecturedate"]}</td><td data-title='Total Student'>{$totalstudent}</td><td data-title='Present'><a href='present?subjectid={$getsubjectid}&semesterid={$getsemeterid}&dateoflecture={$date}&lecturetopic={$row["lecturetopic"]}'>{$present}</a></td><td data-title='Absent'><a href='absent?subjectid={$getsubjectid}&semesterid={$getsemeterid}&dateoflecture={$date}&lecturetopic={$row["lecturetopic"]}'>{$countabsent}</a></td>
           <td data-title='Action'><button class='btn btn-danger' id='deletelecture' data-lecturedate='{$row['lecturedate']}'  data-semesterid='{$getsemeterid}'  data-subjectid='{$getsubjectid}'>Delete</button></td>
           </tr>";
                $Sno++;
            }
        } else {

            $output .= "<tr><td>No Lecture Found</td></tr>";
        }

        echo $output;
    }
}























if (isset($_POST['connection']) && isset($_POST['getsubjectid'])) {
    $run =  new loadlecture($_POST['getsubjectid'], $_POST['getsemesterid']);
    $run->closeConnection();
} else {
    header("Location:../../../teacherlogin.html");
}