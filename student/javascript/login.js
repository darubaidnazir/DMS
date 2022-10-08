$(document).ready(function () {
  $("#login").click(function (event) {
      event.preventDefault();
      var email = $("#loginemail").val().trim();
      
      if (email === "") {
        $("#messageemail").text("Email is required");
        $("#messageemail").css("color", "red");
      } else {
        $("#messageemail").text("");
        $("#messageemail").css("color", "");
            $.ajax({
                  url: "inner/loginstudent.php",
                  type: "POST",
                  beforeSend: function () {
                    $('#login').html("logiining");
                  },
                  data: {email_:email},
                  success: function (data){
                    if(data == 1){
                      alert("student not registered");
                    }
                    else if(data == 2){
                      alert("registered but inactive");
                     
                      $.ajax({
                        url: "inner/otp.php",
                        type: "POST",
                        data:{email_otp:email},
                        success: function (data){
                          alert(data);
                          if(data == 1){

                            $("#loginform").html("<label for='otp'>Enter OTP</label> <input type='text' inputmode='numeric'  placeholder='Enter 5 digit otp' id='otp'/> <button id='verify_otp' class='inner_button'>Verify OTP</button>");
                          }
                          else if(data == 2){
                            alert("mail not send");

                          }
                        }
                      });
                    }
                    else if(data == 3){
                      alert("disabled");
                    }
                    else if(data == 4){
                      alert("active student");

                      
                    }
                    $('#login').html("logged in Sucessfully");
                  }
    
            });
        
      }
  });
 
  $(document).on("click","#verify_otp",function(e){
    e.preventDefault();
    var email_otp = $("#otp").val().trim();
    alert(email_otp);

    $.ajax({
      url: "inner/verify_otp.php",
      type: "POST",
      data:{verify_otp:email_otp},
      success: function (data){

        if(data == 1){
          alert("User verified");

          $("#loginform").html("<label for='password'>Enter Login Password</label> <input type='text'  placeholder='Enter Password' id='password'/> <br> <label for='confirm_password'>Confirm Login Password</label> <input type='text'  placeholder='Confirm Password' id='confirm_password'/> <button id='create_password' class='inner_button'>Create Password</button>");

         
        }
        else if (data == 2){
          alert("Wrong OTP");
        }
      }
    });

  });
  $(document).on("click","#create_password",function(e){
    e.preventDefault();
    alert(email);
    var password=$("#password").val().trim();
    var confirm_password=$("#confirm_password").val().trim();
    if(password == confirm_password){
      alert(password);
      $.ajax({
        url:"inner/set_password.php",
        type:"POST",
        data:{login_password:password},
        success: function(data){
          alert(data);
          if(data == 1){
            alert("password set successfully");
          }
          else{
            alert("password not set");
          }
        }
      });
    }
    else{
      alert("Password not matching");
    }
});
});