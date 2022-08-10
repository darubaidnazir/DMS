<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS only -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="table.css" />
    <link rel="stylesheet" href="dash.css" />

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
</style>

<body>
    <svg style="display: none">
        <symbol id="down" viewBox="0 0 16 16">
            <polygon points="3.81 4.38 8 8.57 12.19 4.38 13.71 5.91 8 11.62 2.29 5.91 3.81 4.38" />
        </symbol>
        <symbol id="users" viewBox="0 0 16 16">
            <path
                d="M8,0a8,8,0,1,0,8,8A8,8,0,0,0,8,0ZM8,15a7,7,0,0,1-5.19-2.32,2.71,2.71,0,0,1,1.7-1,13.11,13.11,0,0,0,1.29-.28,2.32,2.32,0,0,0,.94-.34,1.17,1.17,0,0,0-.27-.7h0A3.61,3.61,0,0,1,5.15,7.49,3.18,3.18,0,0,1,8,4.07a3.18,3.18,0,0,1,2.86,3.42,3.6,3.6,0,0,1-1.32,2.88h0a1.13,1.13,0,0,0-.27.69,2.68,2.68,0,0,0,.93.31,10.81,10.81,0,0,0,1.28.23,2.63,2.63,0,0,1,1.78,1A7,7,0,0,1,8,15Z" />
        </symbol>
        <symbol id="collection" viewBox="0 0 16 16">
            <rect width="7" height="7" />
            <rect y="9" width="7" height="7" />
            <rect x="9" width="7" height="7" />
            <rect x="9" y="9" width="7" height="7" />
        </symbol>
        <symbol id="charts" viewBox="0 0 16 16">
            <polygon
                points="0.64 7.38 -0.02 6.63 2.55 4.38 4.57 5.93 9.25 0.78 12.97 4.37 15.37 2.31 16.02 3.07 12.94 5.72 9.29 2.21 4.69 7.29 2.59 5.67 0.64 7.38" />
            <rect y="9" width="2" height="7" />
            <rect x="12" y="8" width="2" height="8" />
            <rect x="8" y="6" width="2" height="10" />
            <rect x="4" y="11" width="2" height="5" />
        </symbol>
        <symbol id="comments" viewBox="0 0 16 16">
            <path d="M0,16.13V2H15V13H5.24ZM1,3V14.37L5,12h9V3Z" />
            <rect x="3" y="5" width="9" height="1" />
            <rect x="3" y="7" width="7" height="1" />
            <rect x="3" y="9" width="5" height="1" />
        </symbol>
        <symbol id="pages" viewBox="0 0 16 16">
            <rect x="4" width="12" height="12" transform="translate(20 12) rotate(-180)" />
            <polygon points="2 14 2 2 0 2 0 14 0 16 2 16 14 16 14 14 2 14" />
        </symbol>
        <symbol id="appearance" viewBox="0 0 16 16">
            <path
                d="M3,0V7A2,2,0,0,0,5,9H6v5a2,2,0,0,0,4,0V9h1a2,2,0,0,0,2-2V0Zm9,7a1,1,0,0,1-1,1H9v6a1,1,0,0,1-2,0V8H5A1,1,0,0,1,4,7V6h8ZM4,5V1H6V4H7V1H9V4h1V1h2V5Z" />
        </symbol>
        <symbol id="trends" viewBox="0 0 16 16">
            <polygon
                points="0.64 11.85 -0.02 11.1 2.55 8.85 4.57 10.4 9.25 5.25 12.97 8.84 15.37 6.79 16.02 7.54 12.94 10.2 9.29 6.68 4.69 11.76 2.59 10.14 0.64 11.85" />
        </symbol>
        <symbol id="settings" viewBox="0 0 16 16">
            <rect x="9.78" y="5.34" width="1" height="7.97" />
            <polygon points="7.79 6.07 10.28 1.75 12.77 6.07 7.79 6.07" />
            <rect x="4.16" y="1.75" width="1" height="7.97" />
            <polygon points="7.15 8.99 4.66 13.31 2.16 8.99 7.15 8.99" />
            <rect x="1.28" width="1" height="4.97" />
            <polygon points="3.28 4.53 1.78 7.13 0.28 4.53 3.28 4.53" />
            <rect x="12.84" y="11.03" width="1" height="4.97" />
            <polygon points="11.85 11.47 13.34 8.88 14.84 11.47 11.85 11.47" />
        </symbol>
        <symbol id="options" viewBox="0 0 16 16">
            <path d="M8,11a3,3,0,1,1,3-3A3,3,0,0,1,8,11ZM8,6a2,2,0,1,0,2,2A2,2,0,0,0,8,6Z" />
            <path
                d="M8.5,16h-1A1.5,1.5,0,0,1,6,14.5v-.85a5.91,5.91,0,0,1-.58-.24l-.6.6A1.54,1.54,0,0,1,2.7,14L2,13.3a1.5,1.5,0,0,1,0-2.12l.6-.6A5.91,5.91,0,0,1,2.35,10H1.5A1.5,1.5,0,0,1,0,8.5v-1A1.5,1.5,0,0,1,1.5,6h.85a5.91,5.91,0,0,1,.24-.58L2,4.82A1.5,1.5,0,0,1,2,2.7L2.7,2A1.54,1.54,0,0,1,4.82,2l.6.6A5.91,5.91,0,0,1,6,2.35V1.5A1.5,1.5,0,0,1,7.5,0h1A1.5,1.5,0,0,1,10,1.5v.85a5.91,5.91,0,0,1,.58.24l.6-.6A1.54,1.54,0,0,1,13.3,2L14,2.7a1.5,1.5,0,0,1,0,2.12l-.6.6a5.91,5.91,0,0,1,.24.58h.85A1.5,1.5,0,0,1,16,7.5v1A1.5,1.5,0,0,1,14.5,10h-.85a5.91,5.91,0,0,1-.24.58l.6.6a1.5,1.5,0,0,1,0,2.12L13.3,14a1.54,1.54,0,0,1-2.12,0l-.6-.6a5.91,5.91,0,0,1-.58.24v.85A1.5,1.5,0,0,1,8.5,16ZM5.23,12.18l.33.18a4.94,4.94,0,0,0,1.07.44l.36.1V14.5a.5.5,0,0,0,.5.5h1a.5.5,0,0,0,.5-.5V12.91l.36-.1a4.94,4.94,0,0,0,1.07-.44l.33-.18,1.12,1.12a.51.51,0,0,0,.71,0l.71-.71a.5.5,0,0,0,0-.71l-1.12-1.12.18-.33a4.94,4.94,0,0,0,.44-1.07l.1-.36H14.5a.5.5,0,0,0,.5-.5v-1a.5.5,0,0,0-.5-.5H12.91l-.1-.36a4.94,4.94,0,0,0-.44-1.07l-.18-.33L13.3,4.11a.5.5,0,0,0,0-.71L12.6,2.7a.51.51,0,0,0-.71,0L10.77,3.82l-.33-.18a4.94,4.94,0,0,0-1.07-.44L9,3.09V1.5A.5.5,0,0,0,8.5,1h-1a.5.5,0,0,0-.5.5V3.09l-.36.1a4.94,4.94,0,0,0-1.07.44l-.33.18L4.11,2.7a.51.51,0,0,0-.71,0L2.7,3.4a.5.5,0,0,0,0,.71L3.82,5.23l-.18.33a4.94,4.94,0,0,0-.44,1.07L3.09,7H1.5a.5.5,0,0,0-.5.5v1a.5.5,0,0,0,.5.5H3.09l.1.36a4.94,4.94,0,0,0,.44,1.07l.18.33L2.7,11.89a.5.5,0,0,0,0,.71l.71.71a.51.51,0,0,0,.71,0Z" />
        </symbol>
        <symbol id="collapse" viewBox="0 0 16 16">
            <polygon points="11.62 3.81 7.43 8 11.62 12.19 10.09 13.71 4.38 8 10.09 2.29 11.62 3.81" />
        </symbol>
        <symbol id="search" viewBox="0 0 16 16">
            <path
                d="M6.57,1A5.57,5.57,0,1,1,1,6.57,5.57,5.57,0,0,1,6.57,1m0-1a6.57,6.57,0,1,0,6.57,6.57A6.57,6.57,0,0,0,6.57,0Z" />
            <rect x="11.84" y="9.87" width="2" height="5.93" transform="translate(-5.32 12.84) rotate(-45)" />
        </symbol>
    </svg>
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
                                <th>Branch Coordinator</th>
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
                            <tr>
                                <td data-title="Batch Year">2018</td>
                                <td data-title="Branch">BTech</td>
                                <td data-title="Batch Coordinator">Dr. Waseem</td>
                                <td data-title="Current Semester">0</td>
                                <td data-title="Total Student's">60</td>
                                <td data-title="Status" style="color: Green">in-active</td>
                                <td class="select">
                                    <a class="btn btn-primary" href="#"> Open Semester</a>
                                </td>
                                <td class="select">
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-danger">Edit</button>
                                        <button type="button" class="btn btn-warning">
                                            Remove
                                        </button>
                                        <button type="button" class="btn btn-success clickbutton" data-bs-toggle="modal"
                                            data-bs-target="#batch-information" ;>
                                            More Information
                                        </button>
                                    </div>
                                </td>
                            </tr>
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
                                <th>Branch Name</th>
                                <th>Hod/Coordinator</th>
                                <th>Infomation</th>
                                <th>Estiblished Year</th>
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
                                <td data-title="Branch Name">MTech</td>
                                <td data-title="Hod">E. Khalid hussain</td>
                                <td data-title="Information">Info</td>
                                <td data-title="year">2022</td>
                                <td class="select">
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-danger">Edit</button>
                                        <button type="button" class="btn btn-warning">
                                            Remove
                                        </button>
                                        <button type="button" class="btn btn-success clickbutton" data-bs-toggle="modal"
                                            data-bs-target="#branch-information">
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
            background-color: black;
            color: white;
            padding: 10px;
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
                    <select>
                        <option value="0">Select Branch:</option>
                        <option value="1">MTech</option>
                        <option value="2">BTech</option>
                    </select>
                    <small class="form-text text-muted">Select the Batch to Show Student's Enrolled</small>
                    <select>
                        <option value="0">Select Batch:</option>
                        <option value="1">2018</option>
                        <option value="2">2019</option>
                    </select>

                    <main>
                        <table>
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Student ID</th>
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
                            <tbody>
                                <tr>
                                    <td data-title="S.No">1</td>
                                    <td data-title="Student Id">1542552</td>
                                    <td data-title="Student Id">Dar Ubaid Nazir</td>
                                    <td data-title="Student Enrollment">18048112009</td>
                                    <td data-title="Student Dob">01-04-2001</td>
                                    <td class="select">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-danger">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-warning">
                                                Remove
                                            </button>
                                            <button type="button" class="btn btn-success clickbutton"
                                                data-bs-toggle="modal" data-bs-target="#student-information">
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
                                <input type="number" class="form-control" id="batch-year" placeholder="eg: 2018" />
                            </div>
                            <small class="form-text text-muted"> Enter a Valid Year </small>

                            <div class="form-group mt-5">
                                <select class="form-select" aria-label="Default select example" id="branch_info">
                                    <option selected value="0">Select a Branch</option>
                                    <!-- For loop for the Branch Details-->
                                    <option value="1">Mtech</option>
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
    <!-- Add Student Information Modal -->
    <div class="modal fade" id="student-to-batch-add" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Add Student
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
                                <lable>Enter Email of Student</lable>
                                <input type="email" class="form-control" id="enter-student-email"
                                    placeholder="eg: example@gmail.com">
                            </div>
                            <small class="form-text text-muted mt-1">
                                Enter a valid Email
                            </small>
                            <div class="form-group mt-2">
                                <lable>Enter Student Date of Birth</lable>
                                <input type="text" class="form-control" id="enter-subject-code"
                                    placeholder="eg: 01-04-2000">
                            </div>
                            <small class="form-text text-muted mt-1">
                                Enter a valid Dob
                            </small>




                            <div class="form-group pt-3">
                                <button class="btn btn-primary">Add Student</button>
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
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
});
</script>
<script src="javascipt/send.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>

</html>