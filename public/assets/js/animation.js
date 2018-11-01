$(function() {
  sideBar();
  $(".riddleCol").removeClass("riddleExit");
});

$( window ).resize(function() {sideBar()});
    
function sideBar() {    
 var sidebar = document.getElementById("sidebar");    
    
 if ($( window ).width() > 767) {
    sidebar.classList.add("fixedSB")
  } else {
    sidebar.classList.remove("fixedSB");
  }   
};

window.onscroll = function() {scrolling()};

var navbar = document.getElementById("navRow");
var sticky = navbar.offsetTop;

function scrolling() {
  if (window.pageYOffset >= sticky && $( window ).width() < 570) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

// jQuery('.filterItem').click(function{
//     $(this).classList.add("filterSelect");
// });

$(".riddleCol").click(function(){
  $(this).addClass("riddleExit");
  
});


