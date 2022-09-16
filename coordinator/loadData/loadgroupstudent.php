<?php
session_start();
if (!isset($_SESSION['active']) || $_SESSION['active'] != true) {
    header("Location:../../coordinator/dashboard.php");
    die();
}

if (isset($_POST['load_group'])) {
    $batchid = $_POST['batchid_group'];
    if ($batchid == 0 || $batchid == null) {
        header("Location:../../coordinator/dashboard.php");
        die();
    }
    require_once("../../coordinator/dbcon.php");
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
.attendancebutton {
    background-color: grey;
    display: inline-block;
    margin: 2px;
    padding: 10px;
    border: 1px black solid;
    border-radius: 2px;
    color: white;
    font-weight: bolder;



}

.attendancebutton.toggled {
    background-color: red;
}



.modalattendance {
    display: block;
    margin: 10px;
    padding: 10px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}
</style>
<?php
    $sql = $conn->prepare("SELECT * FROM `student` WHERE `batchid` = ? && group_id = 'NA' ");
    $sql->bindParam(1, $batchid);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class='modalattendance text-center'>   <div class='text-center'><span id='mess' style='color:red;'></span><select class='form-control' style='width:50%;margin:0 auto;' id='group_id'>
    <option value='0'>Select a Group</option>
    <option value='G1'>G1</option>
    <option value='G2'>G2</option>

</select>
<h4>Select a Group</h4>
</div>";
    foreach ($result as $row) {
        $my_array1 = str_split($row['studentid']);
        $length = count($my_array1);
        $name = $my_array1[$length - 2];
        $name .= $my_array1[$length - 1];

    ?>
<span><label class="attendancebutton"> <?php echo $name; ?>
        <input type="checkbox" id='checkbox1' value="<?php echo $row['studentid']; ?>">

    </label></span>


<?php

        unset($my_array1);
    }
    echo "</div><div class='text-center'>
    <button id='send_group' class='btn btn-danger'>Send Group</button>
</div>";
} else {
    header("Location:../../coordinator/dashboard.php");
    die();
}
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
$(document).ready(function() {

    $("#send_group").on("click", function() {
        var group = $("#group_id").val();
        var id = [null];
        if (group == "G1" || group == "G2") {
            $(":checkbox:checked").each(function(key) {
                id[key] = $(this).val();

            });
            if (id[0] == null) {
                $("#mess").html("* Select Student's ");

            } else {
                $("#mess").html("");
                $.ajax({
                    url: "../../coordinator/modal/sendmodaldata/sendgroup.php",
                    type: "POST",
                    data: {
                        group: group,
                        id: id,
                        connection: true
                    },
                    success: function(data) {
                        if (data == 3) {
                            swal("Good job!", " Student's  Added to Group!! ", "success");
                            $("#send_group").attr("disabled", true);
                        } else if (data == 1) {
                            swal("ohoho!", " Failed!! ", "error");

                        } else {
                            swal("ohoho!", " Failed!! ", "error");
                        }
                    }



                });
            }


        } else {
            $("#mess").html("* Select  a group");

        }

    });


});
</script>