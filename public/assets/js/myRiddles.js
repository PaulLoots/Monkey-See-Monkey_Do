$(function() {
    sizeCheck();
});

$( window ).resize(function() {sizeCheck()});

function sizeCheck() {     
 var displayCol = document.getElementById("displayCol");   
 if ($( window ).width() < 992) {
    displayCol.classList.add("fixedDisp")
  } else {
    displayCol.classList.remove("fixedDisp");  
  }   
};

$(".myRiddleSelect").click(function(){
    $(".myRiddleSelect").removeClass("selectedRiddle");
    $(".visible").attr('class', 'invisible');
    $(this).addClass("selectedRiddle");
    
    var ridClicked = "#" + $(this).attr("value");
    
    $(ridClicked).attr('class', 'visible');
    console.log(ridClicked);
});

$("#closeAnswersIcon").click(function(){
    $(".myRiddleSelect").removeClass("selectedRiddle");
    $(".visible").attr('class', 'invisible');
});

$("#chooseColour").click(function(){
    $("#chooseColourModal").modal("show");
});

$(".colourItem").click(function(){
    $(".colourItem").removeClass("selectedColour");
    $(this).addClass("selectedColour");
});


$("#okColourBtn").click(function(){
    $("#chooseColourModal").modal("hide");
});