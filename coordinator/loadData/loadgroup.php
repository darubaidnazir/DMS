<?php
session_start();
if (!isset($_SESSION['active']) || !isset($_POST['batchid'])) {
    header("../../coordinator/coordinatorlogin_signup.html");
    die();
}
require_once("../../coordinator/dbcon.php");
$sql = $conn->prepare("SELECT * FROM `student` WHERE `batchid` = ?  ORDER BY `studentrollno` ASC");
$sql->bindParam(1, $_POST['batchid']);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$output = "<span class='modalattendance text-center'>   <span class='text-center'><span id='mess' style='color:red;'></span><select class='form-control' style='width:50%;margin:0 auto;' id='group_id'>
<option value='0'>Select a Group</option>
<option value='G1'>G1</option>
<option value='G2'>G2</option>

</select>
<h4>Select a Group</h4>
</span>";
foreach ($result as $row) {
    $dash = " - ";
    $output .= "<span><label  class='attendancebutton'>{$row['studentrollno']}{$dash}{$row['group_id']}
        <input style='all: revert;' type='checkbox' id='checkbox1'  value='{$row['studentid']}'>



</label></span>";
    unset($my_array1);
}
$output .= "</span><span class='text-center'><br>
<button id='send_group' class='btn btn-danger'>Send Group</button>
</span>";

echo $output;
$conn = null;