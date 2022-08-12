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
                        <span id="addbatch" class="menu_button">Add Batch</span>
                    </a>
                </li>
                <li>
                    <a href="#0">
                        <svg>
                            <use xlink:href="#users"></use>
                        </svg>
                        <span id="addstudent" class="menu_button">Add Student</span>
                    </a>
                </li>

                <li>
                    <a href="#0">
                        <svg>
                            <use xlink:href="#users"></use>
                        </svg>
                        <span id="addteacher" class="menu_button">Add Teacher</span>
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
                        <span id="addsubject" class="menu_button">Add Subject</span>
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
                <span class="greeting">Hello <?php
                                                echo $_SESSION['userid'];
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
            <button id="addbranchview" class="btn btn-dark">View Branch</button>
            <button id="addbatchview" class="btn btn-dark">View Batch</button>
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
                    <table>
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
                                <td data-title="Status" style="color: Green">in-active</td>
                                <td class="select">
                                    <a class="btn btn-primary" href="#"> Open Semester</a>
                                </td>
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
                                    <th>Teacher Name</th>
                                    <th>Teacher Code</th>
                                    <th>Teacher Dob</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td data-title="S.No">1</td>
                                    <td data-title="Teacher Id">1552</td>
                                    <td data-title="Teacher Id">Er. Hesam Akhter</td>
                                    <td data-title="Teacher Enrollment">EMP708</td>
                                    <td data-title="Teacher Dob">01-04-1970</td>
                                    <td class="select">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-danger">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-warning">
                                                Remove
                                            </button>
                                            <button type="button" class="btn btn-success clickbutton"
                                                data-bs-toggle="modal" data-bs-target="#teacher-information">
                                                More Information
                                            </button>
                                        </div>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#subject-assigned-to-teacher">
                                                Subject assigned
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                                    <td colspan="6">
                                        <div id="pagination" style="text-align:center;">
                                            <a class="btn btn-secondary" id="1" href="">1</a>
                                            <a class="btn btn-secondary" id="2" href="">2</a>

                                        </div>
                                    </td>
                                </tr>
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
        <section class="grid" id="addactivesemestersection">
            <button class="maindashbutton">Main Dashboard</button>
            <div>
                <h2>Active Semester</h2>

                <main>
                    <table>
                        <thead>
                            <tr>
                                <th>Batch Year</th>
                                <th>Branch Name</th>
                                <th>Current Semester</th>
                                <th>Total Student's</th>
                                <th>Starting Date</th>
                                <th>Closing Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="3"></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td data-title="Batch Year">2018</td>
                                <td data-title="Branch Name">BTech</td>
                                <td data-title="Current Semester">1</td>
                                <td data-title="Total Student's">60</td>
                                <td data-title="Starting Date">01-05-2022</td>
                                <td data-title="Closing Date">01-10-2022</td>

                                <td class="select">
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-success clickbutton" data-bs-toggle="modal"
                                            data-bs-target="#active-information-box">
                                            More Information
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </main>
            </div>
        </section>
        <section class="grid" id="addsubjectsection">
            <button class="maindashbutton menu-button">Main Dashboard</button>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#button-subject-information">Add
                Subject to a Semester</button>
            <section>
                <div>
                    <small class="form-text text-muted">Select the Branch First</small>
                    <select>
                        <option value="0">Select Branch:</option>
                        <option value="1">MTech</option>
                        <option value="2">BTech</option>
                    </select>
                    <small class="form-text text-muted">Select the Batch</small>
                    <select>
                        <option value="0">Select Batch:</option>
                        <option value="1">2018</option>
                        <option value="2">2019</option>
                    </select>
                    <small class="form-text text-muted">Select the Semester No to View Subjet's</small>
                    <select>
                        <option value="0">Select Semester No:</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>

                    <main>
                        <table>
                            <thead>
                                <tr><span style="color:green;"> Selected Semester: Mtech / 2018 / 1-Semester </span>
                                </tr>
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
                                    <td data-title="S.No">1</td>
                                    <td data-title="Subejct Id">1010010</td>
                                    <td data-title="Subject Name">DataBase</td>
                                    <td data-title="Subject Code">CSE-1717</td>

                                    <td class="select">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-danger">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-warning">
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
                <div class="modal-body"></div>

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
                        Active Semester Information
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
    <!-- Active Semester  informationModal End-->
    <!-- Assign teacher Information Modal -->
    <div class="modal fade" id="assign-teacher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Assign Subject to Teacher
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
    <!-- Assign Teacher  informationModal End-->
    <!-- Add Subject  Information Modal -->
    <div class="modal fade" id="button-subject-information" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Add Subejct's to Semester
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row py-5 m-3 forms" id="form">
                        <div class="col-md-10">
                            <div class="form-group mt-2">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Select a Branch</option>
                                    <option value="1">Mtech</option>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Select a Batch</option>
                                    <option value="1">2018</option>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Select a Semester</option>
                                    <option value="1">1</option>
                                </select>
                            </div>



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
                                <button class="btn btn-primary">Add Subject</button>
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
    <!-- Add teacher Information Modal -->
    <div class="modal fade" id="teacher-to-batch-add" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Add teacher
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row py-5 m-3 forms" id="form">
                        <div class="col-md-10">

                            <div class="form-group mt-2">
                                <lable>Enter Username of Teacher</lable>
                                <input type="email" class="form-control" id="enter-teacher-username"
                                    placeholder="eg: waseembakshi121">
                            </div>
                            <small class="form-text text-muted mt-1">
                                Enter a valid username
                            </small>
                            <div class="form-group mt-2">
                                <lable>Enter Employee ID of Teacher</lable>
                                <input type="text" class="form-control" id="enter-emp-id" placeholder="eg: Emp-121">
                            </div>
                            <small class="form-text text-muted mt-1">
                                Enter a valid Employee ID
                            </small>
                            <div class="form-group mt-2">
                                <lable>Enter Position of the Teacher</lable>
                                <input type="text" class="form-control" id="enter-emp-id"
                                    placeholder="eg: Assistant Professor / Contracual Employee">
                            </div>
                            <div class="form-group mt-2">
                                <lable>Enter Phone Number of the Teacher</lable>
                                <input type="text" class="form-control" id="enter-phonenumber"
                                    placeholder="eg: 9622922604">
                            </div>

                            <small class="form-text text-muted mt-1">
                                Enter a valid Phone Number
                            </small>



                            <div class="form-group pt-3">
                                <button class="btn btn-primary">Add Teacher</button>
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
    <!-- Add Student  informationModal End-->
