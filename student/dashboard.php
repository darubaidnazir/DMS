<?php
session_start();
if (!isset($_SESSION['active']) || !isset($_SESSION['studentid'])) {
    header("Location:../student/studentlogin.html");
    exit();
}
$studentid = $_SESSION['studentid'];
require_once("../coordinator/dbcon.php");

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

    <title>Student Dashboard</title>
</head>
<style>
.student-profile .card {
    border-radius: 10px;
}

.student-profile .card .card-header .profile_img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin: 10px auto;
    border: 10px solid #ccc;
    border-radius: 50%;
}

.student-profile .card h3 {
    font-size: 20px;
    font-weight: 700;
}

.student-profile .card p {
    font-size: 16px;
    color: #000;
}

.student-profile .table th,
.student-profile .table td {
    font-size: 14px;
    padding: 5px 10px;
    color: #000;
}

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
                    <h3>Student</h3>
                </li>
                <li>
                    <a href="#DashBoard Teacher">
                        <svg>
                            <use xlink:href="#home"></use>
                        </svg>
                        <span class="maindashbutton">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#Lecture Details">
                        <svg>
                            <use xlink:href="#pages"></use>
                        </svg>
                        <span id="addbatch" class="menu_button">Class Record</span>
                    </a>
                </li>
                <li>
                    <a href="#Student Record">
                        <svg>
                            <use xlink:href="#setting"></use>
                        </svg>
                        <span id="addstudentrecord" class="menu_button">Feedback Record</span>
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
                        <?php echo $_SESSION['studentname'];    ?><br>

                    </span>
                </span>


            </div>
        </section>
        <form>
            <input type="hidden" id="teacher_hidden" value="<?php echo $studentid; ?>" />
        </form>
        <section id="maindashboardsection">
            <!-- Student Profile -->
            <?php
            $getstudentdetail = $conn->prepare('SELECT * FROM `student` INNER JOIN `batch` ON student.batchid = batch.batchid INNER JOIN `branch` ON batch.branchid = branch.branchid WHERE `studentid` = ?');
            $getstudentdetail->bindParam(1, $studentid);
            $getstudentdetail->execute();
            if ($getstudentdetail->rowCount() == 0) {
                session_destroy();
                header("Location:../student/studentlogin.html");
            }


            ?>
            <div class="student-profile py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card shadow-sm">
                                <div class="card-header bg-transparent text-center">
                                    <?php
                                    foreach ($getstudentdetail as $fetchStudent) {

                                    ?>
                                    <img class="profile_img" src="images/student.png" alt="">
                                    <h3> <input type="hidden" id="student_id"
                                            value='<?php echo $studentid; ?>'><?php echo $fetchStudent['studentname']; ?>
                                        <?php
                                            if ($fetchStudent['studentrollno'] == "") {
                                            ?>
                                        <div class="alert alert-danger" role="alert">
                                            Update your Enrollment no..?
                                        </div>
                                        <?php
                                            }
                                            ?>

                                    </h3>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0"><strong class="pr-1">Student
                                            Status:</strong><?php if ($fetchStudent['studentstatus'] == 'active') {
                                                                echo " <span
                                                                class='btn btn-success text-uppercase fs-5'>Active</span>";
                                                            } else {
                                                                echo " <span
                                                                class='btn btn-danger text-uppercase fs-5'>In-active</span>";
                                                            }
                                                            ?></p>
                                    <p class="mb-0"><strong class="pr-1">Student
                                            Enrollment:</strong><span
                                            class='btn btn-light text-uppercase fs-5'><?php echo $fetchStudent['studentrollno']; ?></span>
                                    </p>
                                    <p class="mb-0"><strong class="pr-1">Student
                                            Registration No:</strong><span
                                            class='btn btn-light text-uppercase fs-5'><?php echo $fetchStudent['studentregno']; ?></span>
                                    </p>
                                    <p class="mb-0"><strong class="pr-1">Department:</strong><span
                                            class='btn btn-light text-uppercase fs-5'><?php echo $fetchStudent['branchname']; ?>,CSE</span>
                                    </p>
                                    <p class="mb-0"><strong class="pr-1">Batch:</strong><span
                                            class='btn btn-light text-uppercase fs-5'><?php echo $fetchStudent['batchyear']; ?></span>
                                    </p>
                                    <p class="mb-0"><strong class="pr-1">CurrentSemester:</strong><span
                                            class='btn btn-light text-uppercase fs-5'><?php echo $fetchStudent['currentsemester']; ?></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card shadow-sm">
                                <div class="card-header bg-transparent border-0">
                                    <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
                                </div>
                                <div class="card-body pt-0">
                                    <table class="table table-bordered">
                                        <style>
                                        .student-profile .table th,
                                        .student-profile .table td {
                                            font-size: 14px;
                                            padding: 5px 10px;
                                            /* color: #000; */
                                            all: revert;
                                        }
                                        </style>
                                        <tr>
                                            <th width="30%">Note</th>
                                            <td style="color:red;">
                                                *Update your detail's by Clicking on the data field.
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Student Name</th>
                                            <td width="2%">:</td>
                                            <td><input type="text" placeholder="Update Name" id='update_studentname'
                                                    value="<?php echo $fetchStudent['studentname']; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Enrollment No</th>
                                            <td width="2%">:</td>
                                            <td><input type="text" placeholder="Update Enrollment No"
                                                    id='update_studentrollno'
                                                    value="<?php echo $fetchStudent['studentrollno']; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Registered Email Id</th>
                                            <td width="2%">:</td>
                                            <td><?php echo $fetchStudent['studentemail']; ?></td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Registration Number</th>
                                            <td width="2%">:</td>
                                            <td><input type="text" placeholder="Update Reg no" id='update_studentregno'
                                                    value="<?php echo $fetchStudent['studentregno']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Date of Birth</th>
                                            <td width="2%">:</td>
                                            <td><input type="text" placeholder="Update DOB" id='update_studentdob'
                                                    value="<?php echo $fetchStudent['studentdob']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Group</th>
                                            <td width="2%">:</td>
                                            <td><?php echo $fetchStudent['group_id']; ?></td>
                                        </tr>
                                        <?php
                                    }

                                    ?>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3"></th>
                                                <td><button class="btn btn-primary"
                                                        id='update_student_details'>Update</button><button
                                                        class="btn btn-primary"
                                                        id='update_student_details_refresh'>Refresh Page</button></td>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <section id="addbatchsection">
            <div class="text-center maintable">
                <p>
                    <lable class="text-uppercase" style="color:blue;font-weight:bold">Select a Subject to View Lecture
                        details.</lable>

                    <select class="form-control" aria-label="Default select example" id='subjectlecture'
                        name="subjectlecture">
                        <option selected value="0">Select a Subject</option>
                        <?php
                        $sql0 = $conn->prepare("Select * FROM `student` WHERE `studentid` = ?");
                        $sql0->bindParam(1, $studentid);
                        $sql0->execute();
                        foreach ($sql0->fetchAll(PDO::FETCH_ASSOC) as $row0) {
                            $batchid = $row0['batchid'];
                            break;
                        }
                        $num = 1;
                        $sql2 = $conn->prepare("Select * FROM `semester` WHERE `batchid` = ? && `semesterstatus` = ?");
                        $sql2->bindParam(1, $batchid);
                        $sql2->bindParam(2, $num);
                        $sql2->execute();
                        foreach ($sql2->fetchAll(PDO::FETCH_ASSOC) as $row2) {
                            $semesterid = $row2['semesterid'];
                            break;
                        }

                        $sql1 = $conn->prepare("Select * FROM `subject` INNER JOIN `assignedsubject` ON subject.subjectid = assignedsubject.subjectid WHERE assignedsubject.semesterid = ?");
                        $sql1->bindParam(1, $semesterid);
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


                    <small id="mm" style="color:red;"></small>
                </p>
                <div class="text-center" style="margin:5px;">

                    <input type="text" id="seachlecture" class="form-control form-input"
                        placeholder="Search anything...">

                </div>
                <div id="maintable">

                </div>

            </div>
        </section>
        <section id="addstudentrecordsection">S</section>
        <section id="addpdfsection">P</section>
        <section id="addsettingsection">Setting</section>



