//this code is used for scroll up and down navbar..

window.addEventListener('scroll',() =>{
    const scrolled = window.scrollY;
    console.log(scrolled);
    if(scrolled > 60){
      $(document).ready(function () {
       $("#carouselExampleDark img").css("opacity","0.1");
        $(".navbar-mainbg").css("top","0px");
         

      });
      
    }else{
      $(document).ready(function () {
        $(".navbar-mainbg").css("top","auto");  
        $("#carouselExampleDark img").css("opacity","1");
      });
    }

});

