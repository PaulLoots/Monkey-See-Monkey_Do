$(document).ready(function(){   

    // removeAdmin
      $(".removeAdmin").on("click", function(event){
        $( this ).parent().parent().parent().parent().hide(300);  
        var ansClicked = $(this).attr("value");
        console.log(ansClicked);
        $.ajax({  
           url:        '/admin',  
           type:       'POST',
           data: {vote: "RemoveAdmin", id: ansClicked},   
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
    //  $(".unbanButton").on("click", function(event){
    //     $( this ).parent().parent().parent().parent().hide(300);  
    //     var ansClicked = $(this).attr("value");
    //     console.log(ansClicked);
    //     $.ajax({  
    //        url:        '/admin',  
    //        type:       'POST',
    //        data: {vote: "UnbanProfile", id: ansClicked},   
    //        dataType:   'text',  
    //        async:      true,  
           
    //        success: function(data, status) {   
    //            console.log(data);
    //        },  
    //        error : function(xhr, textStatus, errorThrown) {  
    //           //alert('Ajax request failed.');  
    //        }  
    //     });  
    //  });
 
     
 });  
