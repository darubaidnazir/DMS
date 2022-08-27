$(document).ready(function () {

   getbranchupdate();
   //sending the branch information
   $("#sendBranch").on("click", function (event) {
      event.preventDefault();
      var getBranch = $("#branch-name").val().trim();
      var getSemester = $("#branch-semester").val().trim();
      var coordinate = $("#coordinator_hidden").val().trim();
      if (getSemester > 13 || isNaN(getSemester) || !/^[a-zA-Z\s.,]+$/.test(getBranch)) {
         swal("ohoho!", "Semester Should not be Greater than 13 or Branch name should be correct", "error");
      } else {

         swal({
            title: "Are you sure?",
            text: "You want to create a branch !",
            icon: "warning",
            buttons: true,
            dangerMode: true,
         })
            .then((willDelete) => {
               if (willDelete) {

                  $.ajax({
                     url: "javascript/sendinfo/sendBranch.php",
                     type: "POST",
                     beforeSend: function () {
                        $("#sendBranch").html("Creating...");
                     },
                     data: { get_Branch: getBranch, get_Semester: getSemester, get_Coordinator: coordinate, connection: true },
                     success: function (data) {
                        if (data == 2) {
                           swal("ohoho!", "Branch name already exits? try with different name", "error");
                           $("#sendBranch").html("Add Branch");
                        } else if (data == 3) {
                           swal("Good job ", "Branch added Sucessfully!", "success");
                           bodyofbranch();
                           $("#sendBranch").html("Created");
                           document.getElementById("branch-name").value = "";
                           document.getElementById("branch-semester").value = "";
                           $("#sendBranch").html("Add Branch");
                           getbranchupdate();




                        } else {
                           swal("ohoho!", "Something went wrong! try again later", "error");
                           $("#sendBranch").html("Add Branch");
                        }

                     }


                  });


               } else {
                  swal("Cancled!");
               }
            });





      }
   }); // end of branch information..

   function getbranchupdate() {

      $.ajax({
         url: "../../../DMS/coordinator/loadbranch.php",
         success: function (data) {

            $("#branch_info").html(data);
         }


      });
   }


   $("#sendBatch").on("click", function (event) {
      event.preventDefault();
      var getyear = $("#batch-year").val().trim();
      var getbranch = $("#branch_info").val();
      var coordinate = $("#coordinator_hidden").val().trim();
      if (getyear.length != 4 || isNaN(getyear)) {
         swal("ohoho!", "Batch year should be correct or not empty", "error");
      } else {



         if (getbranch == 0) {
            swal("ohoho!", "No Branch Exists? Create a Branch First", "error");
         } else {


            swal({
               title: "Are you sure?",
               text: "You want to create a batch!",
               icon: "warning",
               buttons: true,
               dangerMode: true,
            })
               .then((willDelete) => {
                  if (willDelete) {


                     $.ajax({
                        url: "javascript/sendinfo/sendBatch.php",
                        type: "POST",
                        beforeSend: function () {
                           $("#sendBatch").html("Creating...");
                        },
                        data: { get_Year: getyear, get_Branch: getbranch, get_Coordinator: coordinate, connection: true },
                        success: function (data) {

                           if (data == 2) {
                              swal("ohoho!", "Batch with same Branch already exits?", "error");
                              $("#sendBatch").html("Add Batch");
                           } else if (data == 3) {
                              swal("Good job ", "Batch added Sucessfully! wait we are reloading batch table", "success");
                              $("#sendBatch").html("Created");
                              bodyofbatch();
                              document.getElementById("batch-year").value = "";
                              document.getElementById("branch_info").value = "";
                              $("#sendBatch").html("Add Batch");

                           } else {
                              swal("ohoho!", "Something went wrong! try again later", "error");
                              $("#sendBatch").html("Add Batch");
                           }

                        }


                     });
                  } else {
                     swal("Your imaginary file is safe!");
                  }
               });







         }
      }

   }); // end of branch information..

   //deleting a branch
   $(document).on("click", "#deleteBranch", function () {
      var getBranchid = $(this).data("id");
      var coordinate = $("#coordinator_hidden").val().trim();


      swal({
         title: "Are you sure?",
         text: "Once deleted, you will not be able to recover this imaginary file!",
         icon: "warning",
         buttons: true,
         dangerMode: true,
      })
         .then((willDelete) => {
            if (willDelete) {
               $.ajax({
                  url: "javascript/sendinfo/deleteBranch.php",
                  type: "POST",
                  beforeSend: function () {
                     $(this).html("Deleting...");
                  },
                  data: { get_Branchid: getBranchid, get_Coordinator: coordinate, connection: true },
                  success: function (data) {
                     if (data == 1) {
                        swal("ohoho!", "Branch has some batch's added. Can't delete the branch.", "error");

                     } else if (data == 3) {
                        swal("Good job ", "Branch deleted Sucessfully! ", "success");
                        bodyofbranch();

                     } else {
                        swal("ohoho!", "Something went wrong! try again later", "error");

                     }
                  }




               });



            } else {
               swal("Your imaginary file is safe!");
            }
         });






   });
   // deleting a batch
   $(document).on("click", "#deleteBatch", function () {
      var getBatchid = $(this).data("id");
      var coordinate = $("#coordinator_hidden").val().trim();



      swal({
         title: "Are you sure?",
         text: "Once deleted, you will not be able to recover this imaginary file!",
         icon: "warning",
         buttons: true,
         dangerMode: true,
      })
         .then((willDelete) => {
            if (willDelete) {



               $.ajax({
                  url: "javascript/sendinfo/deleteBatch.php",
                  type: "POST",
                  beforeSend: function () {
                     $(this).html("Deleting...");
                  },
                  data: { get_Batchid: getBatchid, get_Coordinator: coordinate, connection: true },
                  success: function (data) {

                     if (data == 1) {
                        swal("ohoho!", "Batch has some active semester added or student added. Can't delete the batch.", "error");

                     } else if (data == 3) {
                        swal("Good job ", "Branch deleted Sucessfully! ", "success");
                        bodyofbatch();

                     } else {
                        swal("ohoho!", "Something went wrong! try again later", "error");

                     }
                  }




               });


            } else {
               swal("Your imaginary file is safe!");
            }
         });








   });

   //extra code  for batch and branch


   $("#addbranchview").on("click", function (event) {
      $("#viewbatch").css("display", "none");
      $("#viewbranch").css("display", "block");
      $("#addbranchview").css("display", "none");
      $("#addbatchview").css("display", "inline");



   });
   $("#addbatchview").on("click", function (event) {
      $("#viewbatch").css("display", "block");
      $("#viewbranch").css("display", "none");
      $("#addbranchview").css("display", "inline");
      $("#addbatchview").css("display", "none");



   }); // end of branch information..
});