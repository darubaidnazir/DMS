<?php
require_once("../../coordinator/inner/db_connection.php");

class loadstudent extends db_connection

{


    function __construct($getsubjectid, $getsemeterid)
    {
        parent::__construct();
        $output = "";
        $getbatchid = $this->conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ?");
        $getbatchid->bindParam(1, $getsemeterid);
        $getbatchid->execute();
        $fetch = $getbatchid->fetchAll(PDO::FETCH_ASSOC);
        $batchid = "";
        foreach ($fetch as $some) {
            $batchid = $some["batchid"];
            break;
        }
        $getallstudent = $this->conn->prepare("SELECT * FROM `student` WHERE `batchid` = ?");
        $getallstudent->bindParam(1, $batchid);
        $getallstudent->execute();
        $fetchallstudent = $getallstudent->fetchAll(PDO::FETCH_ASSOC);
        $Sno = 1;
        $totalclasssql = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE  `subjectid` = ? && `semesterid` = ?");
        $totalclasssql->bindParam(1, $getsubjectid);
        $totalclasssql->bindParam(2, $getsemeterid);
        $totalclasssql->execute();
        $fetchclass = $totalclasssql->fetchAll(PDO::FETCH_ASSOC);
        $totalclass = 0;



        foreach ($fetchclass as $countclass) {

            $totalclass = $totalclass + $countclass['lecturehour'];
        }

        foreach ($fetchallstudent as $row) {
            $findabsent = $this->conn->prepare("SELECT * FROM `studentabsent` WHERE `studentid`= ? && `subjectid` = ?  && `semesterid` = ?");
            $findabsent->bindParam(1, $row['studentid']);
            $findabsent->bindParam(2, $getsubjectid);
            $findabsent->bindParam(3, $getsemeterid);
            $findabsent->execute();
            $absentcount = $findabsent->rowCount();



            $presentcount = $totalclass - $absentcount;
            if ($totalclass == 0) {
                $percentage = 0;
            } else {
                $percentage = ceil($presentcount / $totalclass * 100);
            }

            $output .= " <tr>
            <td data-title='Sno'>{$Sno}
           </td>
           <td data-title='Student Roll no'>{$row["studentemail"]}</td>
           <td data-title='Student Name   '>{$row["studentname"]}</td>
           <td data-title='Total Class   '>{$totalclass}</td>
           <td data-title='Present'>{$presentcount}</td>
           <td data-title='Absent'>{$absentcount}</td><td data-title='Percentage'>{$percentage}%</td></tr>";
            $Sno++;
        }


        echo $output;
    }
}



if (isset($_POST['connection']) && isset($_POST['getsubjectid'])) {
    $run =  new loadstudent($_POST['getsubjectid'], $_POST['getsemesterid']);
    $run->closeConnection();
} else {
    header("Location:../../../teacherlogin.html");
}