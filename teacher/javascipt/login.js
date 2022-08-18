$(document).ready(function () {

  $("#login").click(function (event) {
    event.preventDefault();
    var username = $("#loginusername").val().trim();
    var password = $("#loginpassword").val().trim();
    if (username === "" || password === "") {
      $("#messageemail").text("Username and Password is required");
      $("#messageemail").css("color", "red");
    } else {
      $("#messageemail").text("");
      $("#messageemail").css("color", "");


      $.ajax({
        url: "inner/loginteacher.php",
        type: "POST",
        beforeSend: function () {
          $('#login').html("wait...");
        },
        data: { email_: username, pass_word: password, connection: true },
        success: function (data) {
          if (data == 0) {
            swal("ohoho!", "Something went wrong! try again later", "error");

          } else if (data == 1) {
            swal("ohoho!", "Email or password is incorrect! or Account is disabled", "error");
            $('#login').html("Login");

          } else if (data == 3) {
            $('#login').html("Logined");
            location.replace('dashboard');

          } else {
            swal("ohoho!", "Something went wrong! try again later", "error");
            $('#login').html("Login");

          }
        }





      });






    }
  });
});
