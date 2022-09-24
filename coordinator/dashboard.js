
$(document).ready(function () {
    loadstudentbatchinfo();
    var myArray = new Array();
    myArray[0] = "addstudentsection";
    myArray[1] = "addsettingsection";
    myArray[2] = "addbatchsection";
    myArray[3] = "addteachersection";
    myArray[4] = "addactivesemestersection";
    myArray[5] = "addsubjectsection";
    myArray[6] = "requestsection";
    myArray[7] = "addpdfsection";
    $(".menu_button").click(function () {
        $("#maindashboardsection").css("display", "none");
        var getId = this.id;


        if (getId == "addbatch") {
            getId = "addbatchsection";
            bodyofbatch();
            bodyofbranch();

            loadstudentbatchinfo();
        } else if (getId == "addstudent") {
            getId = "addstudentsection";

            loadstudentbatchinfo();
        } else if (getId == "addteacher") {
            getId = "addteachersection";
            loadDataTeacher(1);
        } else if (getId == "activesemster") {
            getId = "addactivesemestersection";
            loadactivesemester();

        } else if (getId == "addsettingboard") {
            getId = "addsettingsection";

        } else if (getId == "addsubject") {
            getId = "addsubjectsection";
            bodyofsubject();

        } else if (getId == "addrequest") {
            getId = "requestsection";


        } else if (getId == "addpdfsectionbutton") {
            getId = "addpdfsection";
            $("#addpdfsection").css("display", "block");
        }

        for (var i = 0; i < myArray.length; i++) {
            if (myArray[i] == getId) {
                continue;
            } else {
                $("#" + myArray[i]).css("display", "none");
            }
        }
        $("#" + getId).css("display", "block");


    });
    $(".maindashbutton").click(function () {

        for (var i = 0; i < myArray.length; i++) {
            $("#" + myArray[i]).css("display", "none");
        }
        $("#maindashboardsection").css("display", "grid");
    });


    function loadstudentbatchinfo() {


        $.ajax({
            url: "loadData/loadStudentData_batch.php",
            type: "POST",
            data: {

                connection: true
            },
            success: function (data) {

                $(".addStudentData_batch_Select").html(data);
                $("#formimport").html(data);



            }
        });
    }


    $(".addStudentData_batch_Select").change(function () {
        var getBatchid = $(this).val();

        if (getBatchid == 0) {

        } else {
            loadDataStudent(getBatchid, 1);


        }



    });



});
$(document).on('click', "#pagination a", function (e) {
    e.preventDefault();
    var page_id = $(this).attr("id");
    var batchid = $(".addStudentData_batch_Select").val();
    //alert(page_id);
    loadDataStudent(batchid, page_id)


});
$(document).on('click', "#pagination2 a", function (e) {
    e.preventDefault();
    var page_id = $(this).attr("id");
    loadDataTeacher(page_id);


});

function loadDataStudent(get_batchid, pageno) {

    var getBatchid = get_batchid;
    var page_no = pageno;

    $.ajax({
        url: "loadData/loadDataStudent.php",
        type: "POST",
        data: {
            get_Batchid: getBatchid,
            get_pageno: page_no,
            connection: true
        },
        success: function (data) {
            $("#addStudentData").html(data);



        }


    });
}
function loadDataTeacher(pageno) {
    var coordinate = $("#coordinator_hidden").val().trim();
    var pageno = pageno;
    $.ajax({
        url: "loadData/loadDataTecher.php",
        type: "POST",
        data: { get_Coordinator: coordinate, get_pageno: pageno, connection: true },
        success: function (data) {

            $("#addTeachertable").html(data);

        }


    });
}
$(document).on("click", "#removestudent", function () {

    var studentid = $(this).data("id");
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this Student record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: "delete/deletestudent.php",
                    type: "POST",
                    data: { get_Studentid: studentid, connection: true },
                    success: function (data) {
                        if (data == 3) {
                            swal("Good job!", "Student Removed! ", "success");
                            $("#" + studentid).load(location.href + " #" + studentid);
                        } else if (data == 2) {
                            swal("ohoho!", "Student Can't be removed! Student already registered with a active semester ", "error");



                        } else {
                            swal("ohoho!", "Something went wrong ! we could not delete the student. try again", "error");
                        }

                    }




                });

            } else {
                swal("Your Student record is safe!");
            }
        });


});
$(document).on("click", "#removeteacher", function () {

    var teacherid = $(this).data("id");
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this Teacher record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {


                $.ajax({
                    url: "delete/deleteteacher.php",
                    type: "POST",
                    data: { get_Teacherid: teacherid, connection: true },
                    success: function (data) {
                        if (data == 3) {
                            swal("Good job!", "Teacher Removed! ", "success");
                            $("#" + teacherid).load(location.href + " #" + teacherid);
                        }
                        else if (data == 2) {
                            swal("ohoho!", "Teacher has some subject assigned we can't delete this teacher! we have disabled the teacher ", "error");

                        } else {
                            swal("ohoho!", "Something went wrong ! we could not delete the teacher. try again", "error");
                        }

                    }




                });
            } else {
                swal("Your Teacher record is safe!");
            }
        });


});
//remve subject

