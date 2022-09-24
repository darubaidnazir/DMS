<?php
session_start();
if (!isset($_SESSION['active']) || !isset($_SESSION['teacheruserid'])) {
    header("Location:../teacher/teacherlogin.html");
    exit();
}
if (!isset($_POST['lecturetopic']) || !isset($_POST['dateoflecture']) || !isset($_POST['semesterid']) || !isset($_POST['subjectid'])) {
    header("Location:../teacher/teacherlogin.html");
    exit();
}
require_once("../coordinator/dbcon.php");

$check = $conn->prepare("SELECT * FROM `subject` WHERE `subjectid` = ?");
$check->bindParam(1, $_POST['subjectid']);
$check->execute();
$countsubject  = $check->rowCount();
$check = $conn->prepare("SELECT * FROM `lectureplan` WHERE `subjectid` = ? && `semesterid` = ? && `lecturedate` = ?");
$check->bindParam(1, $_POST['subjectid']);
$check->bindParam(2, $_POST['semesterid']);
$check->bindParam(3, $_POST['dateoflecture']);
$check->execute();
$countdate  = $check->rowCount();
$check = $conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ?");
$check->bindParam(1, $_POST['semesterid']);
$check->execute();
$countsemester  = $check->rowCount();
$result = $check->fetchAll(PDO::FETCH_ASSOC);
$batchid = "";
foreach ($result as $row) {
    $batchid = $row['batchid'];
    break;
}

if ($countsemester == 0 ||  $countsubject == 0  || $countdate == 0) {
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
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
    <div><button id='godashboard' class='btn btn-dark' type="button">Dashboard</button></div>

    <div class="text-center">
        <h1>Absent Student's</h1>
        <p class="caption">Topic: <?php echo $_POST['lecturetopic']; ?><br>
            Date:
            <?php echo $_POST['dateoflecture']; ?></p>
        <div class="text-center" style="margin:5px;">

            <input type="text" id="seachstudent" class="form-control form-input" placeholder="Search anything...">

        </div>
        <main class="mainclass">
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
                <tbody id="absentone">
                    <?php
                    $getbatch = $conn->prepare("SELECT * FROM `student` WHERE `batchid` = ?");
                    $getbatch->bindParam(1, $batchid);
                    $getbatch->execute();
                    $result = $getbatch->fetchAll(PDO::FETCH_ASSOC);
                    $Sno = 1;
                    foreach ($result as $row) {
                        $getbatch = $conn->prepare("SELECT * FROM `studentabsent` WHERE `subjectid` = ? && `semesterid` = ?  && `markdate` = ? && `studentid`  =?");
                        $getbatch->bindParam(1, $_POST['subjectid']);
                        $getbatch->bindParam(2,  $_POST['semesterid']);
                        $getbatch->bindParam(3,  $_POST['dateoflecture']);
                        $getbatch->bindParam(4,  $row['studentid']);
                        $getbatch->execute();
                        if ($getbatch->rowCount() > 0) {


                    ?>
                    <tr>
                        <td data-title='S.No'><?php echo $Sno; ?></td>
                        <td data-title='Student Roll No'><?php echo $row['studentrollno']; ?></td>
                        <td data-title='Student Name'><?php echo $row['studentemail']; ?></td>
                    </tr>
                    <?php
                            $Sno++;
                        } else {
                        }
                    }
                    ?>

                </tbody>

            </table>
        </main>
    </div>
</body>

</html>
<?php
$conn = null;
?>
<script>
$(document).ready(function() {
    $("#seachstudent").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#absentone tr").filter(function() {
            $(this).toggle($(this).text()
                .toLowerCase().indexOf(value) > -1)
        });
    });
    $("#godashboard").on("click", function() {
        $("body").load("../teacher/dashboard.php", {
            reload_the_dashboard: true
        });

    });
});
</script>