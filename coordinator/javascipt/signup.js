$(document).ready(function () {
    $("#headermessage").text("Coordinator Login");
    $("#signupmodal").click(function () {
      $("#headermessage").text("Coordinator Registration");
      $("#loginform").css("display", "none");
      $("#signupform").css("display", "block");
    });
    $("#loginmodal").click(function () {
      $("#headermessage").text("Coordinator Login");
      $("#signupform").css("display", "none");
      $("#loginform").css("display", "block");
    });

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
        $(document).ready(function () {

            $.ajax({
                  url: "inner/login_coordinator.php",
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
    
    
    
    
    
          });
      }
    });
  });



  const form = document.getElementById("signupform");
  const username = document.getElementById("username");
  const email = document.getElementById("email");

  const department = document.getElementById("department");
  const phonenumber = document.getElementById("phonenumber");

  const password = document.getElementById("password");
  const password2 = document.getElementById("password2");

  form.addEventListener("submit", (event) => {
    event.preventDefault();
    var result = checkInputs();
    if (result) {
      alert(result);
      var username = $("#username").val().trim();
      var phonenumber = $("#phonenumber").val().trim();
      var email = $("#email").val().trim();
      var password = $("#password").val().trim();
      var department = $("#department").val().trim();
      var password2 = $("#password2").val().trim();
      $(document).ready(function () {

        $.ajax({
              url: "inner/signup_coordinator.php",
              type: "POST",
              beforeSend: function () {
                $('#register').html("Sending Data");
              },
              data: {user_name: username, pass_word: password, depart_ment: department,email_:email,password_2:password2,phone_number: phonenumber},
              success: function (data){
                alert(data);
                $('#register').html("Completed");
              }
              




        });





      });

    } else {
      alert("Please fill the Form Correct");
    }
  });

  function checkInputs() {
    // trim to remove the whitespaces
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();
    const departmentValue = department.value.trim();
    const phonenumberValue = phonenumber.value.trim();
    var returnvalue = true;

    if (usernameValue === "") {
      setErrorFor(username, "Username cannot be blank");
      returnvalue = false;
    } else {
      setSuccessFor(username);
    }

    if (departmentValue === "") {
      setErrorFor(department, "Department Name cannot be blank");
      returnvalue = false;
    } else {
      setSuccessFor(department);
    }
    if (phonenumberValue === "") {
      setErrorFor(phonenumber, "Phonenumber cannot be blank");
      returnvalue = false;
    } else if (isNaN(phonenumberValue)) {
      setErrorFor(phonenumber, "Phonenumber Should be only Number's");
      returnvalue = false;
    } else if (phonenumberValue.length != 10) {
      setErrorFor(phonenumber, "Phonenumber Should be Only 10 digit");
      returnvalue = false;
    } else {
      setSuccessFor(phonenumber);
    }

    if (emailValue === "") {
      setErrorFor(email, "Email cannot be blank");
      returnvalue = false;
    } else if (!isEmail(emailValue)) {
      setErrorFor(email, "Not a valid email");
      returnvalue = false;
    } else {
      setSuccessFor(email);
    }

    if (passwordValue === "") {
      setErrorFor(password, "Password cannot be blank");
      returnvalue = false;
    } else if (passwordValue.length < 8) {
      setErrorFor(password, "Password Must be at least 8 characters long");
      returnvalue = false;
    } else {
      setSuccessFor(password);
    }

    if (password2Value === "") {
      setErrorFor(password2, "Password2 cannot be blank");
      returnvalue = false;
    } else if (passwordValue !== password2Value) {
      setErrorFor(password2, "Passwords does not match");
      returnvalue = false;
    } else if (password2Value.length < 8) {
      setErrorFor(password2, "Password Must be at least 8 characters long");
      returnvalue = false;
    } else {
      setSuccessFor(password2);
    }

    return returnvalue;
  }

  function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector("small");
    formControl.className = "form-control error";
    small.innerText = message;
  }

  function setSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.className = "form-control success";
  }

  function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
      email
    );
  }

 
  