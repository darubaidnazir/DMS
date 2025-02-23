<?php
require_once("../../coordinator/inner/db_connection.php");
class loadBatch extends db_connection
{

    function  __construct($getcoordinatorid)
    {

        parent::__construct();
        $output = "";
        $message = "";
        $sql = $this->conn->prepare("SELECT * FROM `batch` INNER JOIN `branch` ON batch.branchid = branch.branchid WHERE branch.coordinatorid = ? ");
        $sql->bindParam(1, $getcoordinatorid);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $sqll = $this->conn->prepare("SELECT * FROM `student` WHERE `batchid` = ?");
                $sqll->bindParam(1, $row['batchid']);
                $sqll->execute();
                $totalstudent = $sqll->rowCount();



                $output .= "<tr>
            <td data-title='Batch Year'>{$row['batchyear']}</td>
            <td data-title='Branch'>{$row['branchname']}</td>

            <td data-title='Current Semester'>{$row['currentsemester']}</td>
            <td data-title='Total Student's'>{$totalstudent}</td>
            <td data-title='Add Student'>
            <button class='btn btn-warning m-2 btn-sm' data-bs-toggle='modal' data-bs-target='#student-to-batch-add'
            id='addstudentbutton'>Add
            Student</button>
            </td>
            <td data-title='Status' style='color: Green'>";
                if ($row['currentsemester'] >= $row['totalsemester'] && $row["batchstatus"] == 0) {
                    $message = "Closed";
                    $output .= "{$message}";
                } else if ($row["batchstatus"] == 0) {
                    $message = "In-active";
                    $output .= "{$message}";
                } else {
                    $message = "Active";
                    $output .= "{$message}";
                }

                $output .= "</td>";
                if ($row['currentsemester'] == 0) {
                    $output .= "<td class='select'>
                        <a class='btn btn-primary btn-sm' href='#' id='opensemester' data-id='{$row["batchid"]}'> Open Semester</a>
                    </td>";
                } else if ($row['currentsemester'] > $row['totalsemester'] || $row["batchstatus"] == 0) {
                    $output .= "<td class='select'>
                        <a class='btn btn-danger btn-sm'   href='#'> Closed</a>
                    </td>";
                } else {
                    $output .= "<td class='select'>
                        <a class='btn btn-danger btn-sm'  id='closesemester' data-id='{$row["batchid"]}' href='#'> Close Semester</a>
                    </td>";
                }



                $output .= "<td class='select'>
    <span class='btn-group' role='group' aria-label='Basic mixed styles example'>
       
        <button type='button' class='btn btn-warning btn-sm' id='deleteBatch' data-id='{$row['batchid']}'>
Remove Batch
</button>

</span>
</td>
</tr>";
            }
        } else {
        }

        echo $output;
    }
}



if (isset($_POST['connection']) && isset($_POST['get_Coordinatorid'])) {
    $run = new loadBatch($_POST['get_Coordinatorid']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}