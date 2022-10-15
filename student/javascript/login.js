$(document).ready(function () {
  $("#login").click(function (event) {
      event.preventDefault();
      var email = $("#loginemail").val().trim();
      var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      if (email === "" || !mailformat.test(email) ) {
        $("#messageemail").text("Enter a Valid Email!");
        $("#messageemail").css("color", "red");
      } else {
        $("#messageemail").text("");
        $("#messageemail").css("color", "");
            $.ajax({
                  url: "inner/loginstudent.php",
                  type: "POST",
                  beforeSend: function () {
                    $('#login').html("Checking...");
                  },
                  data: {email_:email,connection:true},
                  success: function (data){
                  
                    if(data == 1){
                      swal("ohoho!",
                                        "Student does not exist! Get registered by HOD/Coordinator.",
                                        "error");
                      $('#login').html("Next");

                    }
                    else if(data == 2){
                      
                      $.ajax({
                        url: "inner/otp.php",
                        type: "POST",
                        beforeSend: function(){
                          $('#login').html("Sending OTP...");
                        },
                        data:{email_otp:email,connection:true},
                        success: function (data){
                          
                          if(data == 1){
                            swal("Good Job!",
                                        "OTP sent to your registered email! Check your mail box.",
                                        "success");
                            $("#login").css("display","none");
                            $("#loginemail").attr("disabled",true);
                            $("#loginform").append("<span id='messageemail'></span><div class='form-control'><label for='OTP' id='labelotp'>Enter OTP</label> <input type='number' inputmode='numeric' minlength='5' maxlength='5' placeholder='Enter 5 digit OTP' id='otp'/> <i class='fas fa-check-circle'></i> <i class='fas fa-exclamation-circle'></i> </div> <button id='verify_otp' class='inner_button'>Verify</button>");
            
            
                        }
                          else if(data == 2){
                            swal("ohoho!",
                            "OTP Could not be Sent! try again later.",
                            "error");
                            $('#login').html("Next");

                          }
                        }
                      });
                    }
                    else if(data == 3){
                      swal("ohoho!",
                      "Your account has been disabled by Coordinator/HOD.",
                      "error");
                      $('#login').html("Next");
                    }
                    else if(data == 4){
                      $("#login").css("display","none");
                      $("#loginemail").attr("disabled",true);
                      $("#loginform").append("<span id='messageemail'></span><div class='form-control'><label for='Password'>Enter Your Password</label> <input type='password'  placeholder='Password' id='email_password'/> <i class='fas fa-check-circle'></i> <i class='fas fa-exclamation-circle'></i> </div> <button id='verify_password' class='inner_button'>Login</button>");
                    


                    }
                   
                  }
    
            });
        
      }
  });
 
  $(document).on("click","#verify_otp",function(e){
    e.preventDefault();
    var email_otp = $("#otp").val().trim();
    $.ajax({
      url: "inner/verify_otp.php",
      type: "POST",
      data:{verify_otp:email_otp,connection:true},
      success: function (data){

        if(data == 1){
          swal("Good Job!",
          "OTP Verified! ",
          "success");
          $("#verify_otp").css("display","none");
          $("#otp").css("display","none");
          $("#labelotp").css("display",'none');
          $("#loginemail").attr("disabled",true);
          $("#loginform").append(" <div class='form-control'> <label for='password'>Enter New Login Password</label> <input type='text'  placeholder='Enter Password' id='password'/> <br> <label for='confirm_password'>Confirm Login Password</label> <input type='text'  placeholder='Confirm Password' id='confirm_password'/> </div> <button id='create_password' class='inner_button'>Create Password</button>");

         
        }
        else if (data == 2){
          swal("ohoho!",
                                        "Incorrect OTP! try again.",
                                        "error");
                                        $('#loginform').html("<h3>Redirecting to Main Page in");
                                       
                                       
                                        var time = 6000;
                                        setTimeout("location.reload(true);", time);
        }
      }
    });

  });
  $(document).on("click","#create_password",function(e){
    e.preventDefault();
    var password=$("#password").val().trim();
    var confirm_password=$("#confirm_password").val().trim();
    var email = $("#loginemail").val().trim();
    
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(password === confirm_password && mailformat.test(email)){
      $.ajax({
        url:"inner/set_password.php",
        type:"POST",
        data:{login_password:password,email_login:email,connection:true,confirmpassword:confirm_password},
        success: function(data){

          if(data == 1){
            swal("Good Job!",
                      "Password Set Successfully! Login to access your account!",
                      "success");
                      $("#create_password").css("display","none");

          }
          else{
            swal("ohoho!",
                      "Failed to Set Password! try again.",
                      "error");
                     
          }
          var time = 5000;
          setTimeout("location.reload(true);", time);
        }
        
      });
    }
    else{
      swal("ohoho!",
                      "Password does not match! enter correct password in both field's!",
                      "error");
    }
});


$(document).on("click","#verify_password",function(e){
    e.preventDefault();
    var email = $("#loginemail").val().trim();
    var password = $("#email_password").val().trim();
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if( password == "" || email == "" || !mailformat.test(email)){
      swal("ohoho!",
      "Enter Valid Details",
      "error");
     
    }else{
     $.ajax({
     url:"inner/loginaccount.php",
     type:"POST",
     beforeSend : function(){
   $("#verify_password").html("verifying...");
     },
     data:{email_login:email,password_login:password,connection:true},
     success: function(data){
      if (data == 0) {
        swal("ohoho!", "Something went wrong! try again later", "error");
        $("#verify_password").html("verify");
    

      } else if (data == 1) {
        swal("ohoho!", "Email or password is incorrect!", "error");
        $("#verify_password").html("verify");

      } else if (data == 3) {
        $("#login").html("Logined...");
        location.replace('dashboard');
        $("#verify_password").html("verified");

      } else {
        swal("ohoho!", "Something went wrong! try again later", "error");
        $("#verify_password").html("verify");

      }
     }

     });

    }
});
});