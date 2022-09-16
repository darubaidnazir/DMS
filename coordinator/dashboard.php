<?php
session_start();
if (!isset($_SESSION['active']) || !isset($_SESSION['userid'])) {
    header("Location:../coordinator/coordinatorlogin_signup.html");
    exit();
}
$coordinatorid = $_SESSION['userid'];

require_once('dbcon.php');
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
    <script src="https://kit.fontawesome.com/2508821737.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="table.css" />
    <link rel="stylesheet" href="dash.css" />
    <link rel="stylesheet" href="mainboard.css" />
    <link rel="stylesheet" href="spin.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



    <title>Coordinator Dashboard</title>
    <style>
    .min_max {

        background-color: antiquewhite;
        padding: 10px;
        border: 2px solid;
        width: 250px;
        margin: 3px;

    }

    .min_max:hover {
        background-color: white;
        color: black;
        border: 2px dash black;
    }

    .alert {
        background-color: red;
        color: black;
        border-radius: 50%;
    }
    </style>

</head>


<body>
    <div id="loader" class="lds-dual-ring hidden overlay"></div>
    <?php
    require_once("svg.php");
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
                    <h3>Coordinator</h3>
                </li>
                <li>
                    <a href="#home">
                        <svg>
                            <use xlink:href="#home"></use>
                        </svg>
                        <span class="maindashbutton"> Home</span>
                    </a>
                </li>
                <li>
                    <a href="#Batch  ">
                        <svg>
                            <use xlink:href="#pages"></use>
                        </svg>
                        <span id="addbatch" class="menu_button">Batch</span>
                    </a>
                </li>
                <li>
                    <a href="#Student   ">
                        <svg>
                            <use xlink:href="#student"></use>
                        </svg>
                        <span id="addstudent" class="menu_button"> Student</span>
                    </a>
                </li>

                <li>
                    <a href="#Teacher">
                        <svg>
                            <use xlink:href="#teacher"></use>
                        </svg>
                        <span id="addteacher" class="menu_button">Teacher</span>
                    </a>
                </li>
                <li>
                    <a href="#Active Semster  ">
                        <svg>
                            <use xlink:href="#activebook"></use>
                        </svg>
                        <span id="activesemster" class="menu_button">Active Semster</span>
                    </a>
                </li>
                <li>
                    <a href="#Subject   ">
                        <svg>
                            <use xlink:href="#subject"></use>
                        </svg>
                        <span id="addsubject" class="menu_button">Subject</span>
                    </a>
                </li>
                <li>
                    <a href="#Generate PDF Coordintor">
                        <svg>
                            <use xlink:href="#subject"></use>
                        </svg>
                        <span id="addpdfsectionbutton" class="menu_button">Generate PDF</span>
                    </a>
                </li>
                <li>
                    <a href="#Request's">
                        <svg>
                            <use xlink:href="#subject"></use>
                        </svg>
                        <?php
                        $sql2 = $conn->prepare("SELECT * FROM `coordinator` INNER
                           JOIN `teacher` on coordinator.coordinatiorid = teacher.coordinatorid INNER JOIN `assignedsubject` on teacher.teacherid = assignedsubject.teacherid INNER JOIN   subject on assignedsubject.subjectid = subject.subjectid  WHERE  coordinator.coordinatiorid = ? and assignedsubject.updatepermission != 0");
                        $sql2->bindParam(1, $coordinatorid);
                        $sql2->execute();
                        $countnum = $sql2->rowCount();


                        ?>
                        <span id="addrequest" class="menu_button">Request's
                            <?php if ($countnum != 0) {
                                echo "<i class='fa fa-bell'
                                style='font-size:15px;color:red'></i>";
                                echo $countnum;
                            }
                            ?>
                        </span>
                    </a>
                </li>

                <li class="menu-heading">
                    <h3>Settings</h3>
                </li>

                <li>
                    <a href="#Settings  ">
                        <svg>
                            <use xlink:href="#setting"></use>
                        </svg>
                        <span id="addsettingboard" class="menu_button">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <svg>
                            <use xlink:href="#logout"></use>
                        </svg>
                        <span id="addlogout">Logout</span>
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
                        <?php echo $_SESSION['username']; ?>
                    </span>
                </span>
                <div class="notifications">

                </div>
            </div>
        </section>
        <section class="grid" id="maindashboardsection">
            <article>1</article>
            <article>2</article>
            <article>3</article>
            <article>4</article>
            <article>5</article>
            <article>6</article>
            <article>7</article>
            <article>8</article>
        </section>
        <section class="grid" id="addbatchsection">


            <style></style>
            <div id="viewbatch">

                <h2>
                    <button id="addbranchview" class="btn btn-outline-dark"> View Branch</button>


                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#batch-year-modal">
                        Add Batch
                    </button>
                </h2>

                <main>
                    <table id="viewbatchtable">
                        <thead>
                            <tr>
                                <th>Batch Year</th>
                                <th>Branch Name</th>

                                <th>Current Semster</th>
                                <th>Total Student's</th>
                                <th>Status</th>
                                <th>Open/Close Semester</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="3"></th>
                            </tr>
                        </tfoot>
                        <tbody id="bodybatch">
                        </tbody>
                    </table>
                </main>
            </div>
            <div id="viewbranch">
                <h2>
                    <button id="addbatchview" class="btn btn-outline-dark"> View Batch</button>
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#add-branch-modal">
                        Add Branch
                    </button>
                </h2>

                <main>
                    <table>
                        <thead>
                            <tr>
                                <th>Branch ID</th>
                                <th>Branch Name</th>
                                <th>Hod/Coordinator</th>
                                <th>Total Semester</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="3"></th>
                            </tr>
                        </tfoot>
                        <tbody id="bodybranch">



                        </tbody>
                    </table>
                </main>
            </div>
        </section>
        <style>
        .grid div {
            padding: 10px;
            margin: 5px;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px,
                rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px,
                rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }

        .grid div h2 {
            text-align: center;
            padding: 10px;
        }

        select {
            font-size: 20px;
            width: 100%;
            margin: 5px;
            background-color: white;
            color: black;
            font-weight: bold;

        }

        select:hover {
            background-color: white;
            color: black;
        }

        .btnstudent {
            margin: 10px;
            background-color: white;
            color: black;
            display: block;
            font-weight: bolder;
            text-align: center;
        }




        .search-box {
            width: fit-content;
            height: fit-content;
            position: relative;
        }

        .input-search {
            height: 50px;
            width: 50px;
            border-style: none;
            padding: 10px;
            font-size: 18px;
            letter-spacing: 2px;
            outline: none;
            border-radius: 25px;
            transition: all .5s ease-in-out;
            background-color: #22a6b3;
            padding-right: 40px;
            color: #fff;
        }

        .input-search::placeholder {
            color: rgba(255, 255, 255, .5);
            font-size: 18px;
            letter-spacing: 2px;
            font-weight: 100;
        }

        .btn-search {
            width: 50px;
            height: 50px;
            border-style: none;
            font-size: 20px;
            font-weight: bold;
            outline: none;
            cursor: pointer;
            border-radius: 50%;
            position: absolute;
            right: 0px;
            color: #ffffff;
            background-color: transparent;
            pointer-events: painted;
        }

        .btn-search:focus~.input-search {
            width: 300px;
            border-radius: 0px;

            border-bottom: 1px solid rgba(255, 255, 255, .5);
            transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
        }

        .input-search:focus {
            width: 300px;
            border-radius: 0px;

            border-bottom: 1px solid rgba(255, 255, 255, .5);
            transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
        }
        </style>
        <section class="grid" id="addteachersection">


            <section>
                <div class="text-center">
                    <button class="btn btn-warning m-2" data-bs-toggle="modal"
                        data-bs-target="#teacher-to-batch-add">Add
                        teacher</button>
                    <main>
                        <table>
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Teacher ID</th>
                                    <th>Username</th>
                                    <th>Emp ID</th>
                                    <th>Phone Number</th>
                                    <th>Position</th>

                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                            </tfoot>
                            <tbody id="addTeachertable">

                            </tbody>

                        </table>
                    </main>
                </div>
            </section>
        </section>
        <section class="grid" id="addstudentsection">
            <p class="text-center" style="margin:5px;">

                <span class="search-box">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                    <input type="text" class="input-search seachstudent" placeholder="Type to Search...">
                </span>

            </p>
            <section>
                <button class="min_max" id="plusstudent1"><i class="fa-solid fa-arrow-right"></i><small
                        style="color:red;  ">
                        Add Student </small></button>
                <button class="min_max" id="minusstudent1"><i class="fa-solid fa-arrow-down"></i><small
                        style="color:green; ">
                        Add Student
                    </small></button>
                <div class="text-center" id="divstudent1">

                    <button class="btn btn-warning m-2" data-bs-toggle="modal" data-bs-target="#student-to-batch-add"
                        id="addstudentbutton">Add
                        Student</button>

                    <br>
                    <small class="form-text text-muted">Select the Batch to Show Student's Enrolled</small>
                    <select class="addStudentData_batch_Select form-select" aria-label="Default select example">


                    </select>

                    <main>
                        <table>

                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Student Email</th>
                                    <th>Student Name</th>
                                    <th>Student Enrollment</th>
                                    <th>Group</th>

                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                            </tfoot>
                            <tbody id="addStudentData" class="addstudenttable">

                            </tbody>
                        </table>
                    </main>
                </div>
            </section>
            <section>
                <button class="min_max" id="plusstudent2"><i class="fa-solid fa-arrow-right"></i><small
                        style="color:red;  ">
                        Update Attendance </small></button>
                <button class="min_max" id="minusstudent2"><i class="fa-solid fa-arrow-down"></i><small
                        style="color:green; ">
                        Update Attendance
                    </small></button>
                <div class="text-center maintable" id="divstudent2">
                    <p>
                        <lable class="text-uppercase" style="color:blue;font-weight:bold">Select a Subject to View
                            Student
                            Attendnace
                            Record.</lable><br>
                    <form action="../pdfgenerator/teacher/subjectpdf.php" method="post">
                        <select class="form-control" aria-label="Default select example" id='subjectlecture1new'
                            name='pdf_generator_free'>
                            <option selected value="0">Select a Subject</option>
                            <?php
                            $find = $conn->prepare("select * FROM `subject` INNER join `assignedsubject` on subject.subjectid = assignedsubject.subjectid  INNER join `semester` on assignedsubject.semesterid = semester.semesterid WHERE subject.coordinatorid = ? && semester.semesterstatus = 1 && assignedsubject.assignedstatus ='active'");
                            $find->bindParam(1, $coordinatorid);
                            $find->execute();
                            $resulttable = $find->fetchAll(PDO::FETCH_ASSOC);
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


                            ?>


                        </select>
                        <input type="submit" name="pdf_button" class='btn btn-secondary' id='pdf_button'
                            style='display:none;margin:5px' value='Generate pdf'>
                    </form>




                    <small id="mm1" style="color:red;"></small>
                    </p>

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
                                    <th>Percentage</th>
                                    <th>Update Attendance</th>


                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                            </tfoot>
                            <tbody id="addstudenttable" class="addstudenttable">

                            </tbody>

                        </table>

                    </main>
                </div>

            </section>
        </section>
        <section class=" grid" id="addactivesemestersection">

            <?php
            require_once("../coordinator/modal/loadactivesemester.php");

            ?>



        </section>
        <section class="grid" id="requestsection">

            <div class='m-3'>




                <p class='fw-bold text-uppercase'> Attendance Update Request Form</p>
                <table class='table table-success table-striped'>
                    <tr>
                        <td class='table-secondary'>S.No</td>
                        <td class='table-secondary'>Teacher Name</td>
                        <td class='table-secondary'>Subject Name</td>
                        <td class='table-secondary'></td>
                        <td class='table-secondary'>Action</td>
                    </tr>
                    <tbody id="tablerequest">

                    </tbody>
                </table>

            </div>


        </section>
        <section class="grid" id="addsubjectsection">


            <div style="  max-height: 700px;
  overflow-y: scroll;" class="text-center">
                <button class="btn btn-warning m-2" data-bs-toggle="modal"
                    data-bs-target="#button-subject-information">Add
                    Subject </button>
                <section>
                    <main>
                        <table>
                            <thead>

                            </thead>
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Subject Id</th>
                                    <th>Subject Name</th>
                                    <th>Subject Code</th>
                                    <th>Subject Level</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                            </tfoot>
                            <tbody id="bodysubject">

                            </tbody>
                        </table>
                    </main>
            </div>
        </section>
    </section>

    <section class="grid page-content" id="addsettingsection">
        <div style="all:unset;">
            <button class="min_max" id="plus1"><i class="fa-solid fa-arrow-right"></i><small style="color:red;  ">Add
                    Group's </small></button>
            <button class="min_max" id="minus1"><i class="fa-solid fa-arrow-down"></i><small style="color:green; ">Add
                    Group's

                </small></button>
            <button class="min_max" id="plus"><i class="fa-solid fa-arrow-right"></i><small style="color:red;  ">Add
                    Time slot </small></button>
            <button class="min_max" id="minus"><i class="fa-solid fa-arrow-down"></i><small style="color:green; ">Add
                    Time slot

                </small></button>

            <div class='text-center' id='some1'>

                <div class="group_assign_modal_body text-center ">
                    <form method="post" action="../coordinator/loadData/loadgroupstudent.php">
                        <h4>Select a Batch to assign group's</h4>
                        <select class="addStudentData_batch_Select form-select" id='addStudentData_batch_Select_id'
                            name='batchid_group' style='width:50%;margin:0 auto;' aria-label="Default select example">


                        </select>
                        <input class='btn btn-primary' style='margin:5px' type="submit" name="load_group"
                            value="Submit">

                    </form>

                </div>
            </div>


            <div style="all:unset;" class='m-3'>

                <div id="some">
                    <p>
                        Enter Maximum days to mark attendance from current date.<br>
                    <p>
                        <?php
                        $getdate = $conn->prepare('SELECT * FROM `timeslot` WHERE `coordinatorid` = ?');
                        $getdate->bindParam(1, $coordinatorid);
                        $getdate->execute();
                        $result = $getdate->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($result as $days) {
                        ?>
                        <span style="color:red;" id="daysmessage"></span>
                        <input type="number" id="daystoupdate" min="0" class="form-control m-2" id="days"
                            placeholder="<?php echo $days['updateattendance']; ?>"
                            value="<?php echo $days['updateattendance']; ?>">
                        <button class="btn btn-danger" style="    margin: 0 auto;
                                 display: block;" id="update_days">Update Days</button>
                        <?php
                            break;
                        }
                        ?>

                    </p>
                    </p>
                    <p class='fw-bold text-uppercase'> Select Time Slots</p>
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
                    <span id="timemessage" style="color:red;"></span>

                    <?php

                    function getTimeSlot($interval, $start_time, $end_time)
                    {
                        $start = new DateTime($start_time);
                        $end = new DateTime($end_time);
                        $startTime = $start->format('H:i');
                        $endTime = $end->format('H:i');
                        $i = 0;
                        $time = [];
                        while (strtotime($startTime) <= strtotime($endTime)) {
                            $start = $startTime;
                            $end = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($startTime)));
                            $startTime = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($startTime)));
                            $i++;
                            if (strtotime($startTime) <= strtotime($endTime)) {
                                $time[$i]['slot_start_time'] = $start;
                                $time[$i]['slot_end_time'] = $end;
                            }
                        }
                        return $time;
                    }
                    $start = "9:00";
                    $end =  "18:00";
                    $slots = getTimeSlot(30, $start, $end);
                    $length = count($slots);
                    echo '<select id="menutimeslotstart" class="form-control">
                <option selected value="0">Select a Start Time</option>';
                    for ($i = 1; $i <= $length; $i++) {

                        echo "<option value='{$slots[$i]['slot_start_time']}'>{$slots[$i]['slot_start_time']}</option>";
                    }
                    echo "</select>";
                    echo '<select id="menutimeslotend" class="form-control">
                <option selected value="0">Select a End Time</option>';
                    for ($i = 1; $i <= $length; $i++) {

                        echo "<option value='{$slots[$i]['slot_start_time']}'>{$slots[$i]['slot_start_time']}</option>";
                    }
                    echo "</select>";

                    ?>
                    <button class="btn btn-primary text-center" style="    margin: 0 auto;
    display: block;" id="settimeslot"> Set Time </button>
                </div>
            </div>


    </section>

    <section class="grid page-content" id="addpdfsection">
        <section>

            <button class="min_max" id="pluspdf1"><i class="fa-solid fa-arrow-right"></i><small style="color:red;  ">PDF
                    Student Record
                </small></button>
            <button class="min_max" id="minuspdf1"><i class="fa-solid fa-arrow-down"></i><small
                    style="color:green; ">PDF
                    Student Record

                </small></button>

            <div id='pdf1'>

                <p>
                    <lable class="text-uppercase" style="color:blue;font-weight:bold">Select a Subject to Generate PDF
                        for Student
                        Attendnace
                        Record.</lable><br>
                <form action="../pdfgenerator/teacher/subjectpdf.php" method="post">
                    <select class="form-control" aria-label="Default select example" name='pdf_generator_free'>
                        <option selected value="0">Select a Subject</option>
                        <?php
                        $find = $conn->prepare("select * FROM `subject` INNER join `assignedsubject` on subject.subjectid = assignedsubject.subjectid  INNER join `semester` on assignedsubject.semesterid = semester.semesterid WHERE subject.coordinatorid = ? && semester.semesterstatus = 1 && assignedsubject.assignedstatus ='active'");
                        $find->bindParam(1, $coordinatorid);
                        $find->execute();
                        $resulttable = $find->fetchAll(PDO::FETCH_ASSOC);
                        $string = "";
                        foreach ($resulttable as $row) {
                            $string .=  $row['subjectname'];
                            $string .= "-";
                            $string .=  $row['subjectcode'];

                        ?>
                        <option style='color:red;' data-permission="<?php echo $row['updatepermission']; ?>"
                            data-city="<?php echo $row['semesterid']; ?>"
                            value="<?php echo $row['semesterid'] . ',' . $row['subjectid'] . ',' . $row['subjectname'] . ',' . $row['subjectcode'] ?>">
                            <?php echo $string . ' Semester No ' . $row['semesterno']; ?></option>

                        <?php
                            $string = "";
                        }
                        ?>


                        ?>


                    </select>
                    <input type="submit" name="pdf_button" class='btn btn-secondary' style='margin:5px'
                        value='Generate pdf'>
                </form>

                </p>
            </div>
        </section>
        <section>
            <button class="min_max" id="pluspdf2"><i class="fa-solid fa-arrow-right"></i><small style="color:red;  ">PDF
                    LECTURE
                </small></button>
            <button class="min_max" id="minuspdf2"><i class="fa-solid fa-arrow-down"></i><small
                    style="color:green; ">PDF
                    LECTURE

                </small></button>
            <div class="text-center" id='pdf2'>
                <p>
                    <lable class="text-uppercase" style="color:blue;font-weight:bold">Select a Subject to Generate PDF
                        Lecture
                    </lable>
                </p>
                <form method="post" action="../pdfgenerator/teacher/lecturepdf.php">
                    <?php
                    $sql = $conn->prepare("SELECT * FROM `coordinator` INNER JOIN `branch` ON
                    `coordinator`.`coordinatiorid` = branch.coordinatorid INNER JOIN batch ON branch.branchid =
                    batch.branchid WHERE coordinator.coordinatiorid = ?");
                    $sql->bindParam(1, $coordinatorid);
                    $sql->execute();
                    $result = $sql->fetchAll();
                    ?>
                    <small class="form-text text-muted" style='color:red;' id='mmmmm'></small>
                    <label for='subjectlevel'>Chosen a batch</label>
                    <select class="form-control select_batch_id" id="select_batch_id" name='select_batch_id'>
                        <option value="0">Select a Batch</option>
                        <?php
                        foreach ($result as $row) {
                        ?>
                        <option value='<?php echo $row['batchid'] ?>'>
                            <?php echo $row['branchname'] . $row['batchyear']; ?></option>
                        <?php

                        }
                        ?>
                    </select>
                    <label for='subjectlevel'>Chosen Semester No</label>
                    <select class="form-control selectsemesterno" id='selectsemesterno' name='selectsemesterno'>

                    </select>
                    <select class="form-control" id='selectsemestersubject' name='subjectlecture'>

                    </select>

                    <input type="submit" name="subjectlecturepdf" class="btn btn-secondary" style='margin:5px;'
                        Value='Generate pdf'>
                </form>
            </div>
        </section>
        <section>
            <button class="min_max" id="pluspdf3"><i class="fa-solid fa-arrow-right"></i><small style="color:red;  ">PDF
                    Semester
                </small></button>
            <button class="min_max" id="minuspdf3"><i class="fa-solid fa-arrow-down"></i><small
                    style="color:green; ">PDF
                    Semester

                </small></button>
            <div class="text-center" id='pdf3'>
                <p>
                    <lable class="text-uppercase" style="color:blue;font-weight:bold">Select a Semester to Generate PDF

                    </lable>
                </p>
                <form method="post" action="../pdfgenerator/teacher/allsubject.php">
                    <?php
                    $sql = $conn->prepare("SELECT * FROM `coordinator` INNER JOIN `branch` ON
                    `coordinator`.`coordinatiorid` = branch.coordinatorid INNER JOIN batch ON branch.branchid =
                    batch.branchid WHERE coordinator.coordinatiorid = ?");
                    $sql->bindParam(1, $coordinatorid);
                    $sql->execute();
                    $result = $sql->fetchAll();
                    ?>
                    <small class="form-text text-muted" style='color:red;' id='mmmmm'></small>
                    <label for='subjectlevel'>Chosen a batch</label>
                    <select class="form-control select_batch_id" id="select_batch_id1" name='select_batch_id'>
                        <option value="0">Select a Batch</option>
                        <?php
                        foreach ($result as $row) {
                        ?>
                        <option value='<?php echo $row['batchid'] ?>'>
                            <?php echo $row['branchname'] . $row['batchyear']; ?></option>
                        <?php

                        }
                        ?>
                    </select>
                    <label for='subjectlevel'>Chosen Semester No</label>
                    <select class="form-control selectsemesterno" id='selectsemesterno2' name='selectsemesterno'>

                    </select>
                    <label for='subjectlevel'>Chosen Subject Mode</label>
                    <select class="form-control" name='subjectlevel'>
                        <option selected value='T'>Theory Subject's</option>
                        <option value='L'>Lab Subject's</option>
                    </select>
                    <input type="submit" name="subjectlecturepdf" class="btn btn-secondary" style='margin:5px;'
                        Value='Generate pdf'>
                </form>
            </div>
        </section>
    </section>
    <footer class="page-footer">
        <span>Department Management System North Campus</span>
    </footer>
    </section>

    <!-- Button trigger modal -->

    <!-- Batch Modal -->
    <div class="modal fade" id="batch-year-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Add Batch Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row py-5 m-3 forms" id="form">
                        <div class="col-md-10">
                            <div class="form-group">
                                <lable>Enter Batch Year</lable>
                                <input type="number" class="form-control" id="batch-year" placeholder="eg: 2018"
                                    required />
                            </div>
                            <small class="form-text text-muted"> Enter a Valid Year </small>

                            <div class="form-group mt-5">
                                <select class="form-select" aria-label="Default select example" id="branch_info"
                                    required>

                                </select>
                            </div>

                            <div class="form-group pt-3">
                                <button id="sendBatch" class="btn btn-primary">Add Batch</button>
                            </div>
                        </div>
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
    <!-- Batch Modal End-->

    <!-- Branch Modal -->
    <div class="modal fade" id="add-branch-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Add Branch Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row py-5 m-3 forms" id="form">
                        <div class="col-md-10">
                            <div class="form-group">

                                <lable>Enter Branch name</lable>
                                <input type="text" class="form-control" id="branch-name" placeholder="eg: MTech" />
                                <input type="hidden" id="coordinator_hidden" value="<?php echo $coordinatorid; ?>" />
                            </div>
                            <small class="form-text text-muted">
                                Enter a valid branch name
                            </small>
                            <div class="form-group">
                                <lable>Enter Total Semester in the Branch</lable>
                                <input type="number" class="form-control" id="branch-semester" placeholder="eg: 8" />


                            </div>
                            <small class="form-text text-muted">
                                Enter a valid Semester Number
                            </small>

                            <div class="form-group pt-3">
                                <button id="sendBranch" class="btn btn-primary">Add Branch</button>
                            </div>
                        </div>
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
    <!-- Branch Modal End-->

    <!-- Batch Information Modal -->
    <div class="modal fade" id="batch-information" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Batch Information
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Batch information Modal End-->

    <!-- Branch Information Modal -->
    <div class="modal fade" id="branch-information" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Branch Information
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Branch  informationModal End-->

    <!-- Student Information Modal -->
    <div class="modal fade" id="student-information" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Student Information
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Student  informationModal End-->
    <!-- Teacher Information Modal -->
    <div class="modal fade" id="teacher-to-batch-add" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        ADD Teacher
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">

                        <div class="row py-5 m-3 forms" id="formteacher">
                            <div class="col-md-10">
                                <span class="message_teacher" style="color:red;"></span>
                                <div class="form-group mt-2">
                                    <lable>Enter Username of Teacher</lable>
                                    <input type="text" class="form-control" id="enter-teacher-username"
                                        placeholder="eg: waseembakshi121" required>
                                </div>
                                <small class="form-text text-muted mt-1">
                                    Enter a valid username
                                </small>
                                <div class="form-group mt-2">
                                    <lable>Enter Employee ID of Teacher</lable>
                                    <input type="text" class="form-control" id="enter-emp-id" placeholder="eg: Emp-121"
                                        required>
                                </div>
                                <small class="form-text text-muted mt-1">
                                    Enter a valid Employee ID
                                </small>
                                <div class="form-group mt-2">
                                    <lable>Enter Position of the Teacher</lable>
                                    <select name="teacher-position" id="teacher-position" class="form-select"
                                        aria-label="Default select example">
                                        <option value="0">Select a Position</option>
                                        <option value="1">Assistant Professor</option>
                                        <option value="2">Contractual</option>
                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <lable>Enter Phone Number of the Teacher</lable>
                                    <input type="number" class="form-control" id="enter-phonenumber"
                                        placeholder="eg: 9622922604" required>
                                </div>
                                <small class="form-text text-muted mt-1">
                                    Enter a valid Phone Number
                                </small>
                                <div class="form-group pt-3">
                                    <button class="btn btn-primary" id="addteacherdata">Add Teacher</button>
                                </div>
                            </div>
                        </div>

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
    <!-- Teacher  informationModal End-->
    <!-- Subject Information Modal -->
    <div class="modal fade" id="subject-information" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Subject Information
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Subejct  informationModal End-->
    <!-- Subject assigned to teacherInformation Modal -->
    <div class="modal fade" id="subject-assigned-to-teacher" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Subject Assigned to Teacher
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body-assign-teacher"></div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Subejct assigned to teacher informationModal End-->
    <!-- Active Semester Information Modal -->
    <div class="modal fade" id="active-information-box" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Subject Assign Semester Information
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body-active">



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- dd -->
    <div class="modal fade" id="group_assign_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Group Assign to Student's
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="group_assign_modal_body text-center ">
                    <form method="post" action="../coordinator/loadData/loadgroupstudent.php">
                        <h4>Select a Batch to assign group's</h4>
                        <select class="addStudentData_batch_Select form-select" id='addStudentData_batch_Select_id'
                            name='batchid_group' style='width:50%;margin:0 auto;' aria-label="Default select example">


                        </select>
                        <input class='btn btn-primary' style='margin:5px' type="submit" name="load_group"
                            value="Submit">

                    </form>

                </div>








                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>





    <!-- Active Semester  informationModal End-->
    <!-- Assign teacher Information Modal -->
    <div class="modal fade" id="assign-teacher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Assigned Subject to Teacher
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body-assign-teacher">
                    <h1>hi</h1>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Assign Teacher  informationModal End-->
    <!-- Add Subject  Information Modal -->
    <div class="modal fade" id="button-subject-information" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Add Subejct's
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row py-5 m-3 forms" id="form">
                        <div class="col-md-10">
                            <span style="color:red;" id="messagesubject"></span>
                            <div class="form-group mt-2">
                                <lable>Enter Subject Name</lable>
                                <input type="text" class="form-control" id="enter-subject-name"
                                    placeholder="eg: Database">
                            </div>
                            <small class="form-text text-muted mt-1">
                                Enter a valid Subject Name
                            </small>
                            <div class="form-group mt-2">
                                <lable>Enter Subject Code</lable>
                                <input type="text" class="form-control" id="enter-subject-code"
                                    placeholder="eg: CSE-1717">
                            </div>
                            <small class="form-text text-muted mt-1">
                                Enter a valid Subject Code
                            </small>
                            <div class="form-group mt-2">
                                <label>Select a Subject Level</label>
                                <select class="form-control" id="enter-subject-level">
                                    <option selected value="T">Theory</option>
                                    <option value="L">Lab</option>
                                </select>
                            </div>





                            <div class="form-group pt-3">
                                <button class="btn btn-primary" id="addsubjectcode">Add Subject</button>
                            </div>

                        </div>

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


    <div class="modal fade" id="updateattendnce" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <!-- Add Subject  informationModal End-->
    <!-- Add Student  Modal -->
    <?php
    require_once("modal/addstudentmodal.php");
    ?>

    <!-- Add Student  Modal End-->
    <?php
    include_once('modal/addteachermodal.php');
    ?>
    <!-- Add Student  informationModal End-->
</body>

<script src="dash.js"></script>
<script src="javascript/send.js"></script>
<script src="dashboard.js"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>
<script>
$(document).ready(function() {
    $("#minuspdf1").hide();
    $("#pdf1").hide();
    $("#pluspdf1").on('click', function() {
        $("#minuspdf1").show();
        $("#pluspdf1").hide();
        $("#pdf1").show();

    });
    $("#minuspdf1").on('click', function() {
        $("#minuspdf1").hide();
        $("#pluspdf1").show();
        $("#pdf1").hide();

    });
    $("#minuspdf2").hide();
    $("#pdf2").hide();
    $("#pluspdf2").on('click', function() {
        $("#minuspdf2").show();
        $("#pluspdf2").hide();
        $("#pdf2").show();

    });
    $("#minuspdf2").on('click', function() {
        $("#minuspdf2").hide();
        $("#pluspdf2").show();
        $("#pdf2").hide();

    });
    $("#minuspdf3").hide();
    $("#pdf3").hide();
    $("#pluspdf3").on('click', function() {
        $("#minuspdf3").show();
        $("#pluspdf3").hide();
        $("#pdf3").show();

    });
    $("#minuspdf3").on('click', function() {
        $("#minuspdf3").hide();
        $("#pluspdf3").show();
        $("#pdf3").hide();

    });


    $("#minusstudent1").hide();
    $("#divstudent1").hide();
    $("#divstudent2").hide();
    $("#minusstudent2").hide();
    $("#plusstudent1").on("click", function() {
        $("#divstudent1").show();
        $("#plusstudent1").hide();
        $("#minusstudent1").show();

    });
    $("#plusstudent2").on("click", function() {
        $("#divstudent2").show();
        $("#plusstudent2").hide();
        $("#minusstudent2").show();

    });
    $("#minusstudent1").on("click", function() {
        $("#divstudent1").hide();
        $("#minusstudent1").hide();
        $("#plusstudent1").show();
    });
    $("#minusstudent2").on("click", function() {
        $("#divstudent2").hide();
        $("#minusstudent2").hide();
        $("#plusstudent2").show();

    });
    $(".select_batch_id").on("change", function() {
        var batchid = $(this).val();

        if (batchid == "" || batchid == 0) {
            $("#mmmmm").html("* Select a Batch");

        } else {
            $("#mmmmm").html("");
            $.ajax({
                url: "../coordinator/loadData/loadsemesterno.php",
                type: "POST",
                data: {
                    batchid: batchid,
                    connection: true
                },
                success: function(data) {
                    $(".selectsemesterno").html(data);
                }


            });

        }
    });
    $("#addStudentData_batch_Select_id_group").attr('disabled', true);
    $("#addStudentData_batch_Select_id").on('change', function() {
        var value = $(this).val();


        if (value == 0) {
            $("#addStudentData_batch_Select_id_group").attr('disabled', true);
        } else {
            $("#addStudentData_batch_Select_id_group").attr('disabled', false);
        }


    });
    $("#some1").hide();
    $("#minus1").hide();
    $("#plus1").on('click', function() {
        $("#minus1").show();
        $("#some1").show();
        $("#plus1").hide();
    });
    $("#minus1").on('click', function() {
        $("#minus1").hide();
        $("#some1").hide();
        $("#plus1").show();
    });



    $("#selectsemesterno").on("change", function() {
        var semesterid = $(this).val();
        if (semesterid == "" || semesterid == 0) {

        } else {
            $.ajax({
                url: "../coordinator/loadData/loadsubjectsem.php",
                type: "POST",
                data: {
                    semesterid: semesterid,
                    connection: true
                },
                success: function(data) {

                    $("#selectsemestersubject").html(data);
                }


            });

        }


    });


    $(document).on("click", "#clickonupdate", function() {

        var studentid = $(this).data("studentid");
        var semesterid = $(this).data("semesterid");
        var subjectid = $(this).data("subjectid");
        $("#selectdateandlecture").html("");
        $("#updatedrecordofstudent").html("");
        getdateandlecture(studentid, semesterid, subjectid);
        $('#selectdateandlecture').data('studentid', studentid);


    });

    function getdateandlecture(studentid, semesterid, subjectid) {

        $.ajax({
            url: "../../DMS/teacher/loaddata/loaddate.php",
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

                        marknewattendance(id, studentid, subjectid, semesterid, date,
                            remarkmessage);
                    } else {
                        swal("Cancled Record is safe!");
                    }
                });

        }


    });


    function marknewattendance(id, studentid, subjectid, semesterid, date, remarkmessage) {
        var coordinator = 0;
        $.ajax({
            url: "../../DMS/teacher/senddata/sendupdated.php",
            type: "POST",
            data: {
                getid: id,
                getsemesterid: semesterid,
                getstudentid: studentid,
                getsubjectid: subjectid,
                getdate: date,
                connection: true,
                getremarkmessage: remarkmessage,
                accesslevel: coordinator,
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
        var coordinator = 0;
        $.ajax({
            url: "../../DMS/teacher/loaddata/loadattedancerecord.php",
            type: "POST",
            data: {
                getsemesterid: semesterid,
                getsubjectid: subjectid,
                getstudentid: studentid,
                getvalue: value,
                connection: true,
                accesslevel: coordinator,
            },
            success: function(data) {

                $("#updatedrecordofstudent").html("");
                $("#updatedrecordofstudent").html(data);
                viewstudenttable(subjectid, semesterid, 0)

            }


        });

    }

    $("#subjectlecture1new").on("change", function() {

        var value = $(this).val().split(',')[1];
        var semesterid = $(this).find(':selected').data('city');
        var permission = $(this).find(':selected').data('permission');

        if (value == 0 || value == undefined) {
            $('#pdf_button').css('display', 'none');
            $("#mm1").html("* Select a Subject");

        } else {
            $('#pdf_button').css('display', 'block');
            $("#mm1").html("");
            viewstudenttable(value, semesterid, permission);
            $("#exportstudents").css("display", "block");

        }


    });

    function viewstudenttable(value, semesterid, permission) {
        var coordinator = 0;
        $.ajax({
            url: "../../DMS/teacher/loaddata/loadstudent.php",
            type: "POST",
            data: {
                getsubjectid: value,
                connection: true,
                getsemesterid: semesterid,
                getper: permission,
                accesslevel: coordinator,
            },
            success: function(data) {
                $("#addstudenttable").html(data);



            }
        });

    }



    $(".seachstudent").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".addstudenttable tr").filter(function() {
            $(this).toggle($(this).text()
                .toLowerCase().indexOf(value) > -1)
        });
    });















    $("#some").hide();
    $("#minus").hide();
    $("#plus").on("click", function() {
        $("#some").show();
        $("#plus").hide();
        $("#minus").show();
    });
    $("#minus").on("click", function() {
        $("#some").hide();
        $("#minus").hide();
        $("#plus").show();

    });
    $(document).on("click", "#opensemester", function(event) {
        var batchid = $(this).data("id");

        swal({
                title: "Are you sure?",
                text: "You want to open the first semester of this batch!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    sendactivesemester(batchid);
                } else {
                    swal("Open Semester Cancled!");
                }
            });


    });
    $(document).on("click", "#closesemester", function(event) {
        var batchid = $(this).data("id");

        swal({
                title: "Are you sure?",
                text: "You want to open the Close this semester and open a new semester of this batch!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    sendactivesemester(batchid);
                } else {
                    swal("Open Semester Cancled!");
                }
            });



    });
    $(document).on("click", "#subjectassignedtoteacher", function(event) {
        var teacherid = $(this).data("id");
        $.ajax({
            url: "../coordinator/loadData/loadteacherassignedsubject.php",
            type: "POST",
            data: {
                get_Teacherid: teacherid,
                connection: true
            },
            success: function(data) {

                $("#modal-body-assign-teacher").html(data);
            }


        });
    });
    $(document).on("click", "#assignsubjecthere", function(event) {
        var semesterid = $(this).data("id");
        var subejctid = $("#assignedselect").val();
        var teacherid = $("#assignedselectteacher").val();
        var coordinate = $("#coordinator_hidden").val().trim();
        if (subejctid == 0 || teacherid == 0) {

            $("#messagesubjects").html("*Select a Subject and Teacher");
        } else {


            swal({
                    title: "Are you sure?",
                    text: "You want to add this teacher with this subject!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "../coordinator/modal/sendmodaldata/sendassignedsubject.php",
                            type: "POST",
                            data: {
                                get_Semesterid: semesterid,
                                get_Subjectid: subejctid,
                                get_Teacherid: teacherid,
                                connection: true
                            },
                            success: function(data) {

                                if (data == 2) {
                                    swal("ohoho!",
                                        "Subject already Assigned to this semester? try with different Subject ",
                                        "error");
                                } else if (data == 9) {
                                    swal("ohoho!",
                                        "Teacher already assigned to this subject and is disabled. you can't enable the teacher? try with different teacher ",
                                        "error");

                                } else if (data == 3) {
                                    swal("Good job ",
                                        "Subjectt Assigned Sucessfully! ",
                                        "success");
                                    assignsubjectbox(semesterid, coordinate);


                                } else {
                                    swal("ohoho!",
                                        "Something went wrong! try again later",
                                        "error");

                                }
                            }

                        });

                    } else {
                        swal("Assign Function Canacled!");
                    }
                });


        }
    });

    $(document).on('click', "#update_days", function() {

        var days = $("#daystoupdate").val();
        if (days == "") {
            $("#daysmessage").html('* enter a day in the field');
        } else if (isNaN(days)) {
            $("#daysmessage").html('* enter a valid number');
        } else {
            $("#daysmessage").html('');
            swal({
                    title: "Are you sure?",
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        UpdateDays(days);
                    } else {
                        swal("Ohoho Action Cancled");
                    }
                });

        }



    });
    $(document).on('click', "#settimeslot", function() {
        var start = $("#menutimeslotstart").val();
        var end = $("#menutimeslotend").val();
        if (start == 0 || end == 0) {
            $("#timemessage").html("* Please select a valid time")
        } else if (start >= end) {
            $("#timemessage").html("* Start time must be greater or equal to end time");
        } else {
            $("#timemessage").html("");
            swal({
                    title: "Are you sure?",
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        sendtimeslot(start, end);
                    } else {
                        swal("Ohoho Action Cancled");
                    }
                });

        }

    });

    function sendtimeslot(start, end) {
        $.ajax({
            url: "../coordinator/modal/sendmodaldata/sendtimeslot.php",
            type: "post",
            data: {
                getstart: start,
                getend: end
            },
            success: function(data) {
                if (data == 3) {
                    swal("Good Job!", "Time  Updated", "success");
                    window.location.reload();



                } else if (data == 1) {
                    swal("ohooho ",
                        "Couldn't Update Time...!",
                        "error");


                } else {
                    swal("ohooho ",
                        "Something went wrong...!",
                        "error");

                }
            },


        });

    }

    function UpdateDays(days) {
        $.ajax({
            url: "../coordinator/modal/sendmodaldata/senddays.php",
            type: "POST",
            beforeSend: function() {

                $("#update_days").html("wait..");
            },
            data: {
                getdays: days,
                connection: true
            },
            success: function(data) {

                if (data == 3) {
                    swal("Good Job!", "Day Updated", "success");
                    $("#update_days").html("Update Days");


                } else if (data == 1) {
                    swal("ohooho ",
                        "Couldn't Update Days...!",
                        "error");
                    $("#update_days").html("Update Days");

                } else {
                    swal("ohooho ",
                        "Something went wrong...!",
                        "error");
                    $("#update_days").html("Update Days");
                }
            }



        });


    }


    function sendactivesemester(batchid) {
        $.ajax({
            url: "modal/sendmodaldata/opensemester.php",
            type: "POST",
            data: {
                get_Batchid: batchid,
                connection: true
            },
            success: function(data) {
                if (data == 3) {
                    swal("Good Job!", "First Semester of the Batch has been Opened ",
                        "success");
                    bodyofbatch();


                } else if (data == 5) {
                    swal("Good job ",
                        "Batch has been Closed...!",
                        "success");
                    bodyofbatch();

                } else if (data == 4) {
                    swal("Good job ",
                        "Previous semester has been Closed and New Semester has be Opend!",
                        "success");
                    bodyofbatch();

                } else {
                    swal("ohoho!", "Something went wrong! try again later", "error");
                    $("#sendBranch").html("Add Branch");
                }
            }



        });
    }
});
</script>
<script type='text/javascript'>
$("#addrequest").on('click', function() {
    getrequest();

});

