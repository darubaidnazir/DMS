$(document).ready(function () {

    $("#login").click(function (event) {
        event.preventDefault();
        var email = $("#loginemail").val().trim();
        var password = $("#loginpassword").val().trim();
        if (email === "" || password === "") {
          $("#messageemail").text("Email and Password is required");
          $("#messageemail").css("color", "red");
        } else {
          $("#messageemail").text("");
          $("#messageemail").css("color", "");
          alert(email);
          alert(password);
         
    
              $.ajax({
                    url: "inner/loginteacher.php",
                    type: "POST",
                    beforeSend: function () {
                      $('#login').html("logiining");
                    },
                    data: {email_:email,pass_word:password,connection:conn},
                    success: function (data){
                      if (data == 0) {
                        swal("ohoho!", "Something went wrong! try again later", "error");
          
                      } else if (data == 1) {
                        swal("ohoho!", "Email or password is incorrect!", "error");
          
                      } else if (data == 3) {
                        location.replace('dashboard');
          
                      } else {
                        swal("ohoho!", "Something went wrong! try again later", "error");
          
                      }
                    }
                    
      
      
      
      
              });
      
      
      
      
      
          
        }
      });
    });