</body>
<script src="dash.js"></script>

<script>
$(document).ready(function() {
    var myArray = new Array();
    myArray[0] = "addstudentsection";
    myArray[1] = "addsettingsection";
    myArray[2] = "addbatchsection";
    myArray[3] = "addteachersection";
    myArray[4] = "addactivesemestersection";
    myArray[5] = "addsubjectsection";
    $(".menu_button").click(function() {
        $("#maindashboardsection").css("display", "none");
        var getId = this.id;
        alert(getId);
        if (getId == "addbatch") {
            getId = "addbatchsection";
        } else if (getId == "addstudent") {
            getId = "addstudentsection";
            //  loadDataStudent();
        } else if (getId == "addteacher") {
            getId = "addteachersection";
        } else if (getId == "activesemster") {
            getId = "addactivesemestersection";
        } else if (getId == "addsetting") {
            getId = "addsettingsection";
        } else if (getId == "addsubject") {
            getId = "addsubjectsection";
        }

        for (var i = 0; i < myArray.length; i++) {
            if (myArray[i] == getId) {
                continue;
            } else {
                $("#" + myArray[i]).css("display", "none");
            }
        }
        $("#" + getId).css("display", "block");
    });
    $(".maindashbutton").click(function() {
        alert("main");
        for (var i = 0; i < myArray.length; i++) {
            $("#" + myArray[i]).css("display", "none");
        }
        $("#maindashboardsection").css("display", "grid");
    });

    $(".selectBranchstudent").change(function() {
        var getBranchid = $(this).val();
        // alert(getBranchid);
        $(".addStudentData_batch_Select").prop('selectedIndex', 0);
        $(".addStudentData_batch_Select").html(' <option selected value="0">Select a Batch</option>');
        if (getBranchid == 0) {

        } else {

            $.ajax({
                url: "loadData/loadStudentData_batch.php",
                type: "POST",
                data: {
                    get_Branchid: getBranchid,
                    connection: true
                },
                success: function(data) {
                    $(".addStudentData_batch_Select").append(data);


                }
            });
        }
    });

    $(".addStudentData_batch_Select").change(function() {
        var getBatchid = $(this).val();
        var getBranchid = $(".selectBranchstudent").val();
        //alert(getBatchid);
        //alert(getBranchid);

        if (getBatchid == 0) {

        } else {
            loadDataStudent(getBatchid, 1);
        }



    });



});
$(document).on('click', "#pagination a", function(e) {
    e.preventDefault();
    var page_id = $(this).attr("id");
    var batchid = $(".addStudentData_batch_Select").val();
    //alert(page_id);
    loadDataStudent(batchid, page_id)


});

function loadDataStudent(get_batchid, pageno) {

    var getBatchid = get_batchid;
    var page_no = pageno;

    // var getBranchid = get_branchid;
    alert(getBatchid);
    // alert(getBranchid);

    $.ajax({
        url: "loadData/loadDataStudent.php",
        type: "POST",
        data: {
            get_Batchid: getBatchid,
            get_pageno: page_no,
            connection: true
        },
        success: function(data) {
            $("#addStudentData").html(data);

        }


    });
}
$(window).on('load', function() {
    $("#cover").fadeOut(5000);
});
</script>
<script src="javascript/send.js"></script>
<script src="javascript/dashboard.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>

</html>