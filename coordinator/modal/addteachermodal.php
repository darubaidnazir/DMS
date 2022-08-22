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

            swal({
                    title: "Are you sure?",
                    text: "You want to add teacher to your department!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {



                        $.ajax({
                            url: "modal/sendmodaldata/sendteacher.php",
                            type: "POST",
                            beforeSend: function() {
                                $("#addteacherdata").html("wait...");
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
                                    $("#addteacherdata").html("Add Teacher");
                                } else if (data == 3) {
                                    swal("Good job ", "Teacher Added!", "success");

                                    loadDataTeacher(1);
                                    $("#addteacherdata").html("Added");
                                    $("#addteacherdata").html("Add Teacher");
                                    document.getElementById("enter-teacher-username")
                                        .value = "";
                                    document.getElementById("enter-emp-id").value = "";
                                    document.getElementById("enter-phonenumber").value =
                                        "";
                                    document.getElementById("teacher-position").value =
                                        "";

                                } else {
                                    swal("ohoho!",
                                        "Something went wrong! try again later",
                                        "error");
                                    $("#addteacherdata").html("Add Teacher");
                                }
                            }
                        });
                    } else {
                        swal("Adding Teacher Cancled!");
                    }
                });

        }
    });
});
</script>