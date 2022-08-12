<div class="modal fade" id="student-to-batch-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add Student
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row py-5 m-3 forms" id="form">
                    <div class="col-md-10">
                        <div class="form-group mt-2">
                            <select class="selectBranchstudent">
                                <option selected value="0">Select a Branch</option>
                                <?php
                                $sql = $conn->prepare("SELECT * FROM `branch` WHERE `coordinatorid` = ?");
                                $sql->bindParam(1, $coordinatorid);
                                $sql->execute();
                                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                ?>

                                <option value="<?php echo $row['branchid']; ?>"><?php echo $row['branchname']; ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <select class="addStudentData_batch_Select" id="addStudentData_batch_Select">
                                <option selected value="0">Select a Batch</option>

                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <lable>Enter Email of Student</lable>
                            <input type="email" class="form-control" id="enter-student-email"
                                placeholder="eg: example@gmail.com">
                        </div>
                        <small class="form-text text-muted mt-1">
                            Enter a valid Email
                        </small>

                        <div class="form-group pt-3">
                            <button class="btn btn-primary" id="addstudentData">Add Student</button>
                        </div>

                    </div>

                </div>



            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#addstudentData").on("click", function() {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var email = $("#enter-student-email").val().trim();
        var batchid = $("#addStudentData_batch_Select").val();
        if (batchid == 0 || !email.match(mailformat)) {
            swal("ohoho!", "Enter a Valid Email or Select a Proper Branch/Batch", "error");

        } else {
            $.ajax({
                url: "modal/sendmodaldata/sendstudent.php",
                type: "POST",
                beforeSend: function() {
                    $("#addstudentData").html("Adding...");
                },
                data: {
                    get_Email: email,
                    get_Batchid: batchid,
                    connection: true
                },
                success: function(data) {

                    if (data == 2) {
                        swal("ohoho!", "Student email already exits", "error");
                        $("#addstudentData").html("Add Student");

                    } else if (data == 3) {
                        swal("Good job ", "Student Added!", "success");
                        $("#addstudentData").html("Added");
                        setTimeout(() => {
                            $("#addstudentData").html("Add Student");
                        }, 3000);


                    } else {
                        swal("ohoho!", "Something went wrong! try again later", "error");
                        $("#addstudentData").html("Add Student");
                    }

                }



            });
        }

    });



});
</script>