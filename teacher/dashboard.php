<?php

session_start();
if (!isset($_SESSION['active']) || !isset($_SESSION['teacheruserid'])) {
    header("Location:../teacher/teacherlogin.html");
    exit();
}
if (isset($_POST['reload_the_dashboard']) && $_POST['reload_the_dashboard'] == true) {
    unset($_POST['reload_the_dashboard']);
    echo '<script>location.reload();</script>';
}
$teacherid = $_SESSION['teacheruserid'];
require_once("../coordinator/dbcon.php");

$get = $conn->prepare("SELECT * FROM `teacher` WHERE `teacherid` = ?");
$get->bindParam(1, $teacherid);
$get->execute();
$result = $get->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $getid) {
    $coordinatorinfo = $getid['coordinatorid'];
    break;
}
$_SESSION['$coordinatorinfo'] = $coordinatorinfo;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS only -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="../coordinator/table.css" />
    <link rel="stylesheet" href="../coordinator/dash.css" />
    <link rel="stylesheet" href="../coordinator/mainboard.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Teacher Dashboard</title>
</head>
<style>
#addstudentrecordsection {
    display: none;
}

.tag-wrap {
    filter: drop-shadow(-1px 6px 3px rgba(50, 50, 0, 0.5));
}

.tag {
    background: #FB8C00;
    color: white;
    padding: 1rem 2rem 1rem 2rem;
    font: bold 20px system-ui;
    clip-path: polygon(30px 0%, 100% 0%, 100% 100%, 30px 100%, 0 50%);
}

@media screen and (max-width: 767px) {
    .tag {
        display: none;
    }
}
</style>

