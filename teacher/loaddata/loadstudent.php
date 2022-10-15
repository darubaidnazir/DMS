<?php
require_once("../../coordinator/inner/db_connection.php");

class loadstudent extends db_connection

{


    function __construct($getsubjectid, $getsemeterid, $getper)
    {

        parent::__construct();
        $accesslevel = 0;
        if (!isset($_POST['accesslevel'])) {
            $accesslevel = 1;
        }
        if ($accesslevel == 0) {


            $getbatchid = $this->conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ?");
            $getbatchid->bindParam(1, $getsemeterid);
            $getbatchid->execute();
            $fetch = $getbatchid->fetchAll(PDO::FETCH_ASSOC);
            $batchid = "";
            foreach ($fetch as $some) {
                $batchid = $some["batchid"];
                break;
            }
            $getbatchid = $this->conn->prepare("SELECT * FROM `subject` WHERE `subjectid` = ?");
            $getbatchid->bindParam(1, $getsubjectid);
            $getbatchid->execute();
            $fetch = $getbatchid->fetchAll(PDO::FETCH_ASSOC);

            foreach ($fetch as $some) {
                $subjectlevel = $some["subjectlevel"];
                break;
            }
            if ($subjectlevel == "T") {
                $getallstudent = $this->conn->prepare("SELECT * FROM `student` WHERE `batchid` = ? ORDER BY `studentrollno` ASC");
                $getallstudent->bindParam(1, $batchid);
                $getallstudent->execute();
                if ($getallstudent->rowCount() == 0) {
                    $output = "";
                } else {

                    $output = "";
                }
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
                    $newsql = $this->conn->prepare("SELECT * FROM `extraattendance` WHERE studentid = ? and semesterid = ?");
                    $newsql->bindParam(1, $row['studentid']);
                    $newsql->bindParam(2, $getsemeterid);
                    $newsql->execute();
                    $getpercentage = $newsql->fetchAll(PDO::FETCH_ASSOC);
                    $Extrapercentage = 0;
                    foreach ($getpercentage as $marks) {
                        $Extrapercentage = $marks['percentage'];
                        break;
                    }
                    $percentage = $percentage +  (int) $Extrapercentage;
                    if ($percentage > 100) {
                        $percentage = 100;
                    }


                    $output .= "<tr>
            <td data-title='Sno'>{$Sno}
           </td>
           <td data-title='Student Roll no'>{$row["studentemail"]}</td>
           <td data-title='Student Name   '>{$row["studentname"]}</td>
           <td data-title='Total Class   '>{$totalclass}</td>
           <td data-title='Present'>{$presentcount}</td>
           <td data-title='Absent'>{$absentcount}</td><td data-title='Extra Percentage'>{$Extrapercentage}%</td><td data-title=' Total Percentage'>{$percentage}%</td>";

                    $output .= "  <td data-title='Update Attendance'> <button type='button' class='btn btn-success btn-sm  clickbutton'
                data-bs-toggle='modal' data-bs-target='#updateattendnce' id='clickonupdate' data-studentid='{$row['studentid']}' data-semesterid='{$getsemeterid}' data-subjectid='{$getsubjectid}'>
                Update
            </button></td>
                </tr>";

                    $Sno++;
                }


                echo $output;
            } else {
                $group = array("G1", "G2");
                for ($i = 0; $i <= 1; $i++) {
                    $gropus = "BOTH";
                    $getallstudent = $this->conn->prepare("SELECT * FROM `student` WHERE `batchid` = ? && group_id = ?");
                    $getallstudent->bindParam(1, $batchid);
                    $getallstudent->bindParam(2, $group[$i]);
                    $getallstudent->execute();
                    if ($i == 0) {
                        if ($getallstudent->rowCount() == 0) {
                            $output = "";
                        } else {

                            $output = "";
                        }
                    } else {
                    }
                    $fetchallstudent = $getallstudent->fetchAll(PDO::FETCH_ASSOC);
                    $Sno = 1;
                    $totalclasssql = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE  `subjectid` = ? && `semesterid` = ? && groups = ? UNION SELECT * FROM `lectureplan` WHERE  `subjectid` = ? && `semesterid` = ? && groups =? ");
                    $totalclasssql->bindParam(1, $getsubjectid);
                    $totalclasssql->bindParam(2, $getsemeterid);
                    $totalclasssql->bindParam(3, $group[$i]);
                    $totalclasssql->bindParam(4, $getsubjectid);
                    $totalclasssql->bindParam(5, $getsemeterid);
                    $totalclasssql->bindParam(6, $gropus);
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
                        $newsql = $this->conn->prepare("SELECT * FROM `extraattendance` WHERE studentid = ? and semesterid = ?");
                        $newsql->bindParam(1, $row['studentid']);
                        $newsql->bindParam(2, $getsemeterid);
                        $newsql->execute();
                        $getpercentage = $newsql->fetchAll(PDO::FETCH_ASSOC);
                        $Extrapercentage = 0;
                        foreach ($getpercentage as $marks) {
                            $Extrapercentage = $marks['percentage'];
                            break;
                        }
                        $percentage = $percentage +  (int) $Extrapercentage;
                        if ($percentage > 100) {
                            $percentage = 100;
                        }



                        $output .= "<tr>
            <td data-title='Sno'>{$Sno}
           </td>
           <td data-title='Student Roll no'>{$row["studentemail"]}</td>
           <td data-title='Student Name   '>{$row["studentname"]}</td>
           <td data-title='Total Class   '>{$totalclass}</td>
           <td data-title='Present'>{$presentcount}</td>
           <td data-title='Absent'>{$absentcount}</td><td data-title='Extra Percentage'>{$Extrapercentage}%</td><td data-title='Total Percentage'>{$percentage}%</td>
          ";

                        $output .= "  <td data-title='Update Attendance'> <button type='button' class='btn btn-success clickbutton'
                data-bs-toggle='modal' data-bs-target='#updateattendnce' id='clickonupdate' data-studentid='{$row['studentid']}' data-semesterid='{$getsemeterid}' data-subjectid='{$getsubjectid}'>
                Update
            </button></td>
                </tr>";

                        $Sno++;
                    }
                }
                echo $output;
            }
        } else if ($accesslevel == 1) {

            $getbatchid = $this->conn->prepare("SELECT * FROM `subject` WHERE `subjectid` = ?");
            $getbatchid->bindParam(1, $getsubjectid);
            $getbatchid->execute();
            $fetch = $getbatchid->fetchAll(PDO::FETCH_ASSOC);

            foreach ($fetch as $some) {
                $subjectlevel = $some["subjectlevel"];
                break;
            }
            if ($subjectlevel == "L") {
                $getbatchid = $this->conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ?");
                $getbatchid->bindParam(1, $getsemeterid);
                $getbatchid->execute();
                $fetch = $getbatchid->fetchAll(PDO::FETCH_ASSOC);
                $batchid = "";
                foreach ($fetch as $some) {
                    $batchid = $some["batchid"];
                    break;
                }
                $group = array("G1", "G2");
                for ($i = 0; $i <= 1; $i++) {
                    $groups = "BOTH";
                    $getallstudent = $this->conn->prepare("SELECT * FROM `student` WHERE `batchid` = ? && group_id = ?");
                    $getallstudent->bindParam(1, $batchid);
                    $getallstudent->bindParam(2, $group[$i]);
                    $getallstudent->execute();
                    if ($i == 0) {

                        if ($getallstudent->rowCount() == 0) {
                            $output = "";
                        } else {
                            if ($accesslevel == 0) {
                                $output = "";
                            } else {
                                $output = "<tr><td></td><td></td> <td></td><td></td><td></td><td></td><td></td><td><button class='btn btn-primary' id='requestupdatebox' data-semesterid='{$getsemeterid}' data-subjectid='{$getsubjectid}'>Request</button></td></tr>";
                            }
                        }
                    } else {
                    }
                    $fetchallstudent = $getallstudent->fetchAll(PDO::FETCH_ASSOC);
                    $Sno = 1;
                    $totalclasssql = $this->conn->prepare("SELECT * FROM `lectureplan` WHERE  `subjectid` = ? && `semesterid` = ? && groups = ? UNION SELECT * FROM `lectureplan` WHERE  `subjectid` = ? && `semesterid` = ? && groups =? ");
                    $totalclasssql->bindParam(1, $getsubjectid);
                    $totalclasssql->bindParam(2, $getsemeterid);
                    $totalclasssql->bindParam(3, $group[$i]);
                    $totalclasssql->bindParam(4, $getsubjectid);
                    $totalclasssql->bindParam(5, $getsemeterid);
                    $totalclasssql->bindParam(6, $groups);
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
                        $newsql = $this->conn->prepare("SELECT * FROM `extraattendance` WHERE studentid = ? and semesterid = ?");
                        $newsql->bindParam(1, $row['studentid']);
                        $newsql->bindParam(2, $getsemeterid);
                        $newsql->execute();
                        $getpercentage = $newsql->fetchAll(PDO::FETCH_ASSOC);
                        $Extrapercentage = 0;
                        foreach ($getpercentage as $marks) {
                            $Extrapercentage = $marks['percentage'];
                            break;
                        }
                        $percentage = $percentage +  (int) $Extrapercentage;
                        if ($percentage > 100) {
                            $percentage = 100;
                        }


                        $output .= "
            <td data-title='Sno'>{$Sno}
           </td>
           <td data-title='Student Roll no'>{$row["studentemail"]}</td>
           <td data-title='Student Name   '>{$row["studentname"]}</td>
           <td data-title='Total Class   '>{$totalclass}</td>
           <td data-title='Present'>{$presentcount}</td>
           <td data-title='Absent'>{$absentcount}</td> <td data-title='Extra Percentage'>{$Extrapercentage}%</td><td data-title='Total Percentage'>{$percentage}%</td>";
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
                }
                echo $output;
            } else {
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
                if ($getallstudent->rowCount() == 0) {
                    $output = "";
                } else {
                    if ($accesslevel == 0) {
                        $output = "";
                    } else {
                        $output = "<tr><td></td><td></td> <td></td><td></td><td></td><td></td><td></td><td><button class='btn btn-primary' id='requestupdatebox' data-semesterid='{$getsemeterid}' data-subjectid='{$getsubjectid}'>Request</button></td></tr>";
                    }
                }
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
                    $newsql = $this->conn->prepare("SELECT * FROM `extraattendance` WHERE studentid = ? and semesterid = ?");
                    $newsql->bindParam(1, $row['studentid']);
                    $newsql->bindParam(2, $getsemeterid);
                    $newsql->execute();
                    $getpercentage = $newsql->fetchAll(PDO::FETCH_ASSOC);
                    $Extrapercentage = 0;
                    foreach ($getpercentage as $marks) {
                        $Extrapercentage = $marks['percentage'];
                        break;
                    }
                    $percentage = $percentage +  (int) $Extrapercentage;
                    if ($percentage > 100) {
                        $percentage = 100;
                    }

                    $output .= "
            <td data-title='Sno'>{$Sno}
           </td>
           <td data-title='Student Roll no'>{$row["studentemail"]}</td>
           <td data-title='Student Name   '>{$row["studentname"]}</td>
           <td data-title='Total Class   '>{$totalclass}</td>
           <td data-title='Present'>{$presentcount}</td>
           <td data-title='Absent'>{$absentcount}</td><td data-title='Extra Percentage'>{$Extrapercentage}%</td><td data-title=' Total Percentage'>{$percentage}%</td>";
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
    }
}



if (isset($_POST['connection']) && isset($_POST['getsubjectid'])) {
    $run =  new loadstudent($_POST['getsubjectid'], $_POST['getsemesterid'], $_POST['getper']);
    $run->closeConnection();
} else {
    header("Location:../../../teacherlogin.html");
}