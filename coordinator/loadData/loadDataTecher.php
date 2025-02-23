<?php
require_once("../inner/db_connection.php");
class loadTeacherData extends db_connection
{
    private $getCoordintor;
    public $output = "";
    function __construct($getCoordintor, $getpageno)
    {
        parent::__construct();
        $limitpage = 5;
        $page = $getpageno;
        $offset = ($page - 1) * $limitpage;

        $this->getCoordintor = $getCoordintor;
        $sql = $this->conn->prepare("SELECT * FROM `teacher` WHERE `coordinatorid` = ? LIMIT {$offset} ,{$limitpage}");
        $sql->bindParam(1, $getCoordintor);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        if ($page == 1) {
            $Sno = 1;
        } else {
            $Sno = 5 * $page - 5 + 1;
        }
        foreach ($result as $row) {
            $button = "Remove";
            $position = "Assistant Professor";
            if ($row["teacherposition"] == 2) {
                $position = "Contractual";
            }
            if ($row["teacherstatus"] == "disabled") {
                $button = "disabled";
            }
            $this->output .= "<tr id='{$row["teacherid"]}'>
            <td data-title='S.No'>{$Sno}</td>
            <td data-title='Teacher Id'>{$row["teacherid"]}</td>
            <td data-title='Username'>{$row["teacherusername"]}</td>
            <td data-title=' Emp ID'>{$row["teacherempid"]}</td>
            <td data-title='PhoneNumber'>{$row["teacherphonenumber"]}</td>
            <td data-title='Position'>{$position}</td>

          
            <td class='select'>
                <span class='btn-group' role='group' aria-label='Basic mixed styles example'>
                    <button type='button' class='btn btn-danger btn-sm'>
                        Edit
                    </button>";
            if ($button == "disabled") {

                $this->output .= "<button type='button' disabled class='btn btn-warning btn-sm' data-id='{$row["teacherid"]}'>
            {$button}
        </button>";
            } else {

                $this->output .= "<button style='background-color:white;' type='button' id='removeteacher'class='btn btn-warning btn-sm' data-id='{$row["teacherid"]}'>
            {$button}
               </button>";
            }

            $this->output .= "<button type='button' class='btn btn-success btn-sm clickbutton'
                        data-bs-toggle='modal' data-bs-target='#teacher-information'>
                        More Information
                    </button>
                </span>
                <span class='btn-group' role='group' aria-label='Basic mixed styles example'>
                    <button type='button' class='btn btn-warning btn-sm' id='subjectassignedtoteacher' data-bs-toggle='modal' data-id='{$row["teacherid"]}'
                        data-bs-target='#subject-assigned-to-teacher'>
                        Subject assigned
                    </button>
                </span>
            </td>
        </tr>
        <tr>
";
            $Sno++;
        }
        $sql = $this->conn->prepare("SELECT * FROM `teacher` WHERE `coordinatorid` = ? ");
        $sql->bindParam(1, $getCoordintor);
        $sql->execute();
        $total_records = $sql->rowCount();
        $totalpage = ceil($total_records / $limitpage);



        $this->output .= ' <tr>
                                   
        <td colspan="8">
            <div id="pagination2" style="text-align:center;">';
        for ($i = 1; $i <= $totalpage; $i++) {
            if ($i == $getpageno) {
                $this->output .= "<a class='btn btn-primary' id='{$i}' href=''>{$i}</a> ";
            } else {
                $this->output .= "<a class='btn btn-secondary' style='margin:3px' id='{$i}' href=''>{$i}</a>";
            }
        }

        $this->output .= '</div>
        </td>
    </tr>
        ';

        echo $this->output;
    }
}
if (!isset($_POST['connection']) || !isset($_POST['get_Coordinator'])) {
    header("location:home.php");
} else {
    $run =  new loadTeacherData($_POST["get_Coordinator"], $_POST['get_pageno']);
    $run->closeConnection();
}