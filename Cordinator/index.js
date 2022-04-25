let login = document.querySelector("#login");
let signUp = document.querySelector("#signUp");
let loginPage = document.querySelector("#loginPage");
let signupPage = document.querySelector("#signupPage");
let password1 = document.querySelector("#password1");
let password2 = document.querySelector("#password2");


// For Animation

$("#login").click(function() {
    $( "#loginPage" ).slideToggle( "slow");
  });

  $("#signUp").click(function() {
    $( "#signupPage" ).slideToggle( "slow");
  });




login.addEventListener("click",()=>
{
    loginPage.style.display = "block";
    signupPage.style.display = "none";

    signUp.style.borderBottom="none";
    login.style.borderBottom="2px solid black";

    signUp.style.opacity=".5";
    login.style.opacity="1";

})




signUp.addEventListener("click",()=>
{
    loginPage.style.display = "none";
    signupPage.style.display = "block";

    login.style.borderBottom="none";
    signUp.style.borderBottom="2px solid black";
    
    login.style.opacity=".5";
    signUp.style.opacity="1";
})



// Validation Section

// Name Validation 
$(document).ready(function(){
  var $regexname=/^([a-zA-Z'-'\s]{10,})$/;
  $('.name').on('keypress keydown keyup',function(){
           if (!$(this).val().match($regexname)) {
            $('.nmsg').removeClass('nhidden');
            $('.nmsg').show();
            $('.name').css("border","2px solid red");
               
           }
         else{
             
              $('.nmsg').addClass('nhidden');
            $('.name').css("border","2px solid green");

             }
       });
});

// Password1 Validation 
$(document).ready(function(){
  var $passregexname=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  $('.pass').on('keypress keydown keyup',function(){
           if (!$(this).val().match($passregexname)) {
            $('.pmsg').removeClass('phidden');
            $('.pmsg').show();
            $('.pass').css("border","2px solid red");
               
           }
         else{
             
              $('.pmsg').addClass('phidden');
            $('.pass').css("border","2px solid green");

             }
       });
});

// Employee Validation 
$(document).ready(function(){
  var $employeregexname=/^([0-9]+.{8,})$/;
  $('.emplo').on('keypress keydown keyup',function(){
           if (!$(this).val().match($employeregexname)) {
            $('.emsg').removeClass('ehidden');
            $('.emsg').show();
            $('.emplo').css("border","2px solid red");
               
           }
         else{
             
              $('.emsg').addClass('ehidden');
            $('.emplo').css("border","2px solid green");

             }
       });
});




