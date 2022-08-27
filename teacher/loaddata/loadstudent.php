<?php
require_once("../../coordinator/inner/db_connection.php");

class loadstudent extends db_connection

{


    function __construct($getsubjectid, $getsemeterid, $getper)
    {
        parent::__construct();
        $output = "<tr><td></td><td></td> <td></td><td></td><td></td><td></td><td></td><td><button class='btn btn-primary' id='requestupdatebox' data-semesterid='{$getsemeterid}' data-subjectid='{$getsubjectid}'>Request</button></td></tr>";
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
            $fetchasbsentcount = $findabsent->fetchAll(PDO::FETCH_ASSOC);
            $absentcount = 0;
            foreach ($fetchasbsentcount  as $somecount) {
                $absentcount = $absentcount + $somecount['lecturehour'];
            }





            $presentcount = $totalclass - $absentcount;
            if ($totalclass == 0) {
                $percentage = 0;
            } else {
                $percentage = ceil($presentcount / $totalclass * 100);
            }

            $output .= " <tr> <td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr> <tr>
            <td data-title='Sno'>{$Sno}
           </td>
           <td data-title='Student Roll no'>{$row["studentemail"]}</td>
           <td data-title='Student Name   '>{$row["studentname"]}</td>
           <td data-title='Total Class   '>{$totalclass}</td>
           <td data-title='Present'>{$presentcount}</td>
           <td data-title='Absent'>{$absentcount}</td><td data-title='Percentage'>{$percentage}%</td>";
            if ($getper == 1) {
                $output .= "  <td data-title='Update Attendance'> <button type='button' class='btn btn-success clickbutton'
                data-bs-toggle='modal' data-bs-target='#updateattendnce' id='clickonupdate' data-studentid='{$row['studentid']}' data-semesterid='{$getsemeterid}' data-subjectid='{$getsubjectid}'>
                Update
            </button></td>
                </tr>";
            } else {
                $output .= "
           <td data-title='Update Attendance'> <button type='button' disabled class='btn btn-success clickbutton'
           data-bs-toggle='modal' data-bs-target='#updateattendnce' id='clickonupdate' data-studentid='{$row['studentid']}' data-semesterid='{$getsemeterid}' data-subjectid='{$getsubjectid}'>
           Update
       </button></td>
           </tr>";
            }
            $Sno++;
        }


        echo $output;
    }
}



if (isset($_POST['connection']) && isset($_POST['getsubjectid'])) {
    $run =  new loadstudent($_POST['getsubjectid'], $_POST['getsemesterid'], $_POST['getper']);
    $run->closeConnection();
} else {
    header("Location:../../../teacherlogin.html");
}