$(document).on("click", "#removesubject", function () {

    var subejctid = $(this).data("id");
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this Subject record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {


                $.ajax({
                    url: "delete/deletesubject.php",
                    type: "POST",
                    data: { get_Subjectid: subejctid, connection: true },
                    success: function (data) {

                        if (data == 3) {
                            swal("Good job!", "Subject Removed! ", "success");
                            bodyofsubject();

                        } else if (data == 2) {
                            swal("ohohoh!", "Subject has a attendance marked! Can not be removed ", "error");

                        } else {
                            swal("ohoho!", "Something went wrong ! we could not delete the Subject. try again", "error");
                        }
                    }
                });
            } else {
                swal("Your Subject record is safe!");
            }
        });

});



function loadactivesemester() {

    $.ajax({
        url: "../coordinator/loadData/getsem.php",
        success: function (data) {

            $("#loadactivesemester").html(data);
        }


    });

}

//remove assigned subject
$(document).on("click", "#removeassignedsubject", function () {
    var subjectid = $(this).data("subjectid");
    var teacherid = $(this).data("teacherid");
    var semesterid = $(this).data("semesterid");

    removeassignedsubject(subjectid, teacherid, semesterid);

});

function removeassignedsubject(subjectid, teacherid, semesterid) {
    var coordinate = $("#coordinator_hidden").val().trim();

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "../coordinator/delete/removeassignedsub.php",
                    type: "POST",
                    data: { subjectid: subjectid, teacherid: teacherid, semesterid: semesterid, connection: true },
                    success: function (data) {
                        assignsubjectbox(semesterid, coordinate);
                        if (data == 3) {
                            swal("Good job!", "Assigned Subject Removed! ", "success");


                        } else if (data == 5) {
                            swal("ohohoh!", "Assigned Subject has a attendance marked! Can not be removed. we have disabled the teacher ", "error");

                        } else {
                            swal("ohoho!", "Something went wrong ! we could not delete the Subject. try again", "error");
                        }
                    }





                });
            } else {
                swal("Your Subject record is safe!");
            }
        });



}

// assign subject button 


$("#addsubjectcode").on("click", function (event) {
    event.preventDefault();
    var subjectname = $("#enter-subject-name").val().trim();
    var subjectcode = $("#enter-subject-code").val().trim();
    var coordinate = $("#coordinator_hidden").val().trim();
    var subjectlevel = $("#enter-subject-level").val();
    if (subjectcode == "" || subjectname == "" || subjectlevel == "") {
        $("#messagesubject").html("* All Fields required");
    } else
        if (!/^[a-zA-Z-0-9\s_]+$/.test(subjectcode) || !/^[a-zA-Z\s_-]+$/.test(subjectname)) {
            $("#messagesubject").html("* Enter a Valid Format eg: Database or CSE 1721 ");
        } else {



            swal({
                title: "Are you sure?",
                text: "You want to add subject to this department!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {


                        $.ajax({

                            url: "../coordinator/javascript/sendinfo/sendsubject.php",
                            type: "POST",
                            beforeSend: function () {
                                $("#addsubjectcode").html("wait...");
                            },
                            data: { get_Subjectname: subjectname, get_Subjectcode: subjectcode, get_Coordinator: coordinate, connection: true, subjectlevel: subjectlevel },
                            success: function (data) {

                                if (data == 2) {
                                    swal("ohoho!", "Subject already exits? try with different Subject Code", "error");
                                    $("#addsubjectcode").html("Add Subject");
                                } else if (data == 3) {
                                    swal("Good job ", "Subeject added Sucessfully!", "success");
                                    bodyofsubject();
                                    document.getElementById("enter-subject-name").value = "";
                                    document.getElementById("enter-subject-code").value = "";
                                    $("#addsubjectcode").html("Add Subject");

                                } else {
                                    swal("ohoho!", "Something went wrong! try again later", "error");
                                    $("#addsubjectcode").html("Add Subject");

                                }
                            }




                        });
                    } else {
                        swal("Adding Subject Cancled!");
                    }
                });


        }

});


function bodyofsubject() {
    var coordinate = $("#coordinator_hidden").val().trim();

    $.ajax({
        url: "../coordinator/loadData/loadSubject.php",
        type: "POST",
        data: { get_Coordinatorid: coordinate, connection: true },
        success: function (data) {

            $("#bodysubject").html(data);

        }


    });



}

function bodyofbranch() {
    var coordinate = $("#coordinator_hidden").val().trim();

    $.ajax({
        url: "../coordinator/loadData/loadBranch.php",
        type: "POST",
        data: { get_Coordinatorid: coordinate, connection: true },
        success: function (data) {

            $("#bodybranch").html(data);

        }


    });

}
function bodyofbatch() {
    var coordinate = $("#coordinator_hidden").val().trim();

    $.ajax({
        url: "../coordinator/loadData/loadBatch.php",
        type: "POST",
        data: { get_Coordinatorid: coordinate, connection: true },
        success: function (data) {
            $("#bodybatch").html(data);

        }


    });



}

