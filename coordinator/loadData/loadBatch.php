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
                        <a class='btn btn-primary' href='#' id='opensemester' data-id='{$row["batchid"]}'> Open Semester</a>
                    </td>";
                } else if ($row['currentsemester'] > $row['totalsemester'] || $row["batchstatus"] == 0) {
                    $output .= "<td class='select'>
                        <a class='btn btn-danger'   href='#'> Closed</a>
                    </td>";
                } else {
                    $output .= "<td class='select'>
                        <a class='btn btn-danger'  id='closesemester' data-id='{$row["batchid"]}' href='#'> Close Semester</a>
                    </td>";
                }



                $output .= "<td class='select'>
    <div class='btn-group' role='group' aria-label='Basic mixed styles example'>
        <button type='button' class='btn btn-danger'>Edit</button>
        <button type='button' class='btn btn-warning' id='deleteBatch' data-id='{$row['batchid']}'>
Remove
</button>

</div>
</td>
</tr>";
            }
        } else {
            $output .= "<tr>
    <td data-title='Branch Id'>No Batch Found   </td>
</tr>";
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