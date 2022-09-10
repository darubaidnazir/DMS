<?php

if (!isset($_SESSION['active'])) {
    header("Location../../teacher/teacherlogin.html");
    die();
}


?>
<style>
.maintable {
    max-height: 700px;
    overflow-y: scroll;
    padding: 10px;
    margin: 5px;
    box-shadow: rgb(0 0 0 / 25%) 0px 54px 55px, rgb(0 0 0 / 12%) 0px -12px 30px, rgb(0 0 0 / 12%) 0px 4px 6px, rgb(0 0 0 / 17%) 0px 12px 13px, rgb(0 0 0 / 9%) 0px -3px 5px;
}
</style>

<div class="maintable">
    <h2>Active Semester</h2>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Batch Year</th>
                    <th>Program Name</th>
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
                <?php
                $sqlnew = $conn->prepare("SELECT * FROM  teacher INNER join coordinator on teacher.coordinatorid = coordinator.coordinatiorid INNER join branch on branch.coordinatorid = coordinator.coordinatiorid INNER join batch on batch.branchid = branch.branchid INNER join semester on batch.batchid = semester.batchid WHERE teacher.teacherid = ?");
                $sqlnew->bindParam(1, $teacherid);
                $sqlnew->execute();
                $resultall = $sqlnew->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultall as $row) {
                    if ($row["semesterstatus"] == 1) {
                        $batchidcount =  $row['batchid'];
                        $sqlpre = $conn->prepare("SELECT * FROM `student` WHERE `batchid` = ?");
                        $sqlpre->bindParam(1, $batchidcount);
                        $sqlpre->execute();
                        $totalstudent = $sqlpre->rowCount();



                ?>
                <tr>
                    <td data-title="Batch Year"><?php echo $row['batchyear']; ?>
                    </td>
                    <td data-title="Program Name"><?php echo $row['branchname']; ?></td>
                    <td data-title="Current Semester"><?php echo $row['currentsemester']; ?></td>
                    <td data-title="Total Student's"><?php echo $totalstudent; ?> </td>
                    <td data-title="Starting Date"><?php echo $row['opendate']; ?></td>
                    <td data-title="Closing Date"><?php echo $row['closedate']; ?></td>

                    <td class="select">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button id="assignsubjectbox" data-id="<?php echo $row['semesterid']; ?>" type="button"
                                class="btn btn-success clickbutton" data-bs-toggle="modal"
                                data-bs-target="#assign-teacher">
                                Subject assigned
                            </button>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
</div>

<div class="maintable">
    <h2>Closed Semester</h2>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Batch Year</th>
                    <th>Program Name</th>
                    <th> Semester No</th>
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
                <?php

                foreach ($resultall as $row) {
                    if ($row["semesterstatus"] == 0) {
                        $batchidcount =  $row['batchid'];
                        $sqlpre = $conn->prepare("SELECT * FROM `student` WHERE `batchid` = ?");
                        $sqlpre->bindParam(1, $batchidcount);
                        $sqlpre->execute();
                        $totalstudent = $sqlpre->rowCount();
                ?>
                <tr>
                    <td data-title="Batch Year"><?php echo $row['batchyear']; ?>
                    </td>
                    <td data-title="Program Name"><?php echo $row['branchname']; ?></td>
                    <td data-title="Current Semester"><?php echo $row['semesterno']; ?></td>
                    <td data-title="Total Student's"><?php echo $totalstudent; ?></td>
                    <td data-title="Starting Date"><?php echo $row['opendate']; ?></td>
                    <td data-title="Closing Date"><?php echo $row['closedate']; ?></td>

                    <td class="select">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-success clickbutton" data-bs-toggle="modal"
                                data-bs-target="#active-informatison-box">
                                More Information
                            </button>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
</div>

<script>
$(document).on("click", "#assignsubjectbox", function() {
    var semesterid = $(this).data("id");
    var teacherid = $("#teacher_hidden").val();
    assignsubjectbox(semesterid, teacherid);

});



function assignsubjectbox(semesterid, teacherid) {
    $.ajax({

        url: "loaddata/load.php",
        type: "POST",
        data: {
            get_Semesterid: semesterid,
            get_Teacherid: teacherid,
            connection: true
        },
        success: function(data) {

            $("#modal-body-assign-teacher").html(data);
        }


    });
}
</script>