<body>

    <?php
    require_once("../coordinator/svg.php");
    ?>
    <header class="page-header">
        <nav>
            <a href="#0" aria-label="forecastr logo" class="logo"> </a>
            <img src="../image/logo.png" width="50" height="50" alt />
            <button class="toggle-mob-menu" aria-expanded="false" aria-label="open menu">
                <svg width="20" height="20" aria-hidden="true">
                    <use xlink:href="#down"></use>
                </svg>

            </button>
            <ul class="admin-menu">
                <li class="menu-heading">
                    <h3>Teacher</h3>
                </li>
                <li>
                    <a href="#DashBoard Teacher">
                        <svg>
                            <use xlink:href="#home"></use>
                        </svg>
                        <span class="maindashbutton"> Home</span>
                    </a>
                </li>
                <li>
                    <a href="#Lecture Details">
                        <svg>
                            <use xlink:href="#pages"></use>
                        </svg>
                        <span id="addbatch" class="menu_button">Lecture Details</span>
                    </a>
                </li>
                <li>
                    <a href="#Student Record">
                        <svg>
                            <use xlink:href="#setting"></use>
                        </svg>
                        <span id="addstudentrecord" class="menu_button">Student Record</span>
                    </a>
                </li>
                <li>
                    <a href="#Student Record">
                        <svg>
                            <use xlink:href="#setting"></use>
                        </svg>
                        <span id="addpdfsectionbutton" class="menu_button">PDF Generater</span>
                    </a>
                </li>


                <li class="menu-heading">
                    <h3>Settings</h3>
                </li>

                <li>
                    <a href="#Settings">
                        <svg>
                            <use xlink:href="#setting"></use>
                        </svg>
                        <span id="addsetting" class="menu_button">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <svg>
                            <use xlink:href="#logout"></use>
                        </svg>
                        <span id="addsettingjj">Logout</span>
                    </a>
                </li>

                <li>
                    <div class="switch">
                        <input type="checkbox" id="mode" checked />
                        <label for="mode">
                            <span></span>
                            <span>Dark</span>
                        </label>
                    </div>

                </li>
            </ul>
        </nav>
    </header>
    <section class="page-content">
        <section class="search-and-user">

            <div class="admin-profile">
                <span class="greeting">Hello,

                </span>
                <span class="tag-wrap">
                    <span class="tag">
                        <?php echo $_SESSION['teacherusername'];    ?><br>

                    </span>
                </span>


            </div>
        </section>
        <form>
            <input type="hidden" id="teacher_hidden" value="<?php echo $teacherid; ?>" />
        </form>
        <section id="maindashboardsection">
            <?php require_once("../teacher/loaddata/loadactivesemester.php"); ?>


        </section>
        <section class="grid" id="addbatchsection">
            <div class="text-center maintable">
                <p>
                    <lable class="text-uppercase" style="color:blue;font-weight:bold">Select a Subject to View Lecture
                        details.</lable>
                <form method="post" action="../pdfgenerator/teacher/lecturepdf.php">
                    <select class="form-control" aria-label="Default select example" id='subjectlecture'
                        name="subjectlecture">
                        <option selected value="0">Select a Subject</option>
                        <?php
                        $sql1 = $conn->prepare("select * FROM `subject` INNER join `assignedsubject` on subject.subjectid = assignedsubject.subjectid  INNER join `semester` on assignedsubject.semesterid = semester.semesterid WHERE assignedsubject.teacherid = ? && semester.semesterstatus = 1 && assignedsubject.assignedstatus ='active'");
                        $sql1->bindParam(1, $teacherid);
                        $sql1->execute();
                        $resulttable = $sql1->fetchAll(PDO::FETCH_ASSOC);
                        $string = "";
                        foreach ($resulttable as $row) {
                            $string .=  $row['subjectname'];
                            $string .= "-";
                            $string .=  $row['subjectcode'];

                        ?>
                        <option data-city="<?php echo $row['semesterid']; ?>"
                            value="<?php echo $row['subjectid'] . ',' . $row['semesterid'] . ',' . $row['subjectname'] . ',' . $row['subjectcode'] ?>">
                            <?php echo $string; ?></option>

                        <?php
                            $string = "";
                        }
                        ?>
                    </select>
                    <input type="submit" name="subjectlecturepdf" id='subjectlecturepdf' class="btn btn-secondary"
                        style="display:none;margin:5px" Value='Generate pdf'>
                </form>
                <small id="mm" style="color:red;"></small>
                </p>
                <div class="text-center" style="margin:5px;">

                    <input type="text" id="seachlecture" class="form-control form-input"
                        placeholder="Search anything...">

                </div>
                <main>
                    <table>
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Lecture Topic</th>
                                <th>Lecture Hour</th>
                                <th>Lecture Start time</th>
                                <th>Lecture End time</th>
                                <th>Lecture Date</th>
                                <th>Total Student</th>
                                <th>Present</th>
                                <th>Absent</th>
                                <th>Action</th>



                            </tr>
                        </thead>

                        <tbody id="addlecturetable">

                        </tbody>

                    </table>
                </main>
            </div>
        </section>
        <section class="grid" id="addstudentrecordsection">
            <div class="text-center maintable">
                <p>
                    <lable class="text-uppercase" style="color:blue;font-weight:bold">Select a Subject to View Student
                        Attendnace
                        Record.</lable><br>
                    <small class="text-uppercase" style="color:red;">* Update is disabled <br>Click on the
                        below Request button to get permission</small>



                <form action='../pdfgenerator/teacher/subjectpdf.php' method='post'>
                    <select class="form-control" aria-label="Default select example" id='subjectlecture1'
                        name='pdf_generator_free'>
                        <option selected value="0">Select a Subject</option>
                        <?php
                        $sql1 = $conn->prepare("select * FROM `subject` INNER join `assignedsubject` on subject.subjectid = assignedsubject.subjectid  INNER join `semester` on assignedsubject.semesterid = semester.semesterid WHERE assignedsubject.teacherid = ? && semester.semesterstatus = 1 && assignedsubject.assignedstatus ='active'");
                        $sql1->bindParam(1, $teacherid);
                        $sql1->execute();
                        $resulttable = $sql1->fetchAll(PDO::FETCH_ASSOC);
                        $string = "";
                        foreach ($resulttable as $row) {
                            $string .=  $row['subjectname'];
                            $string .= "-";
                            $string .=  $row['subjectcode'];

                        ?>
                        <option data-permission="<?php echo $row['updatepermission']; ?>"
                            data-city="<?php echo $row['semesterid']; ?>"
                            value="<?php echo $row['semesterid'] . ',' . $row['subjectid'] . ',' . $row['subjectname'] . ',' . $row['subjectcode'] ?>">
                            <?php echo $string; ?></option>

                        <?php
                            $string = "";
                        }
                        ?>
                    </select>
                    <input type="submit" name="pdf_button" class='btn btn-secondary' id='pdf_button'
                        style='display:none;margin:5px' value='Generate pdf'>
                </form>
                <small id="mm1" style="color:red;"></small>
                </p>
                <div class="text-center" style="margin:5px;">

                    <input type="text" id="seachstudent" class="form-control form-input"
                        placeholder="Search anything...">

                </div>
                <main>

                    <table id="studenttable1">

                        <thead>

                            <tr>
                                <th>S.No</th>
                                <th>Student Roll No</th>
                                <th>Student Name</th>
                                <th>Total Class</th>
                                <th>Present </th>
                                <th>Absent</th>
                                <th>Extra Percentage</th>
                                <th>Total Percentage</th>
                                <th>Update Attendance</th>


                            </tr>
                        </thead>

                        <tbody id="addstudenttable">

                        </tbody>

                    </table>

                </main>
            </div>
        </section>


        <section class="grid" id="addsettingsection">
            <div id="some">

                <?php
                $getdate = $conn->prepare('SELECT * FROM `timeslot` WHERE `coordinatorid` = ?');
                $getdate->bindParam(1,  $coordinatorinfo);
                $getdate->execute();
                $result = $getdate->fetchAll(PDO::FETCH_ASSOC);

                ?>


                </p>
                </p>
                <p class='fw-bold text-uppercase'>Department Time Slot's</p>
                <table class='table table-success table-striped'>
                    <tr>
                        <td class='table-secondary'>Start Time</td>
                        <td class='table-secondary'>End Time</td>
                        <td class='table-secondary'>Update Day's</td>

                    </tr>
                    <tbody>

                        <tr>
                            <?php foreach ($result as $row) { ?>
                            <td class='table-primary'><?php echo $row['start']; ?></td>
                            <td class='table-secondary'><?php echo $row['end']; ?></td>
                            <td class='table-danger'><?php echo $row['updateattendance']; ?></td>
                            <?php
                                break;
                            }

                            ?>
                        </tr>
                    </tbody>
                </table>

            </div>
        </section>
        <section class="grid" id="addpdfsection">

            <div class="text-center">
                <p>
                    <lable class="text-uppercase" style="color:blue;font-weight:bold">Select a Subject to Generate PDF
                        Lecture
                    </lable>
                </p>
                <form method="post" action="../pdfgenerator/teacher/lecturepdf.php">
                    <select class="form-control" aria-label="Default select example" name="subjectlecture">
                        <option selected value="0">Select a Subject</option>
                        <?php
                        $sql1 = $conn->prepare("select * FROM `subject` INNER join `assignedsubject` on subject.subjectid = assignedsubject.subjectid  INNER join `semester` on assignedsubject.semesterid = semester.semesterid WHERE assignedsubject.teacherid = ? && semester.semesterstatus = 1 && assignedsubject.assignedstatus ='active'");
                        $sql1->bindParam(1, $teacherid);
                        $sql1->execute();
                        $resulttable = $sql1->fetchAll(PDO::FETCH_ASSOC);
                        $string = "";
                        foreach ($resulttable as $row) {
                            $string .=  $row['subjectname'];
                            $string .= "-";
                            $string .=  $row['subjectcode'];

                        ?>
                        <option data-city="<?php echo $row['semesterid']; ?>"
                            value="<?php echo $row['subjectid'] . ',' . $row['semesterid'] . ',' . $row['subjectname'] . ',' . $row['subjectcode'] ?>">
                            <?php echo $string; ?></option>

                        <?php
                            $string = "";
                        }
                        ?>
                    </select>
                    <input type="submit" name="subjectlecturepdf" class="btn btn-secondary" style='margin:5px;'
                        Value='Generate pdf'>
                </form>
            </div>
            <div class="text-center">
                <p>
                    <lable class="text-uppercase" style="color:blue;font-weight:bold">Select a Subject to Generate PDF
                        for Student
                        Attendnace
                        Record.</lable><br>




                <form action='../pdfgenerator/teacher/subjectpdf.php' method='post'>
                    <select class="form-control" aria-label="Default select example" name='pdf_generator_free'>
                        <option selected value="0">Select a Subject</option>
                        <?php
                        $sql1 = $conn->prepare("select * FROM `subject` INNER join `assignedsubject` on subject.subjectid = assignedsubject.subjectid  INNER join `semester` on assignedsubject.semesterid = semester.semesterid WHERE assignedsubject.teacherid = ? && semester.semesterstatus = 1 && assignedsubject.assignedstatus ='active'");
                        $sql1->bindParam(1, $teacherid);
                        $sql1->execute();
                        $resulttable = $sql1->fetchAll(PDO::FETCH_ASSOC);
                        $string = "";
                        foreach ($resulttable as $row) {
                            $string .=  $row['subjectname'];
                            $string .= "-";
                            $string .=  $row['subjectcode'];

                        ?>
                        <option data-permission="<?php echo $row['updatepermission']; ?>"
                            data-city="<?php echo $row['semesterid']; ?>"
                            value="<?php echo $row['semesterid'] . ',' . $row['subjectid'] . ',' . $row['subjectname'] . ',' . $row['subjectcode'] ?>">
                            <?php echo $string; ?></option>

                        <?php
                            $string = "";
                        }
                        ?>
                    </select>
                    <input type="submit" name="pdf_button" class='btn btn-secondary' style='margin:5px'
                        value='Generate pdf'>
                </form>
                <small id="mm1" style="color:red;"></small>
                </p>
            </div>
        </section>


        <div class="modal fade" id="assign-teacher" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Assigned Subject to Teacher
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body-assign-teacher m-3" id="modal-body-assign-teacher">


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="updateattendnce" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Update Attendance
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <p>
                            SELECT A DATE AND LECTURE YOU WANT TO UPDATE FOR THIS STUDENT
                            <br> <span style='color:red'>* Note update attendance can be done only once.</span>
                        </p>
                        <div>
                            <select class="form-control" id="selectdateandlecture">


                            </select>
                        </div>
                        <div id="updatedrecordofstudent">


                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>
