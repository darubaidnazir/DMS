$(document).ready(function () {
   //sending the branch information
   $("#sendBranch").on("click", function (event) {
      event.preventDefault();
      var getBranch = $("#branch-name").val().trim();
      var getSemester = $("#branch-semester").val().trim();
      var coordinate = $("#coordinator_hidden").val().trim();
      if (getSemester > 13 || isNaN(getSemester) || !/^[a-zA-Z\s.,]+$/.test(getBranch)) {
         swal("ohoho!", "Semester Should not be Greater than 13 or Branch name should be correct", "error");
      } else {
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
                  swal("Good job ", "Branch added Sucessfully! wait we are reloading branch table", "success");
                  $("#sendBranch").html("Created");
                  setTimeout(() => { location.reload(); }, 5000);

               } else {
                  swal("ohoho!", "Something went wrong! try again later", "error");
                  $("#sendBranch").html("Add Branch");
               }

            }


         });

      }
   }); // end of branch information..

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

            $.ajax({
               url: "javascript/sendinfo/sendBatch.php",
               type: "POST",
               beforeSend: function () {
                  $("#sendBranch").html("Creating...");
               },
               data: { get_Year: getyear, get_Branch: getbranch, get_Coordinator: coordinate, connection: true },
               success: function (data) {

                  if (data == 2) {
                     swal("ohoho!", "Batch with same Branch already exits?", "error");
                     $("#sendBranch").html("Add Branch");
                  } else if (data == 3) {
                     swal("Good job ", "Batch added Sucessfully! wait we are reloading batch table", "success");
                     $("#sendBranch").html("Created");
                     setTimeout(() => { location.reload(); }, 5000);

                  } else {
                     swal("ohoho!", "Something went wrong! try again later", "error");

                  }

               }


            });


         }
      }

   }); // end of branch information..

   //deleting a branch
   $(document).on("click", "#deleteBranch", function () {
      var getBranchid = $(this).data("id");
      var coordinate = $("#coordinator_hidden").val().trim();

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
               swal("Good job ", "Branch deleted Sucessfully! wait we are reloading Branch table", "success");
               setTimeout(() => { location.reload(); }, 5000);

            } else {
               swal("ohoho!", "Something went wrong! try again later", "error");

            }
         }




      });



   });
   // deleting a batch
   $(document).on("click", "#deleteBatch", function () {
      var getBatchid = $(this).data("id");
      var coordinate = $("#coordinator_hidden").val().trim();

      $.ajax({
         url: "javascript/sendinfo/deleteBatch.php",
         type: "POST",
         beforeSend: function () {
            $(this).html("Deleting...");
         },
         data: { get_Batchid: getBatchid, get_Coordinator: coordinate, connection: true },
         success: function (data) {

            if (data == 1) {
               swal("ohoho!", "Batch has some active semester added. Can't delete the batch.", "error");

            } else if (data == 3) {
               swal("Good job ", "Branch deleted Sucessfully! wait we are reloading Branch table", "success");
               setTimeout(() => { location.reload(); }, 5000);

            } else {
               swal("ohoho!", "Something went wrong! try again later", "error");
               $("#sendBranch").html("Add Branch");
            }
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