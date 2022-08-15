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
            var batchid = $(".addStudentData_batch_Select").val();
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



                        } else {
                            swal("ohoho!", "Something went wrong! try again later",
                                "error");
                            $("#addstudentData").html("Add Student");
                        }

                    }



                });
            }

        });



    });
    </script>