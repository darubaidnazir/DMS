<?php
session_start();
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
    <link rel="stylesheet" href="table.css" />
    <link rel="stylesheet" href="dash.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Coordinator Dashboard</title>
</head>
<style>
#addbatchview {
    display: none;
}

#viewbatch {
    display: block;
}

#viewbranch {
    display: none;
}

#addbatchsection {
    display: none;
}

#addstudentsection {
    display: none;
}

#addsettingsection {
    display: none;
}

#addteachersection {
    display: none;
}

#addactivesemestersection {
    display: none;
}

#addsubjectsection {
    display: none;
}

.forms {
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;

}

.maindashbutton {
    padding: 10px;
    color: red;
    margin-bottom: 3px;
    font-weight: bolder;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}

.loading span {
    display: inline-block;
    vertical-align: middle;
    width: .6em;
    height: .6em;
    margin: .19em;
    background: #007DB6;
    border-radius: .6em;
    animation: loading 1s infinite alternate;
}

#cover {
    position: fixed;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    background: #141526;
    z-index: 9999;
    font-size: 65px;
    text-align: center;
    padding-top: 200px;
    color: #fff;
    font-family: tahoma;
}
</style>

<body>
    <div id="cover"> <span class="glyphicon glyphicon-refresh w3-spin preloader-Icon"></span> Wait!While we are Fetching
        Data From the Server...</div>
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
                    <a href="#0">
                        <svg>
                            <use xlink:href="#pages"></use>
                        </svg>
                        <span id="addbatch" class="menu_button">Batch</span>
                    </a>
                </li>
                <li>
                    <a href="#0">
                        <svg>
                            <use xlink:href="#users"></use>
                        </svg>
                        <span id="addstudent" class="menu_button"> Student</span>
                    </a>
                </li>

                <li>
                    <a href="#0">
                        <svg>
                            <use xlink:href="#users"></use>
                        </svg>
                        <span id="addteacher" class="menu_button">Teacher</span>
                    </a>
                </li>
                <li>
                    <a href="#0">
                        <svg>
                            <use xlink:href="#pages"></use>
                        </svg>
                        <span id="activesemster" class="menu_button">Active Semster</span>
                    </a>
                </li>
                <li>
                    <a href="#0">
                        <svg>
                            <use xlink:href="#pages"></use>
                        </svg>
                        <span id="addsubject" class="menu_button">Subject</span>
                    </a>
                </li>

                <li class="menu-heading">
                    <h3>Settings</h3>
                </li>

                <li>
                    <a href="#0">
                        <svg>
                            <use xlink:href="#settings"></use>
                        </svg>
                        <span id="addsetting" class="menu_button">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <svg>
                            <use xlink:href="#settings"></use>
                        </svg>
                        <span id="addsetting">Logout</span>
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
                <span class="greeting">Hello Sir, <?php

                                                    echo $_SESSION['username'];  ?></span>
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
            <button class="maindashbutton menu-button">Main Dashboard</button>
            <button id="addbranchview" class="btn btn-dark"> Add Branch</button>
            <button id="addbatchview" class="btn btn-dark"> Add Batch</button>
            <style></style>
            <div id="viewbatch">
                <h2>
                    Batch

                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
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
                        <tbody>
                            <?php
                            $sql = $conn->prepare("SELECT * FROM `batch` INNER JOIN `branch` ON batch.branchid = branch.branchid WHERE branch.coordinatorid = ? ");
                            $sql->bindParam(1, $coordinatorid);
                            $sql->execute();
                            if ($sql->rowCount() > 0) {
                                while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                            ?>

                            <tr>
                                <td data-title="Batch Year"><?php echo $row['batchyear']; ?></td>
                                <td data-title="Branch"><?php echo $row['branchname']; ?></td>

                                <td data-title="Current Semester"><?php echo $row['currentsemester']; ?></td>
                                <td data-title="Total Student's"><?php echo $row['batchyear']; ?></td>
                                <td data-title="Status" style="color: Green"><?php
                                                                                        if ($row['currentsemester'] >= $row['totalsemester'] && $row["batchstatus"] == 0) {
                                                                                            echo "Closed";
                                                                                        } else if ($row["batchstatus"] == 0) {

                                                                                            echo "in-active";
                                                                                        } else {
                                                                                            echo "Active";
                                                                                        }

                                                                                        ?></td>
                                <?php
                                        if ($row['currentsemester'] == 0) {
                                            echo "<td class='select'>
                                            <a class='btn btn-primary' href='#' id='opensemester' data-id='{$row["batchid"]}'> Open Semester</a>
                                        </td>";
                                        } else if ($row['currentsemester'] > $row['totalsemester'] || $row["batchstatus"] == 0) {
                                            echo "<td class='select'>
                                            <a class='btn btn-danger'   href='#'> Closed</a>
                                        </td>";
                                        } else {
                                            echo "<td class='select'>
                                            <a class='btn btn-danger'  id='closesemester' data-id='{$row["batchid"]}' href='#'> Close Semester</a>
                                        </td>";
                                        }
                                        ?>


                                <td class="select">
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-danger">Edit</button>
                                        <button type="button" class="btn btn-warning" id="deleteBatch"
                                            data-id="<?php echo $row['batchid']; ?>">
                                            Remove
                                        </button>

                                    </div>
                                </td>
                            </tr>

                            <?php
                                }
                            } else {
                                echo '<tr>
                        <td data-title="Branch Id">No Batch Found   </td>
            </tr>';
                            }


                            ?>
                        </tbody>
                    </table>
                </main>
            </div>
            <div id="viewbranch">
                <h2>
                    Branch
                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
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
                        <tbody>

                            <?php
                            $sql = $conn->prepare("SELECT * FROM branch WHERE coordinatorid = ?");
                            $sql->bindParam(1, $coordinatorid);
                            $sql->execute();
                            if ($sql->rowCount() > 0) {
                                while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td data-title="Branch ID"><?php echo $row['branchid']; ?> </td>
                                <td data-title="Branch Name">
                                    <?php echo $row['branchname']; ?>
                                </td>
                                <td data-title="Hod"><?php echo $_SESSION['username']; ?></td>
                                <td data-title="Total Semester">
                                    <?php echo $row['totalsemester']; ?>

                                </td>
                                <td class="select">
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-danger">Edit</button>
                                        <button type="button" class="btn btn-warning" id="deleteBranch"
                                            data-id="<?php echo $row['branchid']; ?>">
                                            Delete
                                        </button>

                                    </div>
                                </td>

                            </tr>
                            <?php
                                }
                            } else {
                                echo '<tr>
                <td data-title="Branch Id">No Branch Found  </td>
                 </tr>';
                            }
                            ?>

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
            <button class="maindashbutton menu-button">Main Dashboard</button>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#teacher-to-batch-add">Add
                teacher</button>
            <section>
                <div>
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
                                    <th>Password</th>
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
            <button class="maindashbutton menu-button">Main Dashboard</button>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#student-to-batch-add">Add
                Student</button>
            <section>
                <div>
                    <small class="form-text text-muted">Select the Branch First</small>
                    <select class="selectBranchstudent">
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
                    <select class="addStudentData_batch_Select">
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
        <section class="grid" id="addsubjectsection">
            <button class="maindashbutton menu-button">Main Dashboard</button>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#button-subject-information">Add
                Subject </button>
            <section>
                <div style="  max-height: 700px;
  overflow-y: scroll;">

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
                                    <th>Assign Subject</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <?php
                                    $Sno = 1;
                                    $sql = $conn->prepare("SELECT * FROM `subject` WHERE `coordinatorid` = ?");
                                    $sql->bindParam(1, $coordinatorid);
                                    $sql->execute();
                                    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {

                                    ?>
                                    <td data-title="S.No"><?php echo $Sno; ?></td>
                                    <td data-title="Subejct Id"><?php echo $row["subjectid"]; ?></td>
                                    <td data-title="Subject Name"><?php echo $row["subjectname"]; ?></td>
                                    <td data-title="Subject Code"><?php echo $row["subjectcode"]; ?></td>

                                    <td class="select">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-danger">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-warning" id="removesubject"
                                                data-id="<?php echo $row["subjectid"]; ?>">
                                                Remove
                                            </button>
                                            <button type="button" class="btn btn-success clickbutton"
                                                data-bs-toggle="modal" data-bs-target="#subject-information">
                                                More Information
                                            </button>
                                        </div>
                                    <td class="select">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                            <button type="button" class="btn btn-success clickbutton"
                                                data-bs-toggle="modal" data-bs-target="#assign-teacher">
                                                Assign Teacher
                                            </button>
                                        </div>
                                    </td>
                                    </td>
                                </tr>
                                <?php
                                        $Sno++;
                                    }
                            ?>
                            </tbody>
                        </table>
                    </main>
                </div>
            </section>
        </section>
        <section class="grid" id="addsettingsection">
            <button class="maindashbutton menu-button">Main Dashboard</button>
            Add SettingSection
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
                                    <option selected value="0">Select a Branch</option>
                                    <!-- For loop for the Branch Details-->
                                    <?php
                                    $sql_1 = $conn->prepare("SELECT * FROM `branch` WHERE `coordinatorid` = ?");
                                    $sql_1->bindParam(1, $coordinatorid);
                                    $sql_1->execute();
                                    if ($sql_1->rowCount() > 0) {
                                        while ($row_1 = $sql_1->fetch(PDO::FETCH_ASSOC)) {



                                    ?>
                                    <option value="<?php echo $row_1['branchid']; ?>">
                                        <?php echo $row_1['branchname']; ?></option>

                                    <?php
                                        }
                                    }
                                    ?>
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
    <div class="modal fade" id="teacher-information" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Teacher Information
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
        <div class="modal-dialog">
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
        <div class="modal-dialog">
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

    $(document).on("click", "#opensemester", function(event) {
        var batchid = $(this).data("id");
        sendactivesemester(batchid);

    });
    $(document).on("click", "#closesemester", function(event) {
        var batchid = $(this).data("id");
        sendactivesemester(batchid);


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
        if (subejctid == 0 || teacherid == 0) {

            $("#messagesubjects").html("*Select a Subject and Teacher");
        } else {
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
                            "Subjectt Assigned Sucessfully!*Refresh page to see changes ",
                            "success");
                        $("#messagesubjects").html("*Refresh page to see change");

                    } else {
                        swal("ohoho!", "Something went wrong! try again later", "error");

                    }
                }

            });

        }
    });


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
                    swal("Good Job!", "First Semester of the Batch has been Opened ", "success");
                    setTimeout(() => {
                        location.reload();
                    }, 5000);

                } else if (data == 5) {
                    swal("Good job ",
                        "Batch has been Closed...!",
                        "success");
                    setTimeout(() => {
                        location.reload();
                    }, 5000);
                } else if (data == 4) {
                    swal("Good job ",
                        "Previous semester has been Closed and New Semester has be Opend!",
                        "success");
                    setTimeout(() => {
                        location.reload();
                    }, 5000);
                } else {
                    swal("ohoho!", "Something went wrong! try again later", "error");
                    $("#sendBranch").html("Add Branch");
                }
            }



        });
    }
});
</script>

</html>
<?php
$conn = null;
?>