<script src="../teacher/javascipt/dashboard.js"> </script>
<script src="../coordinator/dash.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>


<script>

</script>

<script>
$(document).ready(function() {

    $(".page-content").on("click", function() {
        $('body').removeClass('mob-menu-opened');
    });
    $("#seachstudent").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#addstudenttable tr").filter(function() {
            $(this).toggle($(this).text()
                .toLowerCase().indexOf(value) > -1)
        });
    });

    $("#seachlecture").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#addlecturetable tr").filter(function() {
            $(this).toggle($(this).text()
                .toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
<script>
$("#subjectlecture").on("change", function() {
    var value = $(this).val().split(",")[0];
    var semesterid = $(this).find(':selected').data('city');

    if (value == 0) {
        $("#subjectlecturepdf").css('display', 'none');
        $("#mm").html("* Select a Subject");

    } else {
        $("#subjectlecturepdf").css('display', 'block');
        $("#mm").html("");
        viewlecturetable(value, semesterid);

    }


});
$("#subjectlecture1").on("change", function() {
    var value = $(this).val().split(',')[1];
    var semesterid = $(this).find(':selected').data('city');
    var permission = $(this).find(':selected').data('permission');
    $("#pdf_button").css('display', 'none');

    if (value == 0 || value == undefined) {

        $("#mm1").html("* Select a Subject");


    } else {

        $("#mm1").html("");
        $('#pdf_button').css("display", "block");
        viewstudenttable(value, semesterid, permission);
        $("#exportstudents").css("display", "block");

    }


});
$(document).on('click', "#loadpresent", function() {
    var semesterid = $(this).data("semesterid");
    var subjectid = $(this).data("subjectid");
    var lecturedate = $(this).data("dateoflecture");
    var lecturetopic = $(this).data("lecturetopic");
    $("body").load("../teacher/present.php", {
        semesterid: semesterid,
        subjectid: subjectid,
        dateoflecture: lecturedate,
        lecturetopic: lecturetopic
    });

});
$(document).on('click', "#loadabsent", function() {
    var semesterid = $(this).data("semesterid");
    var subjectid = $(this).data("subjectid");
    var lecturedate = $(this).data("dateoflecture");
    var lecturetopic = $(this).data("lecturetopic");
    $("body").load("../teacher/absent.php", {
        semesterid: semesterid,
        subjectid: subjectid,
        dateoflecture: lecturedate,
        lecturetopic: lecturetopic
    });

});


function viewlecturetable(value, semesterid) {
    $.ajax({
        url: "loaddata/loadlecture.php",
        type: "POST",
        data: {
            getsubjectid: value,
            connection: true,
            getsemesterid: semesterid
        },
        success: function(data) {
            $("#addlecturetable").html(data);
        }



    });

}


function viewstudenttable(value, semesterid, permission) {
    $.ajax({
        url: "loaddata/loadstudent.php",
        type: "POST",
        data: {
            getsubjectid: value,
            connection: true,
            getsemesterid: semesterid,
            getper: permission
        },
        success: function(data) {
            $("#addstudenttable").html(data);



        }
    });

}

$(document).on("click", "#clickonupdate", function() {
    var studentid = $(this).data("studentid");
    var semesterid = $(this).data("semesterid");
    var subjectid = $(this).data("subjectid");
    $("#selectdateandlecture").html("");
    $("#updatedrecordofstudent").html("");
    getdateandlecture(studentid, semesterid, subjectid);
    $('#selectdateandlecture').data('studentid', studentid);










});
$("#selectdateandlecture").on("change", function() {
    var studentid = $(this).data("studentid");
    var semesterid = $("#clickonupdate").data("semesterid");
    var subjectid = $("#clickonupdate").data("subjectid");
    var value = $(this).val();
    if (value == 0) {
        $("#updatedrecordofstudent").html("");
    } else {
        gettheupdaterecord(studentid, semesterid, subjectid, value);
    }

});



function gettheupdaterecord(studentid, semesterid, subjectid, value) {

    $.ajax({
        url: "loaddata/loadattedancerecord.php",
        type: "POST",
        data: {
            getsemesterid: semesterid,
            getsubjectid: subjectid,
            getstudentid: studentid,
            getvalue: value,
            connection: true
        },
        success: function(data) {
            $("#updatedrecordofstudent").html("");
            $("#updatedrecordofstudent").html(data);
            viewstudenttable(subjectid, semesterid, 0)

        }


    });

}

$(document).on("click", "#marknew", function() {
    var id = $(this).data("value");
    var remarkmessage = $("#remakmessage").val();
    var studentid = $("#selectdateandlecture").data("studentid");
    var semesterid = $("#clickonupdate").data("semesterid");
    var subjectid = $("#clickonupdate").data("subjectid");
    var date = $("#selectdateandlecture").val();
    $("#selectdateandlecture").prop("disabled", true);

    if (remarkmessage == "" || date == 0) {
        $("#mess").html("* enter a remark- or check the date");

    } else {
        $("#mess").html("");

        swal({
                title: "Are you sure?",
                text: "You want to Update this record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    marknewattendance(id, studentid, subjectid, semesterid, date, remarkmessage);
                } else {
                    swal("Cancled Record is safe!");
                }
            });

    }


});
$(document).on("click", "#requestupdatebox", function() {
    var semesterid = $(this).data("semesterid");
    var subjectid = $(this).data("subjectid");
    var teacherid = $("#teacher_hidden").val();

    swal({
            title: "Are you sure?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "request/requestpermission.php",
                    type: "POST",
                    data: {
                        connection: true,
                        getsemesterid: semesterid,
                        getsubjectid: subjectid,
                        getteacherid: teacherid
                    },
                    success: function(data) {

                        if (data == 3) {

                            swal("God job!",
                                "Request has been send to Coordinator. We will notify you when permission is granted",
                                "success");


                        } else if (data == 1) {

                            swal("ohoohoh!", "Request Sent failed", "error");




                        } else {
                            swal("ohoohoh!", "Something went wrong! try again", "error");


                        }

                    }


                });

            } else {
                swal("Request Cancled!");
            }
        });







});


