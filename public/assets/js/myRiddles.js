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

$(".closeAnswersIcon").click(function(){
    $(".myRiddleSelect").removeClass("selectedRiddle");
    $(".visible").attr('class', 'invisible');
});

$("#chooseColour").click(function(){
    $("#chooseColourModal").modal("show");
});

$(".colourItem").click(function(){
    $(".colourItem").removeClass("selectedColour");
    $(this).addClass("selectedColour");
    
    var currentColour = $(this).attr("value");
    $('#riddleSelectedColourBtn').css('background-color', currentColour);
    $('#create_riddle_colour').val(currentColour);
});


$("#okColourBtn").click(function(){
    $("#chooseColourModal").modal("hide");
});

$("#chooseIcon").click(function(){
    $("#chooseIconModal").modal("show");
    console.log("hi");
});

$(".iconItem").click(function(){
    $(".iconItem").removeClass("selectedIcon");
    $(this).addClass("selectedIcon");

    var currentIcon = $(this).attr("value");
    $('#riddleSelectedIconBtn').attr("src","/assets/img/"+currentIcon+".svg");
    $('#create_riddle_icon').val(currentIcon);
});


$("#okIconBtn").click(function(){
    $("#chooseIconModal").modal("hide");
});