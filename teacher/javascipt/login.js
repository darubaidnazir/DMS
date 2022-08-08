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
                    data: {email_:email,pass_word:password},
                    success: function (data){
                      alert(data);
                      $('#login').html("logged in Sucessfully");
                    }
                    
      
      
      
      
              });
      
      
      
      
      
          
        }
      });
    });
