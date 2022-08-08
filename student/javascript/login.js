
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
              alert(email);
              
             
        
                  $.ajax({
                        url: "inner/loginstudent.php",
                        type: "POST",
                        beforeSend: function () {
                          $('#login').html("logiining");
                        },
                        data: {email_:email},
                        success: function (data){
                          alert(data);
                          $('#login').html("logged in Sucessfully");
                        }
                        
          
          
          
          
                  });
          
          
          
          
          
              
            }
          });
        });