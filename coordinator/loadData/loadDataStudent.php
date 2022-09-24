<?php
require_once("../inner/db_connection.php");
class loadStudentData extends db_connection
{
    private $getBatchid;
    public $output = "";
    function __construct($getBatchid, $getpageno)
    {
        parent::__construct();
        $limitpage = 15;
        $page = $getpageno;
        $offset = ($page - 1) * $limitpage;

        $this->getBatchid = $getBatchid;
        $sql = $this->conn->prepare("SELECT * FROM `student` WHERE `batchid` = ? ORDER BY `studentrollno` ASC LIMIT {$offset} ,{$limitpage}");
        $sql->bindParam(1, $getBatchid);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        if ($page == 1) {
            $Sno = 1;
        } else {
            $Sno = 5 * $page - 5 + 1;
        }
        foreach ($result as $row) {
            $this->output .= "<tr id='{$row["studentid"]}'>
              <td data-title='S.No'>{$Sno}</td>
              <td data-title='Student Email'>{$row["studentemail"]}</td>
              <td data-title='Student Id'>{$row["studentname"]}</td>
              <td data-title='Student Enrollment'>{$row["studentrollno"]}</td>
              <td data-title='Student Dob'>{$row["group_id"]}</td>
              <td data-title='Student Status'>{$row["studentstatus"]}</td>
             
              <td class='select'>
                 
                      <span class='btn-group' role='group' aria-label='Basic mixed styles example'>
                      <button type='button' class='btn btn-warning btn-sm' data-id='{$row["studentid"]}' id='removestudent' >
                          Remove
                      </button>
                      <button type='button' class='btn btn-success btn-sm clickbutton' data-bs-toggle='modal'
                          data-bs-target='#student-information'>
                          More Information
                      </button>
                      </span>
                
              </td>
          </tr>";
            $Sno++;
        }
        $sql = $this->conn->prepare("SELECT * FROM `student` WHERE `batchid` = ? ");
        $sql->bindParam(1, $getBatchid);
        $sql->execute();
        $total_records = $sql->rowCount();
        $totalpage = ceil($total_records / $limitpage);



        $this->output .= ' <tr>
                                   
        <td colspan="7">
            <div id="pagination" style="text-align:center;">';
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
if (!isset($_POST['connection']) || !isset($_POST['get_Batchid'])) {
    header("location:home.php");
} else {
    $run =  new loadStudentData($_POST["get_Batchid"], $_POST['get_pageno']);
    $run->closeConnection();
}