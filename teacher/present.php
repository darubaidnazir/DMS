<?php
if (!isset($_GET['lecturetopic']) || !isset($_GET['dateoflecture']) || !isset($_GET['semesterid']) || !isset($_GET['subjectid'])) {
    header("Location:../teacher/teacherlogin.html");
    exit();
}
require_once("../coordinator/dbcon.php");

$check = $conn->prepare("SELECT * FROM `subject` WHERE `subjectid` = ?");
$check->bindParam(1, $_GET['subjectid']);
$check->execute();
$countsubject  = $check->rowCount();
$check = $conn->prepare("SELECT * FROM `lectureplan` WHERE `subjectid` = ? && `semesterid` = ? && `lecturedate` = ?");
$check->bindParam(1, $_GET['subjectid']);
$check->bindParam(2, $_GET['semesterid']);
$check->bindParam(3, $_GET['dateoflecture']);
$check->execute();
$countdate  = $check->rowCount();
$check = $conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ?");
$check->bindParam(1, $_GET['semesterid']);
$check->execute();
$countsemester  = $check->rowCount();
$result = $check->fetchAll(PDO::FETCH_ASSOC);
$batchid = "";
foreach ($result as $row) {
    $batchid = $row['batchid'];
    break;
}

if ($countsemester == 0 ||  $countsubject == 0 || $countdate == 0) {
    header("Location:../teacher/teacherlogin.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Present Students</title>
    <link rel="stylesheet" href="../coordinator/table.css" />
    <style>
    p {
        font: 1.4rem molot;

        color: black;
        font-weight: bold;
    }

    .maintable {
        max-height: 700px;
        overflow-y: scroll;
        padding: 10px;
        margin: 5px;
        box-shadow: rgb(0 0 0 / 25%) 0px 54px 55px, rgb(0 0 0 / 12%) 0px -12px 30px, rgb(0 0 0 / 12%) 0px 4px 6px, rgb(0 0 0 / 17%) 0px 12px 13px, rgb(0 0 0 / 9%) 0px -3px 5px;
    }

    .caption {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px, rgb(51, 51, 51) 0px 0px 0px 3px;
    }
    </style>
</head>

<body>
    <div class="text-center">
        <h1>Present Student's</h1>
        <p class="caption">Topic: <?php echo $_GET['lecturetopic']; ?><br>
            Date:
            <?php echo $_GET['dateoflecture']; ?></p>
        <main class="maintable">
            <h3 style="color:green; text-align:center;font-weight:bolder">List of Student's Present</h3>
            <table>
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Student Roll NO</th>
                        <th>Student Name</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="3"></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $getbatch = $conn->prepare("SELECT * FROM `student` WHERE `batchid` = ?");
                    $getbatch->bindParam(1, $batchid);
                    $getbatch->execute();
                    $result = $getbatch->fetchAll(PDO::FETCH_ASSOC);
                    $Sno = 1;
                    foreach ($result as $row) {
                        $getbatch = $conn->prepare("SELECT * FROM `studentabsent` WHERE `subjectid` = ? && `semesterid` = ?  && `markdate` = ? && `studentid`  =?");
                        $getbatch->bindParam(1, $_GET['subjectid']);
                        $getbatch->bindParam(2,  $_GET['semesterid']);
                        $getbatch->bindParam(3,  $_GET['dateoflecture']);
                        $getbatch->bindParam(4,  $row['studentid']);
                        $getbatch->execute();
                        if ($getbatch->rowCount() > 0) {
                        } else {

                    ?>
                    <tr>
                        <td data-title='S.No'><?php echo $Sno; ?></td>
                        <td data-title='Student Roll No'><?php echo $row['studentrollno']; ?></td>
                        <td data-title='Student Name'><?php echo $row['studentemail']; ?></td>
                    </tr>
                    <?php
                            $Sno++;
                        }
                    }
                    ?>

                </tbody>

            </table>
        </main>
    </div>
</body>

</html>