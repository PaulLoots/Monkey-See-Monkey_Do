$("#filterAll").click(function(){
    $(".filterBtns").removeClass("selectedFilter");
    $(this).addClass("selectedFilter")
});

$("#filterUsers").click(function(){
    $(".filterBtns").removeClass("selectedFilter");
    $(this).addClass("selectedFilter")
});

$("#filterLiked").click(function(){
    $(".filterBtns").removeClass("selectedFilter");
    $(this).addClass("selectedFilter")

    $.ajax({  
       url:        '/discover',  
       type:       'POST',
       data: { filter: "likes"},   
       dataType:   'text',  
       async:      true,  
       
       success: function(data, status) {   
           console.log(data);
           document.location.reload(true);
       },  
       error : function(xhr, textStatus, errorThrown) {  
          //alert('Ajax request failed.');  
       }  
    });
});

$("#filterAnswered").click(function(){
    $(".filterBtns").removeClass("selectedFilter");
    $(this).addClass("selectedFilter")
});