function marknewattendance(id, studentid, subjectid, semesterid, date, remarkmessage) {

    $.ajax({
        url: "senddata/sendupdated.php",
        type: "POST",
        data: {
            getid: id,
            getsemesterid: semesterid,
            getstudentid: studentid,
            getsubjectid: subjectid,
            getdate: date,
            connection: true,
            getremarkmessage: remarkmessage
        },
        success: function(data) {


            if (data == 3) {
                gettheupdaterecord(studentid, semesterid, subjectid, date);
                $("#selectdateandlecture").prop("disabled", false);


            } else if (data == 1) {

                swal("ohoohoh!", "Updating not Successfully! try again", "error");
                $("#selectdateandlecture").prop("disabled", false);



            } else {
                swal("ohoohoh!", "Something went wrong! try again", "error");
                $("#selectdateandlecture").prop("disabled", false);

            }

        }




    });

}


function getdateandlecture(studentid, semesterid, subjectid) {

    $.ajax({
        url: "loaddata/loaddate.php",
        type: "POST",
        data: {
            getsemesterid: semesterid,
            getsubjectid: subjectid,
            connection: true
        },
        success: function(data) {
            $("#selectdateandlecture").html(data);

        }


    });


}

$(document).on("click", "#deletelecture", function() {
    var date = $(this).data("lecturedate");
    var subjectid = $(this).data("subjectid");
    var semesterid = $(this).data("semesterid");

    swal("*Warning Lecture Date and It's all record will be Deleted.. Write CONFIRM in the BOX:", {
            content: "input",
        })
        .then((value) => {
            if (value == "CONFIRM") {
                deletelecture(date, subjectid, semesterid);
            } else {
                swal(`oohoh You typed: ${value}. Type CONFIRM  `);
            }
        });


});

function deletelecture(date, subjectid, semesterid) {

    $.ajax({
        url: "deletedata/deletelecture.php",
        type: "POST",
        beforeSend: function() {


        },
        data: {
            getdate: date,
            getsemesterid: semesterid,
            getsubjectid: subjectid,
            connection: true
        },
        success: function(data) {

            if (data == 3) {

                swal("Good JOB!", "Lecture Deleted Successfully", "success");
                viewlecturetable(subjectid, semesterid);

            } else if (data == 0) {

                swal("ohoohoh!", "Deleting Lecture Failed", "error");




            } else if (data == 1) {

                swal("ohoohoh!", "You can't delete the Lecture! Contact Coordinator", "error");




            } else {
                swal("ohoohoh!", "Something went wrong! try again", "error");


            }
        }



    });



}
</script>
<?php
$conn = null;
?>