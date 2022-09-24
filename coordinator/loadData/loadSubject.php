<?php
require_once("../../coordinator/inner/db_connection.php");
class loadSubject extends db_connection
{

    function  __construct($getcoordinatorid)

    {
        parent::__construct();
        $output = " <tr>";
        $Sno = 1;
        $sql = $this->conn->prepare("SELECT * FROM `subject` WHERE `coordinatorid` = ?");
        $sql->bindParam(1, $getcoordinatorid);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $marked = $row["subjectlevel"];
            if ($marked == "T") {
                $marked = "Theory";
            } else if ($marked == "L") {
                $marked = "Lab";
            }
            $output .= "<td data-title='S.No'>{$Sno}</td>
                   <td data-title='Subejct Id'>{$row["subjectid"]}</td>
                   <td data-title='Subject Name'>{$row["subjectname"]}</td>
                   <td data-title='Subject Code'>{$row["subjectcode"]}</td> 
                   <td data-title='Subject Level'>{$marked}</td> 
                   <td class='select'>
                   <span class='btn-group' role='group' aria-label='Basic mixed styles example'>
                                            <button type='button' class='btn btn-danger btn-sm'>
                                                Edit
                                            </button>
                                            <button type='button' class='btn btn-warning btn-sm' id='removesubject'
                                                data-id='{$row["subjectid"]}'>
                                                Remove
                                            </button>
                                            <button type='button' class='btn btn-success btn-sm clickbutton'
                                                data-bs-toggle='modal' data-bs-target='#subject-information'>
                                                More Information
                                            </button>
                                        </span>

                                    </td>
                                </tr>";
            $Sno++;
        }

        echo $output;
    }
}



if (isset($_POST['connection']) && isset($_POST['get_Coordinatorid'])) {
    $run =  new loadSubject($_POST['get_Coordinatorid']);
    $run->closeConnection();
} else {
    header("Location:../../../coordinatorlogin_signup.html");
}