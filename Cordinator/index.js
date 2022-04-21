let login = document.querySelector("#login");
let signUp = document.querySelector("#signUp");
let loginPage = document.querySelector("#loginPage");
let signupPage = document.querySelector("#signupPage");
let password1 = document.querySelector("#password1");
let password2 = document.querySelector("#password2");



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
