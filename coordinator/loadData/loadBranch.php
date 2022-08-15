<?php
require_once("../../coordinator/inner/db_connection.php");
session_start();
class loadBranch extends db_connection
{

    function  __construct($getcoordinatorid)
    {
        parent::__construct();
        $output = "";
        $sql = $this->conn->prepare("SELECT * FROM branch WHERE coordinatorid = ?");
        $sql->bindParam(1, $getcoordinatorid);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {

                $output .= "<tr>
            <td data-title='Branch ID'>{$row['branchid']}</td>
            <td data-title='Branch Name'>
                {$row['branchname']}
            </td>
            <td data-title='Hod'>{$_SESSION['username']}</td>
            <td data-title='Total Semester'>
                {$row['totalsemester']}

            </td>
            <td class='select'>
                <div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                    <button type='button' class='btn btn-danger'>Edit</button>
                    <button type='button' class='btn btn-warning' id='deleteBranch'
                        data-id='{$row['branchid']}'>
                        Delete
                    </button>

                </div>
            </td>
           </tr>";
            }
        } else {
            $output .= "<tr>
            <td data-title='Branch Id'>No Branch Found  </td>
         </tr>";
        }

        echo $output;
    }
}



if (isset($_POST['connection']) && isset($_POST['get_Coordinatorid'])) {
    $run =  new loadBranch($_POST['get_Coordinatorid']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}