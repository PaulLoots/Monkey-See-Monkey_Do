$(document).ready(function(){   

    // removeAdmin
      $(".removeAdmin").on("click", function(event){
        $( this ).parent().parent().parent().parent().hide(300);  
        var ansClicked = $(this).attr("value");
        console.log(ansClicked);
        $.ajax({  
           url:        '/admin',  
           type:       'POST',
           data: {action: "RemoveAdmin", id: ansClicked, target: "AdminList"},   
           dataType:   'text',  
           async:      true,  
           
           success: function(data, status) {   
               console.log(data);
           },  
           error : function(xhr, textStatus, errorThrown) {  
              //alert('Ajax request failed.');  
           }  
        });  
     });

// Ban Profile
$(".banButton").on("click", function(event){
    $( this ).parent().parent().parent().parent().hide(300);  
    var ansClicked = $(this).attr("value");
    console.log(ansClicked);
    $.ajax({  
       url:        '/admin',  
       type:       'POST',
       data: {action: "BanProfile", id: ansClicked, target: "BannedList"},   
       dataType:   'text',  
       async:      true,  
       
       success: function(data, status) {   
           console.log(data);
       },  
       error : function(xhr, textStatus, errorThrown) {  
          //alert('Ajax request failed.');  
       }  
    });  
 });


// unBan Profile
     $(".unbanButton").on("click", function(event){
        $( this ).parent().parent().parent().parent().hide(300);  
        var ansClicked = $(this).attr("value");
        console.log(ansClicked);
        $.ajax({  
           url:        '/admin',  
           type:       'POST',
           data: {action: "UnbanProfile", id: ansClicked, target: "BannedList"},   
           dataType:   'text',  
           async:      true,  
           
           success: function(data, status) {   
               console.log(data);
           },  
           error : function(xhr, textStatus, errorThrown) {  
              //alert('Ajax request failed.');  
           }  
        });  
     });

     // addAdmin
     $(".addAdmin").on("click", function(event){
        $( this ).parent().parent().parent().parent().hide(300);  
        var ansClicked = $(this).attr("value");
        console.log(ansClicked);
        $.ajax({  
           url:        '/admin',  
           type:       'POST',
           data: {action: "AddAdmin", id: ansClicked, target: "UsersList"},   
           dataType:   'text',  
           async:      true,  
           
           success: function(data, status) {   
               console.log(data);
           },  
           error : function(xhr, textStatus, errorThrown) {  
              //alert('Ajax request failed.');  
           }  
        });  
     });

     //removeUser



     //dismissRiddle
     $(".dismissRiddle").on("click", function(event){
        $( this ).parent().parent().parent().parent().hide(300);  
        var ansClicked = $(this).attr("value");
        console.log(ansClicked);
        $.ajax({  
           url:        '/admin',  
           type:       'POST',
           data: {action: "dismissRiddle", id: ansClicked, target: "ReportedRiddle"},   
           dataType:   'text',  
           async:      true,  
           
           success: function(data, status) {   
               console.log(data);
           },  
           error : function(xhr, textStatus, errorThrown) {  
              //alert('Ajax request failed.');  
           }  
        });  
     });
 

     //delete Riddle

     $(".deleteRiddle").on("click", function(event){
        $( this ).parent().parent().parent().parent().hide(300);  
        var ansClicked = $(this).attr("value");
        console.log(ansClicked);
        $.ajax({  
            url:        '/admin',  
            type:       'POST',
            data: {action: "deleteRiddle", id: ansClicked, target: "ReportedRiddleDelete"},   
            dataType:   'text',  
            async:      true,  
            
            success: function(data, status) {   
                console.log(data);
            },  
            error : function(xhr, textStatus, errorThrown) {  
                //alert('Ajax request failed.');  
            }  
        });  
    });


     //dismiss Answer
     $(".dismissAnswer").on("click", function(event){
        $( this ).parent().parent().parent().parent().hide(300);  
        var ansClicked = $(this).attr("value");
        console.log(ansClicked);
        $.ajax({  
           url:        '/admin',  
           type:       'POST',
           data: {action: "dismissAnswer", id: ansClicked, target: "ReportedAnswer"},   
           dataType:   'text',  
           async:      true,  
           
           success: function(data, status) {   
               console.log(data);
           },  
           error : function(xhr, textStatus, errorThrown) {  
              //alert('Ajax request failed.');  
           }  
        });  
     });



     //delete Answer
     $(".deleteAnswer").on("click", function(event){
        $( this ).parent().parent().parent().parent().hide(300);  
        var ansClicked = $(this).attr("value");
        console.log(ansClicked);
        $.ajax({  
            url:        '/admin',  
            type:       'POST',
            data: {action: "deleteAnswer", id: ansClicked, target: "ReportedAnswerDelete"},   
            dataType:   'text',  
            async:      true,  
            
            success: function(data, status) {   
                console.log(data);
            },  
            error : function(xhr, textStatus, errorThrown) {  
                //alert('Ajax request failed.');  
            }  
        });  
    });
     


    //dismiss Comment
    $(".dismissComment").on("click", function(event){
        $( this ).parent().parent().parent().parent().hide(300);  
        var ansClicked = $(this).attr("value");
        console.log(ansClicked);
        $.ajax({  
            url:        '/admin',  
            type:       'POST',
            data: {action: "dismissComment", id: ansClicked, target: "ReportedComment"},   
            dataType:   'text',  
            async:      true,  
            
            success: function(data, status) {   
                console.log(data);
            },  
            error : function(xhr, textStatus, errorThrown) {  
                //alert('Ajax request failed.');  
            }  
        });  
    });


    //delete Comment
    $(".deleteComment").on("click", function(event){
        $( this ).parent().parent().parent().parent().hide(300);  
        var ansClicked = $(this).attr("value");
        console.log(ansClicked);
        $.ajax({  
            url:        '/admin',  
            type:       'POST',
            data: {action: "deleteComment", id: ansClicked, target: "ReportedCommentDelete"},   
            dataType:   'text',  
            async:      true,  
            
            success: function(data, status) {   
                console.log(data);
            },  
            error : function(xhr, textStatus, errorThrown) {  
                //alert('Ajax request failed.');  
            }  
        });  
    });
     
 });  
