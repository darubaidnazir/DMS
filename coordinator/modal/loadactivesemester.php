<div style="  max-height: 500px;
  overflow-y: scroll;">
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
                <?php
                $sqlnew = $conn->prepare("SELECT * FROM `branch` INNER JOIN `batch` ON branch.branchid = batch.branchid INNER JOIN `semester` ON batch.batchid = semester.batchid  WHERE branch.coordinatorid = ?");
                $sqlnew->bindParam(1, $coordinatorid);
                $sqlnew->execute();
                $resultall = $sqlnew->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultall as $row) {
                    if ($row["semesterstatus"] == 1) {
                ?>
                <tr>
                    <td data-title="Batch Year"><?php echo $row['batchyear']; ?>
                    </td>
                    <td data-title="Branch Name"><?php echo $row['branchname']; ?></td>
                    <td data-title="Current Semester"><?php echo $row['currentsemester']; ?></td>
                    <td data-title="Total Student's"><?php echo $row['semesterid']; ?></td>
                    <td data-title="Starting Date"><?php echo $row['opendate']; ?></td>
                    <td data-title="Closing Date"><?php echo $row['closedate']; ?></td>

                    <td class="select">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-success clickbutton" data-bs-toggle="modal"
                                data-bs-target="#active-information-box">
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

<div style="  max-height: 500px;
  overflow-y: scroll;">
    <h2>Closed Semester</h2>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Batch Year</th>
                    <th>Branch Name</th>
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
                ?>
                <tr>
                    <td data-title="Batch Year"><?php echo $row['batchyear']; ?>
                    </td>
                    <td data-title="Branch Name"><?php echo $row['branchname']; ?></td>
                    <td data-title="Current Semester"><?php echo $row['semesterno']; ?></td>
                    <td data-title="Total Student's"><?php echo $row['semesterid']; ?></td>
                    <td data-title="Starting Date"><?php echo $row['opendate']; ?></td>
                    <td data-title="Closing Date"><?php echo $row['closedate']; ?></td>

                    <td class="select">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-success clickbutton" data-bs-toggle="modal"
                                data-bs-target="#active-information-box">
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