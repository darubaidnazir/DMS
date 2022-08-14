
$(document).ready(function () {
    var myArray = new Array();
    myArray[0] = "addstudentsection";
    myArray[1] = "addsettingsection";
    myArray[2] = "addbatchsection";
    myArray[3] = "addteachersection";
    myArray[4] = "addactivesemestersection";
    myArray[5] = "addsubjectsection";
    $(".menu_button").click(function () {
        $("#maindashboardsection").css("display", "none");
        var getId = this.id;
        //  alert(getId);
        if (getId == "addbatch") {
            getId = "addbatchsection";
        } else if (getId == "addstudent") {
            getId = "addstudentsection";
            //  loadDataStudent();
        } else if (getId == "addteacher") {
            getId = "addteachersection";
            loadDataTeacher(1);
        } else if (getId == "activesemster") {
            getId = "addactivesemestersection";
        } else if (getId == "addsetting") {
            getId = "addsettingsection";
        } else if (getId == "addsubject") {
            getId = "addsubjectsection";
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

    $(".selectBranchstudent").change(function () {
        var getBranchid = $(this).val();
        // alert(getBranchid);
        $(".addStudentData_batch_Select").prop('selectedIndex', 0);
        $(".addStudentData_batch_Select").html(' <option selected value="0">Select a Batch</option>');
        if (getBranchid == 0) {

        } else {

            $.ajax({
                url: "loadData/loadStudentData_batch.php",
                type: "POST",
                data: {
                    get_Branchid: getBranchid,
                    connection: true
                },
                success: function (data) {
                    $(".addStudentData_batch_Select").append(data);


                }
            });
        }
    });

    $(".addStudentData_batch_Select").change(function () {
        var getBatchid = $(this).val();
        var getBranchid = $(".selectBranchstudent").val();
        //alert(getBatchid);
        //alert(getBranchid);

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

    // var getBranchid = get_branchid;
    //alert(getBatchid);
    // alert(getBranchid);

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

    $.ajax({
        url: "delete/deletestudent.php",
        type: "POST",
        data: { get_Studentid: studentid, connection: true },
        success: function (data) {
            if (data == 3) {
                swal("Good job!", "Student Removed! ", "success");
                $("#" + studentid).load(location.href + " #" + studentid);
            } else {
                swal("ohoho!", "Something went wrong ! we could not delete the student. try again", "error");
            }

        }




    });

});
$(document).on("click", "#removeteacher", function () {

    var teacherid = $(this).data("id");

    $.ajax({
        url: "delete/deleteteacher.php",
        type: "POST",
        data: { get_Teacherid: teacherid, connection: true },
        success: function (data) {
            if (data == 3) {
                swal("Good job!", "Teacher Removed! ", "success");
                $("#" + teacherid).load(location.href + " #" + teacherid);
            } else {
                swal("ohoho!", "Something went wrong ! we could not delete the teacher. try again", "error");
            }

        }




    });

});
//remve subject
/*
  $(document).on("click", "#removesubject", function () {

  var subejctid = $(this).data("id");

  $.ajax({
      url: "delete/deletesubject.php",
      type: "POST",
      data: { get_Subjectid: subejctid, connection: true },
      success: function (data) {
          if (data == 3) {
              swal("Good job!", "Teacher Removed! ", "success");
              $("#" + teacherid).load(location.href + " #" + teacherid);
          } else {
              swal("ohoho!", "Something went wrong ! we could not delete the teacher. try again", "error");
          }

      }




  });

});*/



$("#addsubjectcode").on("click", function (event) {
    event.preventDefault();
    var subjectname = $("#enter-subject-name").val().trim();
    var subjectcode = $("#enter-subject-code").val().trim();
    var coordinate = $("#coordinator_hidden").val().trim();
    if (subjectcode == "" || subjectname == "") {
        $("#messagesubject").html("* All Fields required");
    } else
        if (!/^[a-zA-Z-0-9\s_]+$/.test(subjectcode) || !/^[a-zA-Z\s_-]+$/.test(subjectname)) {
            $("#messagesubject").html("* Enter a Valid Format eg: Database or CSE 1721 ");
        } else {
            $.ajax({

                url: "../coordinator/javascript/sendinfo/sendsubject.php",
                type: "POST",
                data: { get_Subjectname: subjectname, get_Subjectcode: subjectcode, get_Coordinator: coordinate, connection: true },
                success: function (data) {
                    if (data == 2) {
                        swal("ohoho!", "Subject already exits? try with different Subject Code", "error");
                    } else if (data == 3) {
                        swal("Good job ", "Subeject added Sucessfully!*Refresh page to see changes ", "success");
                        $("#messagesubject").html("*Refresh page to see change");

                    } else {
                        swal("ohoho!", "Something went wrong! try again later", "error");

                    }
                }




            });

        }

});

$(window).on('load', function () {
    $("#cover").fadeOut(5000);
});