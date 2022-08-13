   <!-- Add teacher Information Modal -->
   <div class="modal fade" id="teacher-to-batch-add" tabindex="-1" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">
                       Add teacher
                   </h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <div class="row py-5 m-3 forms" id="formteacher">
                       <div class="col-md-10">
                           <span class="message_teacher" style="color:red;"></span>
                           <div class="form-group mt-2">
                               <lable>Enter Username of Teacher</lable>
                               <input type="text" class="form-control" id="enter-teacher-username"
                                   placeholder="eg: waseembakshi121" required>
                           </div>
                           <small class="form-text text-muted mt-1">
                               Enter a valid username
                           </small>
                           <div class="form-group mt-2">
                               <lable>Enter Employee ID of Teacher</lable>
                               <input type="text" class="form-control" id="enter-emp-id" placeholder="eg: Emp-121"
                                   required>
                           </div>
                           <small class="form-text text-muted mt-1">
                               Enter a valid Employee ID
                           </small>
                           <div class="form-group mt-2">
                               <lable>Enter Position of the Teacher</lable>
                               <select name="teacher-position" id="teacher-position">
                                   <option value="0">Select a Position</option>
                                   <option value="1">Assistant Professor</option>
                                   <option value="2">Contractual</option>
                               </select>
                           </div>
                           <div class="form-group mt-2">
                               <lable>Enter Phone Number of the Teacher</lable>
                               <input type="number" class="form-control" id="enter-phonenumber"
                                   placeholder="eg: 9622922604" required>
                           </div>

                           <small class="form-text text-muted mt-1">
                               Enter a valid Phone Number
                           </small>



                           <div class="form-group pt-3">
                               <button class="btn btn-primary" id="addteacherdata">Add Teacher</button>
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

    $("#addteacherdata").on("click", function(event) {
        event.preventDefault();

        var username = $("#enter-teacher-username").val().trim();
        var empid = $("#enter-emp-id").val().trim();
        var phonenumber = $("#enter-phonenumber").val().trim();
        var position = $("#teacher-position").val();
        var coordinate = $("#coordinator_hidden").val().trim();

        if (username == "" || empid == "" || phonenumber == "" || position == 0) {
            $(".message_teacher").html("* All fields are required.");

        } else if (isNaN(phonenumber) || phonenumber.length != 10) {
            $(".message_teacher").html("* Phone number should be 10 digits only.");
        } else if (!/^[a-zA-Z-_]+$/.test(username)) {
            $(".message_teacher").html(
                "<br>*Username should not contain any number or space. eg user_name ");
        } else if (!/^[a-zA-Z-0-9\s.,]+$/.test(empid)) {
            $(".message_teacher").html("<br>*Emp Id Should not cointain any special char");
        } else {
            $(".message_teacher").html("");
            $.ajax({
                url: "modal/sendmodaldata/sendteacher.php",
                type: "POST",
                beforeSend: function() {
                    $("#addteacherdata").html("Adding...");
                },
                data: {
                    get_Username: username,
                    get_Empid: empid,
                    get_Phonenumber: phonenumber,
                    get_Position: position,
                    connection: true,
                    get_Coordinator: coordinate
                },
                success: function(data) {
                    if (data == 2) {
                        swal("ohoho!",
                            "teacher username already exits! try different username",
                            "error");
                        $("#addteacherdata").html("Add teacher");

                    } else if (data == 3) {
                        swal("Good job ", "Teacher Added!", "success");
                        $("#addteacherdata").html("Added");
                        setTimeout(() => {
                            $("#addteacherdata").html("Add teacher");

                        }, 3000);


                    } else {
                        swal("ohoho!", "Something went wrong! try again later", "error");
                        $("#addteacherdata").html("Add teacher");
                    }

                }



            })
        }
    });






});
   </script>