function getrequest() {
    var coordinate = $("#coordinator_hidden").val().trim();
    $.ajax({
        url: "loadData/loadrequest.php",
        type: "POST",
        data: {
            getcoordinatorid: coordinate,
            connection: true
        },
        success: function(data) {

            $("#tablerequest").html(data);
        }



    });

}


$(document).on('click', "#grantpermission", function() {
    var teacherid = $(this).data("teacherid");
    var semesterid = $(this).data("semesterid");
    var subjectid = $(this).data("subjectid");
    swal({
            title: "Are you sure?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                sendrequestresponse(teacherid, semesterid, subjectid, "1");
            } else {
                swal("Ohoho Action Cancled");
            }
        });



});
$(document).on('click', "#rejectpermission", function() {
    var teacherid = $(this).data("teacherid");
    var semesterid = $(this).data("semesterid");
    var subjectid = $(this).data("subjectid");
    swal({
            title: "Are you sure?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                sendrequestresponse(teacherid, semesterid, subjectid, "2");
            } else {
                swal("Ohoho Action Cancled");
            }
        });


});

function sendrequestresponse(teacherid, semesterid, subjectid, value) {
    $.ajax({
        url: "../coordinator/modal/sendmodaldata/sendrequest.php",
        type: "POST",
        data: {

            getteacherid: teacherid,
            getsemesterid: semesterid,
            getsubjectid: subjectid,
            getvalue: value,
            connection: true
        },
        success: function(data) {

            getrequest();
            if (data == 3) {
                swal("Good Job!", "Permission Granted! Untill You Revoke Permission ", "success");


            } else if (data == 4) {
                swal("oohoho ",
                    "Permission denied",
                    "error");

            } else {
                swal("ohoho!", "Something went wrong! try again later", "error");
                $("#sendBranch").html("Add Branch");
            }

        }


    });

}
</script>

</html>
<?php
$conn = null;


?>