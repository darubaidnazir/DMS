<?php
session_start();
if (!isset($_SESSION['active']) || !isset($_GET['teacherid']) ||  !isset($_GET['semesterid']) ||  !isset($_GET['subjectid'])) {
    header("Location:../teacher/teacherlogin.html");
    exit();
}
require_once("../coordinator/dbcon.php");
$getteacherid =  $_GET['teacherid'];
$getsemesterid =  $_GET['semesterid'];
$getsubjectid =  $_GET['subjectid'];
$coo = $_SESSION['$coordinatorinfo'];
$check = $conn->prepare("SELECT * FROM `subject` WHERE subjectid = ? && `coordinatorid`= ?");
$check->bindParam(1, $getsubjectid);
$check->bindParam(2, $coo);
$check->execute();
$checkcountsemestercoo = $check->rowCount();
if ($checkcountsemestercoo != 1) {
    session_destroy();
    header("../teacher/teacherlogin.html");
    exit();
}
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

        width: 367px;
        margin: 0 auto;
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
        <p>
        <h3 class="text-center" style="text-align: center;color:blue;">
            <?php echo $_GET['subjectname']; ?>
        </h3>
        </p>
        <h3 style="color:red;" id="message"></h3>
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
        <label>Select Time Slot</label>


        <select id="timeslot" class="form-control">



        </select>
        <lable>Select Group</lable>
        <select id="group_batch" class="form-control">
            <option selected value="0"> Select a Group</option>
            <option value="G1">G1</option>
            <option value="G2">G2</option>
            <option value="BOTH">G1 & G2</option>


        </select>

        <label>Select a Mode</label>
        <select id="defaultattendance" class="form-select" aria-label="Default select example">
            <option selected value="PRESENT">PRESENT</option>
            <option value="ABSENT">ABSENT</option>
        </select>


    </div>
</body>

</html>

<div class='modalattendance' id='modalattendance1'>
</div>
<div class="text-center"><button class="btn btn-primary" id="sendattendance">Submit</button></div>


<script type="text/javascript">
$("#lectureno").on('change', function() {
    $('#timeslot').prop('selectedIndex', 0);

});
$("#group_batch").prop("disabled", true);
$("#lecturedate").on("change", function() {
    $('#timeslot').prop('selectedIndex', 0);
    $('#group_batch').prop('selectedIndex', 0);
    $("#sendattendance").prop("disabled", true);
    $("#timeslot").prop("disabled", false);
    var date = $(this).val();

    $.ajax({
        url: "loadData/loadtimeslot.php",
        type: "POST",
        data: {
            connection: true,
            getdate: date
        },
        success: function(data) {

            if (data == 5) {
                swal("ohoho!",
                    "Attendance Should be Performed Within 3 Days",
                    "error");
                $("#sendattendance").prop("disabled", true);
            }
            $("#timeslot").html(data);



        }
    });
});
$("#timeslot").on("change", function() {
    $('#group_batch').prop('selectedIndex', 0);
    var time = $(this).val();
    var hour = $("#lectureno").val();
    var date = $("#lecturedate").val();
    var semesterid = $("#semester_hidden").val();


    $.ajax({
        url: "loadData/checktime.php",
        type: "POST",
        data: {
            connection: true,
            gettime: time,
            gethour: hour,
            getdate: date,
            getsemesterid: semesterid
        },
        success: function(data) {

            if (data == 3) {

                $("#group_batch").prop("disabled", false);
            } else if (data == 1) {
                swal("ohoho!",
                    "Change the Time Slot! This Slot is Already Taken for this day",
                    "error");
                $("#sendattendance").prop("disabled", true);
            } else {
                swal("ohoho!",
                    "Something went wrong ! try again ",
                    "error");
                $("#sendattendance").prop("disabled", true);
            }

        }
    });
    $("#group_batch").on("change", function() {
        var group_id = $(this).val();
        if (group_id == "G1" || group_id == "G2" || group_id == "BOTH") {
            group_load(group_id);
            $("#message").html("");

        } else {
            $("#message").html("*Select a Group to Show Student's");
            $("#sendattendance").prop("disabled", true);

        }

    });


    function group_load(group) {

        var semesterid = <?php echo $_GET['semesterid']; ?>;
        $.ajax({
            url: "../teacher/loaddata/getsem.php",
            type: "POST",
            data: {
                group: group,
                connection: true,
                semesterid: semesterid
            },
            success: function(data) {
                if (data == 1) {
                    $("#sendattendance").prop("disabled", true);
                } else {
                    $("#modalattendance1").html(data);
                    $("#sendattendance").prop("disabled", false);
                }


            }

        });

    }






});
</script>
<script>
$(document).ready(function() {


    $("#sendattendance").prop("disabled", true);
    $("#timeslot").prop("disabled", true);
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
        var timeslot = $("#timeslot").val();
        if (lecturedate == "" || lectureplan == "" || defaultplan == "" || lectureno == "" ||
            timeslot == "" || timeslot == 0) {
            $("#message").html("");
            $("#message").html("* All field are required. Empty field's are not allowed");

        } else if (!/^[a-zA-Z-0-9\s.,]+$/.test(lectureplan)) {
            $("#message").html("");
            $("#message").html(
                "* Please enter a valid Lecture Topic. No special character is allowed.");

        } else if (lectureno > 5 || lectureno < 1) {
            $("#message").html("");
            $("#message").html(
                "*Lecture Hour Must be From 1 to 5 only.");

        } else {
            $("#message").html("");
            $(":checkbox:not(:checked)").each(function(key) {
                ids[key] = $(this).val();

            });
            $(":checkbox:checked").each(function(key) {
                id[key] = $(this).val();

            });
            swal({
                    title: "Are you sure?",
                    text: "Attendance will be recorded!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        if (defaultplan === "PRESENT") {
                            markattendance(semesterid, lecturedate, defaultplan, lectureplan, id,
                                subjectid,
                                lectureno, timeslot);
                        } else if (defaultplan === "ABSENT") {
                            markattendance(semesterid, lecturedate, defaultplan, lectureplan, ids,
                                subjectid,
                                lectureno, timeslot);
                        }
                    } else {
                        swal("Attendance not recorded!");
                    }
                });




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




    function markattendance(semesterid, lecturedate, defaultplan, lectureplan, id, subjectid, lectureno,
        timeslot) {
        var group = $("#group_batch").val();
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
                connection: true,
                gettimeslot: timeslot,
                group: group
            },
            success: function(data) {

                if (data == 3) {
                    swal("Good job!", "Attendance Recored Sucessfully! ", "success");
                    $("#sendattendance").html("Submited");
                    document.getElementById("lectureplan").value = "";
                    $("#sendattendance").prop("disabled", true);
                    $("#sendattendance").parent().html("<a href='dashboard'>Go to Dashboard</a>");


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

                } else if (data == 9) {
                    swal("ohoho!",
                        "Time Slot is already taken! Try with different slot",
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

<?php
$conn = null;
?>