<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<?php
session_start();
if (!isset($_SESSION['active'])) {
    header("Location:http://localhost/DMS/coordinator/coordinatorlogin_signup.html");
}
require_once("../../dbcon.php");
if (isset($_POST['import']) && isset($_POST['batchid'])) {

    $batchid = $_POST['batchid'];
    $sql1 = $conn->prepare("SELECT * FROM `batch` WHERE `batchid` = ?");
    $sql1->bindParam(1, $batchid);
    $sql1->execute();
    $count = $sql1->rowCount();
    if ($count == 1) {
        $fileName = $_FILES["file"]["name"];
        $fileExtension = explode('.', $fileName);
        $fileExtension = strtolower(end($fileExtension));
        $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

        if ($fileExtension != "xlsx") {
            echo '<div class="alert alert-error" role="alert">
            File Extension is wrong try with .xlsx file extension only!!! Click on<a href="http://localhost/DMS/coordinator/dashboard">Dashboard</a> 
          </div>';
        } else {

            $targetDirectory = "uploads/" . $newFileName;
            move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory);

            error_reporting(0);
            ini_set('display_errors', 0);

            require 'excelReader/excel_reader2.php';
            require 'excelReader/SpreadsheetReader.php';

            $reader = new SpreadsheetReader($targetDirectory);
            foreach ($reader as $key => $row) {
                $email = $row[0];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                } else {
                    $sql1 = $conn->prepare("SELECT * FROM `student` WHERE `studentemail` = ?");
                    $sql1->bindParam(1, $email);
                    $sql1->execute();
                    $countemail = $sql1->rowCount();
                    if ($countemail > 0) {
                    } else {
                        $sql = $conn->prepare("INSERT INTO `student`(`studentemail`,`batchid`) VALUES (?,?)");
                        $sql->bindParam(1, $email);
                        $sql->bindParam(2, $batchid);
                        $sql->execute();
                    }
                }

                $createDeletePath = "uploads/" . $newFileName;
                unlink($createDeletePath);
            }
            echo '<div class="alert alert-success" role="alert">
                Email Has Been Uploaded to the Batch Database!!! Click on<a href="http://localhost/DMS/coordinator/dashboard">Dashboard</a> 
              </div>';
        }
    } else {
        //batch not present
    }
} else {
    header("Location:http://localhost/DMS/coordinator/coordinatorlogin_signup.html");
}