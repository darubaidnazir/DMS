<?php
session_start();

use SimpleExcel\SimpleExcel;

if (!isset($_SESSION['active']) || !isset($_FILES['image']) || !isset($_POST['batchid'])) {
    header("Location:http://localhost/DMS/coordinator/coordinatorlogin_signup.html");
}
require_once("../../../coordinator/dbcon.php");

$batchid = $_POST['batchid'];
$sql1 = $conn->prepare("SELECT * FROM `batch` WHERE `batchid` = ?");
$sql1->bindParam(1, $batchid);
$sql1->execute();
$count = $sql1->rowCount();
if ($count == 1) {

    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $fileExtension = explode('.', $img);
    $fileExtension = strtolower(end($fileExtension));
    if ($fileExtension != "csv") {
        echo 7; //file extension not match
    } else {
        if (move_uploaded_file($tmp, $img)) {
            error_reporting(0);
            ini_set('display_errors', 0);
            require_once('SimpleExcel/SimpleExcel.php');
            $count = 0;
            $excel = new SimpleExcel('csv');

            $excel->parser->loadFile($img);
            $foo = $excel->parser->getColumn(1);
            foreach ($foo as $email) {
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
                        $count++;
                    }
                }
            }
            $location_with_image_name = $img;
            if (file_exists($location_with_image_name)) {
                $delete  = unlink($location_with_image_name);
                if ($delete) {
                    echo 3;
                } else {
                    echo 4;
                }
            }

            echo $output;
        } else {
            echo 1; // file uploaded failed
        }
    }
} else {
    echo 2; // batch does not exits
}