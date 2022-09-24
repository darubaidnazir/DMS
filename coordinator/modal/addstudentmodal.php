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
                        <div class="form-group mt-2 text-center">
                            <form id="formexecel" action="ajaxupload.php" method="post" enctype="multipart/form-data">
                                <p class="fw-bold">Import Email address using Excel File</p>
                                <small style="color:red;font-weight:bold;">*Select a batch first</small>
                                <?php
                                $sql = $conn->prepare("SELECT * FROM `batch` INNER JOIN `branch` ON batch.branchid = branch.branchid WHERE branch.coordinatorid = ? ");
                                $sql->bindParam(1, $coordinatorid);
                                $sql->execute();
                                $results = $sql->fetchAll(PDO::FETCH_ASSOC);

                                ?>
                                <select class="form-select" name="batchid" id="formimport"
                                    aria-label="Default select example">
                                    <option value="0">Select a Batch</option>
                                    <?php
                                    $string = "";
                                    foreach ($results as $rows) {
                                        $string .= $rows['branchname'];
                                        $string .= "-";
                                        $string .= $rows['batchyear'];

                                    ?>
                                    <option value="<?php echo $rows['batchid']; ?>"><?php echo $string; ?></option>
                                    <?php
                                        $string = '';
                                    }
                                    ?>
                                </select>
                                <input required id="uploadImage" type="file" name="image" accept=".csv" />

                                <input class="btn btn-success" type="submit" id="upbtn" value="Upload">
                            </form>
                        </div>
                        <h1 class="text-center m-3">OR</h1>
                        <div class="form-group mt-2">

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

        $("#formexecel").on('submit', (function(e) {

            e.preventDefault();
            if ($("#formimport").val() == "" || $("#formimport").val() == 0) {
                swal("ohoho!", "Select a Batch",
                    "error");
            } else {

                $.ajax({
                    url: "../../../DMS/coordinator/modal/sendmodaldata/uploadex.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#student-to-batch-add').modal('hide');
                        $('#loader').removeClass('hidden')

                    },
                    success: function(data) {

                        if (data == 1) {
                            swal("ohoho!", "File not Uploaded! try again", "error");
                            $("#upbtn").html("Upload");

                        } else if (data == 3) {
                            swal("Good job ", "Student Added to the Batch!", "success");
                            $("#upbtn").html("Uploaded");
                            $("#upbtn").attr("disabled", "disabled");

                        } else if (data == 7) {
                            swal("ohoohoh ", "Only .csv Files allowed", "warning");
                            $("#upbtn").html("Upload");
                        } else {
                            swal("ohoho!", "Something went wrong! try again later",
                                "error");
                            $("#upbtn").html("Upload");

                        }
                    },
                    complete: function() {
                        $('#loader').addClass('hidden')
                    },


                });
            }

        }));




        $("#addstudentData").on("click", function() {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var email = $("#enter-student-email").val().trim();
            var batchid = $("#formimport").val();
            if (batchid == 0) {
                swal("ohoho!", " Select a  Batch/Branch", "error");

            } else if (!email.match(mailformat)) {

                swal("ohoho!", "enter valid email address", "error");
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
                            loadDataStudent(batchid, 1);
                            document.getElementById("enter-student-email").value = "";
                            $("#addstudentData").html("Add Student");



                        } else {
                            swal("ohoho!", "Something went wrong! try again later",
                                "error");
                            document.getElementById("enter-student-email").value = "";
                            $("#addstudentData").html("Add Student");
                        }

                    }



                });
            }

        });


    });
    </script>