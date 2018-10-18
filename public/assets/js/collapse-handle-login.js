$(function(){
    $(".createAccount").click(function(){
        $(".collapseContentBlock").animate(
            {opacity:'0'},0);
        $(".collapseContentBlock").animate(
            {opacity:'1'},600);
        $(".loginContent").fadeOut();
        $(".loginBlock").animate(
            {height:'0'},600);
        $(".loginBlock").animate(
            {opacity:'0'},0); 
    })
    
    $(".changeToLogin").click(function(){
        $(".collapseContentBlock").animate(
            {opacity:'0'},100);
        $(".loginContent").fadeIn();
        $(".loginBlock").animate(
            {opacity:'100'},0);
        $(".loginBlock").animate(
            {height:'100vh'},600);
        
    })
    
    $("#collapseToBottom").click(function(){
        $("html, body").animate({
            scrollTop: $(this).offset().top
        }, 600)
        console.log();
    })
    
    $(".showModal").click(function(){
        $("#profileModal").modal();
    })
    
    
})