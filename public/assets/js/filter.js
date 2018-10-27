$("#filterAll").click(function(){
    $(".filterBtns").removeClass("selectedFilter");
    $(this).addClass("selectedFilter");

    $.ajax({  
        url:        '/discover',  
        type:       'POST',
        data: { filter: "all"},   
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

$("#filterUsers").click(function(){
    $(".filterBtns").removeClass("selectedFilter");
    $(this).removeClass("filterUsers");
    $(this).addClass("noHover");
    $("#filterSearchCol").css({"margin-left":"-30%","transition":"all 0.3s"});
    $("#filterUsers").css({"width":"350%", "padding-right":"20px"});
    $("#searchTxt").css({"display":"none"});
    $("#searchIcon").css({"opacity":"0"});
    setTimeout(function(){
      $("#userSearchBox").css({"display":"block"});
      $(".searchUserBtn").css({"display":"block"});
    }, 300);
});

$(".searchUserBtn").click(function(){
    var username = $("#userSearchBox").val();
    console.log(username);
    $.ajax({  
       url:        '/discover',  
       type:       'POST',
       data: { filter: "user", username: username },   
       dataType:   'text',  
       async:      true,  
       
       success: function(data, status) {   
           console.log(data);
           document.location.reload(true);
       },  
       error : function(xhr, textStatus, errorThrown) {  
        document.location.reload(true);
          //alert('Ajax request failed.');  
       }  
    });
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
    $(this).addClass("selectedFilter");

    $.ajax({  
        url: '/discover',  
        type: 'POST',
        data: { filter: "answered"},   
        dataType: 'text',  
        async: true,  
        
        success: function(data, status) {   
            console.log(data);
            document.location.reload(true);
        },  
        error : function(xhr, textStatus, errorThrown) {  
           //alert('Ajax request failed.');  
        }  
     });
});