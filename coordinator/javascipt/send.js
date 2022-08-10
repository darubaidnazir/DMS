$(document).ready(function(){
    //sending the branch information
    $("#sendBranch").on("click", function(event){
       event.preventDefault();
       var getBranch = $("#branch-name").val().trim();
       var getSemester = $("#branch-semester").val().trim();
       alert(getBranch);


    }); // end of branch information..

    $("#sendBatch").on("click", function(event){
        event.preventDefault();
        var getyear = $("#batch-year").val().trim();
        var getbranch = $("#branch_info").val();
        alert(getyear);
        alert(getbranch);
 
 
     }); // end of branch information..


  
  
     //extra code  for batch and branch


  $("#addbranchview").on("click", function(event){
    $("#viewbatch").css("display","none");
    $("#viewbranch").css("display","block");
    $("#addbranchview").css("display","none");
    $("#addbatchview").css("display","inline");

      

 }); 
 $("#addbatchview").on("click", function(event){
    $("#viewbatch").css("display","block");
    $("#viewbranch").css("display","none");
    $("#addbranchview").css("display","inline");
    $("#addbatchview").css("display","none");

      

 }); // end of branch information..
});