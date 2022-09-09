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
                    <a href="#Request's">
                        <svg>
                            <use xlink:href="#subject"></use>
                        </svg>
                        <span id="addrequest" class="menu_button">Request's</span>
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
            <section>
                <div class="text-center">

                    <button class="btn btn-warning m-2" data-bs-toggle="modal" data-bs-target="#student-to-batch-add"
                        id="addstudentbutton">Add
                        Student</button>

                    <br><small class="form-text text-muted">Select the Branch First</small>
                    <select class="selectBranchstudent form-select" aria-label="Default select example">
                        <option selected value="0">Select a Branch</option>
                        <?php
                        $sql = $conn->prepare("SELECT * FROM `branch` WHERE `coordinatorid` = ?");
                        $sql->bindParam(1, $coordinatorid);
                        $sql->execute();
                        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                        ?>

                        <option value="<?php echo $row['branchid']; ?>"><?php echo $row['branchname']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <small class="form-text text-muted">Select the Batch to Show Student's Enrolled</small>
                    <select class="addStudentData_batch_Select form-select" aria-label="Default select example">
                        <option selected value="0">Select a Batch</option>

                    </select>

                    <main>
                        <table>

                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Student Email</th>
                                    <th>Student Name</th>
                                    <th>Student Enrollment</th>
                                    <th>Student Dob</th>

                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                            </tfoot>
                            <tbody id="addStudentData">

                            </tbody>
                        </table>
                    </main>
                </div>
            </section>
        </section>
        <section class=" grid" id="addactivesemestersection">
            <button class="maindashbutton">Main Dashboard</button>
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

            <div style="all:unset;" class='m-3'>
                <button style="  background-color: antiquewhite;
    padding: 10px;
    border: 2px solid;" id="plus"><i class="fa-solid fa-plus"></i><small style="color:red;  ">Maximize the timeslot
                        setting </small></button>
                <button style="  background-color: antiquewhite;
    padding: 10px;
    border: 2px solid;" id="minus"><i class="fa-solid fa-minus"></i><small style="color:green; ">Minimize the timeslot
                        setting
                    </small></button>
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
    <section class="grid" id="addsettingsection">

        Add SettingSectionddd
        <div>
            djskds
        </div>


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
<script src="dashboard.js"></script>
<script src="javascript/send.js"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>
<script>
$(document).ready(function() {
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