</body>

</html>

<script src="../coordinator/dash.js"></script>
<script src="../student/javascript/dashboard.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>
<script>
$(document).ready(function() {
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
                $("#maintable").html(data);
            }



        });

    }
    $("#update_student_details_refresh").hide();
    $("#update_student_details").on("click", function(e) {
        e.preventDefault();
        var studentname = $("#update_studentname").val();
        var studentrollno = $("#update_studentrollno").val();
        var studentregno = $("#update_studentregno").val();
        var studentdob = $("#update_studentdob").val();
        var studentid = $("#student_id").val();
        const last2Str = String(studentrollno).slice(-2); // 👉️ '68'
        const last2Num = Number(last2Str);

        if (studentrollno == "" || studentrollno == undefined || studentrollno == null) {
            swal("ohoho!", "Roll no can not be empty!", "error");
        } else if (!Number.isInteger(last2Num)) {
            swal("ohoho!", "Last two digits must be a number!", "error");
        } else {
            $.ajax({
                url: "inner/updatestudent.php",
                type: "post",
                data: {
                    get_studentid: studentid,
                    get_studentname: studentname,
                    get_studentrollno: studentrollno,
                    get_studentregno: studentregno,
                    get_studentdob: studentdob,
                    connection: true
                },
                success: function(data) {
                    if (data == 3) {
                        swal("Good Job!", "Profile Updated!", "success");
                        $("#update_student_details").hide();
                        $("#update_student_details_refresh").show();


                    } else if (data == 2) {
                        swal("ohoho!", "Failed to Update Profile! try again!", "error");
                    } else {
                        swal("ohoho!", "Something went wrong!", "error");
                    }
                }

            });
        }

    });

    $("#update_student_details_refresh").on("click", function(e) {
        e.preventDefault();
        window.location.reload();
    });

    $("#seachlecture").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#addlecturetable tr").filter(function() {
            $(this).toggle($(this).text()
                .toLowerCase().indexOf(value) > -1)
        });
    });


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

});
</script>


<?php
$conn = null;
?>