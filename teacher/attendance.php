<?php
$getteacherid =  $_GET['teacherid'];
$getsemesterid =  $_GET['semesterid'];
$getsubjectid =  $_GET['subjectid'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Student Attendance</title>
    <style>
    .mainboxdiv {
        text-align: center;

        padding-bottom: 25px;
        padding: 10px;
        height: auto;
        width: auto;
        background-color: white;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
    }

    .attendancebutton {
        background-color: grey;
        margin: 2px;
        padding: 10px;
        border: 1px black solid;
        border-radius: 2px;
        color: white;
        font-weight: bolder;



    }

    .attendancebutton.toggled {
        background-color: red;
    }



    .modalattendance {

        margin: 10px;
        padding: 10px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
    </style>
</head>

<body>

    <div class="mainboxdiv">
        <span style="color:red;" id="message"></span>
        <label>Enter Today's Lecture Topic</label>
        <input type="text" class="form-control" id="lectureplan" placeholder="Introduction to Computer's " required>
        <input type="hidden" id="semester_hidden" value="<?php echo $getsemesterid; ?>">
        <input type="hidden" id="subject_hidden" value="<?php echo $getsubjectid; ?>">
        <label>Select Total Hours</label>
        <select id="lectureno" class="form-select" aria-label="Default select example">
            <option selected value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label>Select Today's Lecture Date</label>
        <input type="date" class="form-control" id="lecturedate" required>
        <label>Select a Mode</label>
        <select id="defaultattendance" class="form-select" aria-label="Default select example">
            <option selected value="PRESENT">PRESENT</option>
            <option value="ABSENT">ABSENT</option>
        </select>


    </div>
</body>

</html>




<?php
require_once("../coordinator/dbcon.php");
$check = $conn->prepare("SELECT * FROM `semester` WHERE semesterid = ?");
$check->bindParam(1, $getsemesterid);
$check->execute();
$checkcountsemester = $check->rowCount();
$check = $conn->prepare("SELECT * FROM `teacher` WHERE `teacherid` = ?");
$check->bindParam(1, $getteacherid);
$check->execute();
$checkcountteacher = $check->rowCount();
$check = $conn->prepare("SELECT * FROM `subject` WHERE `subjectid` = ?");
$check->bindParam(1, $getsubjectid);
$check->execute();
$checkcountsubject = $check->rowCount();
if ($checkcountsemester > 0 && $checkcountteacher > 0 && $checkcountsubject > 0) {

    $sql = $conn->prepare("SELECT * FROM `semester` WHERE `semesterid` = ? ");
    $sql->bindParam(1, $getsemesterid);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $rows) {
        $newbatchid = $rows['batchid'];
        break;
    }
    $sql = $conn->prepare("SELECT *  FROM `student` WHERE `batchid` = ? ");
    $sql->bindParam(1, $newbatchid);
    $sql->execute();
    $resultnew = $sql->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class='modalattendance'>";
    foreach ($resultnew as $row) {
        $my_array1 = str_split($row['studentid']);
        $length = count($my_array1);
        $name = $my_array1[$length - 2];
        $name .= $my_array1[$length - 1];

?>

<label class="attendancebutton"> <?php echo $name; ?>
    <input type="checkbox" id='checkbox1' value="<?php echo $row['studentid']; ?>">

</label>

<?php

        unset($my_array1);
    }
    echo "</div>";
} else {
    //bothe par not found
    header("Location:../teacher/teacherlogin.html");
}
?>
<div class="text-center"><button class="btn btn-primary" id="sendattendance">Submit</button></div>


<script>
$(document).ready(function() {

    $("#defaultattendance").on("change", function() {
        var value = $("#defaultattendance").val();
        if (value == "PRESENT") {
            $(".attendancebutton").css("color", "white");
            $(".attendancebutton").css("background-color", "grey");

        } else if (value == "ABSENT") {
            $(".attendancebutton").css("color", "black");
            $(".attendancebutton").css("background-color", "white");
        }


    });

    $("#sendattendance").on("click", function(event) {
        var id = [null];
        var ids = [null];
        var lectureplan = $("#lectureplan").val().trim();
        var lecturedate = $("#lecturedate").val();
        var lectureno = $("#lectureno").val();
        var defaultplan = $("#defaultattendance").val();
        var semesterid = $("#semester_hidden").val();
        var subjectid = $("#subject_hidden").val();
        if (lecturedate == "" || lectureplan == "" || defaultplan == "" || lectureno == "") {
            $("#message").html("* All field are required");

        } else {
            $("#message").html("");
            $(":checkbox:not(:checked)").each(function(key) {
                ids[key] = $(this).val();

            });
            $(":checkbox:checked").each(function(key) {
                id[key] = $(this).val();

            });

            if (defaultplan == "PRESENT") {
                markattendance(semesterid, lecturedate, defaultplan, lectureplan, id, subjectid,
                    lectureno);
            } else if (defaultplan == "ABSENT") {
                markattendance(semesterid, lecturedate, defaultplan, lectureplan, ids, subjectid,
                    lectureno);
            }


        }





    });

    $(document).on("click", "#checkbox1", function() {
        if ($(this).is(':checked')) {
            $(this).parent().css("background-color", 'red');
        } else {
            var value = $("#defaultattendance").val();
            if (value == "ABSENT") {
                $(this).parent().css("background-color", 'white');
            } else {
                $(this).parent().css("background-color", 'grey');
            }

        }


    });




    function markattendance(semesterid, lecturedate, defaultplan, lectureplan, id, subjectid, lectureno) {
        $.ajax({
            url: "senddata/sendattendance.php",
            type: "POST",
            beforeSend: function() {
                $("#sendattendance").html("wait...");
            },
            data: {
                getid: id,
                getsemesterid: semesterid,
                getsubjectid: subjectid,
                getdefaultplan: defaultplan,
                getlectureplan: lectureplan,
                getlecturedate: lecturedate,
                getlectureno: lectureno,
                connection: true
            },
            success: function(data) {

                if (data == 3) {
                    swal("Good job!", "Attendance Recored Sucessfully! ", "success");
                    $("#sendattendance").html("Submited");
                    document.getElementById("lectureplan").value = "";
                    $("#sendattendance").prop("disabled", true);


                } else if (data == 2) {
                    swal("ohoho!",
                        "Something went wrong ! try again ",
                        "error");
                    $("#sendattendance").html("Submit");

                } else if (data == 4) {
                    swal("ohoho!",
                        "Attendance with this date already exits ! try with different date ",
                        "error");
                    $("#sendattendance").html("Submit");

                } else {
                    swal("ohoho!",
                        "Something went wrong. try again",
                        "error");
                    $("#sendattendance").html("Submit");
                }
            }




        });

    }



});
</script>