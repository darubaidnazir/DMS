<?php
session_start();
$teacherid = $_SESSION['teacheruserid'];
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

    <title>Teacher Dashboard</title>
</head>
<style>
#addbatchview {
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
    <div id="cover"> <span class="glyphicon glyphicon-refresh w3-spin preloader-Icon"></span> Wait!<br>While we are
        Fetching<br>
        Data From the Server...</div>
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
                    <a href="#0">
                        <svg>
                            <use xlink:href="#home"></use>
                        </svg>
                        <span class="maindashbutton"> Home</span>
                    </a>
                </li>
                <li>
                    <a href="#0">
                        <svg>
                            <use xlink:href="#pages"></use>
                        </svg>
                        <span id="addbatch" class="menu_button">Lecture Plan</span>
                    </a>
                </li>


                <li class="menu-heading">
                    <h3>Settings</h3>
                </li>

                <li>
                    <a href="#0">
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
                <span class="greeting">Hello,

                </span>
                <span class="tag-wrap">
                    <span class="tag">
                        <?php echo $_SESSION['teacherusername']; ?>
                        <form>
                            <input type="hidden" id="teacher_hidden" value="<?php echo $teacherid; ?>" />
                        </form>
                    </span>
                </span>
            </div>
        </section>
        <section id="maindashboardsection">
            <?php require_once("../teacher/loaddata/loadactivesemester.php"); ?>


        </section>
        <section class="grid" id="addbatchsection">
            <div class="text-center maintable">
                <p>
                    <lable class="text-uppercase" style="color:blue;font-weight:bold">Select a Subject to View Lecture
                        details.</lable>

                    <select class="form-control" aria-label="Default select example" id='subjectlecture'>
                        <option selected value="0">Select a Subject</option>
                        <?php
                        $sql1 = $conn->prepare("select * FROM `subject` INNER join `assignedsubject` on subject.subjectid = assignedsubject.subjectid  INNER join `semester` on assignedsubject.semesterid = semester.semesterid WHERE assignedsubject.teacherid = ? && semester.semesterstatus = 1");
                        $sql1->bindParam(1, $teacherid);
                        $sql1->execute();
                        $resulttable = $sql1->fetchAll(PDO::FETCH_ASSOC);
                        $string = "";
                        foreach ($resulttable as $row) {
                            $string .=  $row['subjectname'];
                            $string .= "-";
                            $string .=  $row['subjectcode'];

                        ?>
                        <option data-city="<?php echo $row['semesterid']; ?>" value="<?php echo $row['subjectid']; ?>">
                            <?php echo $string; ?></option>

                        <?php
                            $string = "";
                        }
                        ?>
                        < </select>
                            <small id="mm" style="color:red;"></small>
                </p>

                <main>
                    <table>
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Lecture Topic</th>
                                <th>Lecture Hour</th>
                                <th>Lecture Date</th>
                                <th>Total Student</th>
                                <th>Present</th>
                                <th>Absent</th>


                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="3"></th>
                            </tr>
                        </tfoot>
                        <tbody id="addlecturetable">

                        </tbody>

                    </table>
                </main>
            </div>
        </section>
        <section class="grid" id="addsettingsection">
            setting
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

</body>

</html>

<script src="../coordinator/dash.js"></script>
<script src="javascipt/dashboard.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>
<script>
$("#subjectlecture").on("change", function() {
    var value = $(this).val();
    var semesterid = $(this).find(':selected').data('city');

    if (value == 0) {

        $("#mm").html("* Select a Subject");

    } else {

        $("#mm").html("");
        viewlecturetable(value, semesterid);

    }


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


$(window).on('load', function() {
    $("#cover").fadeOut(5000);
});
</script>
<?php
$conn = null;
?>