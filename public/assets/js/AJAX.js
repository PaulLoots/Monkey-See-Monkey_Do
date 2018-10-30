$(document).ready(function(){   
    $("#likeRiddle").on("click", function(event){  
    var amount = parseInt($(this).children( "p" ).text());
    var id = $(this).attr("value");
    $(this).children( "p" ).text(amount + 1);
       $.ajax({  
          url:        '/answers',  
          type:       'POST',
          data: { entity: "Riddle", vote: "Like", id: id},   
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
    
    $("#dislikeRiddle").on("click", function(event){  
        var amount = parseInt($(this).children( "p" ).text());
        $(this).children( "p" ).text(amount + 1);
        var id = $(this).attr("value");
       $.ajax({  
          url:        '/answers',  
          type:       'POST',
          data: { entity: "Riddle", vote: "Dislike", id: id},   
          dataType:   'json',  
          async:      true,  
          
          success: function(data, status) {   
              
          },  
          error : function(xhr, textStatus, errorThrown) {  
             //alert('Ajax request failed.');  
          }  
       });  
    }); 
    
    $(".likeAnswer").on("click", function(event){ 
        var amount = parseInt($(this).children( "p" ).text());
        $(this).children( "p" ).text(amount + 1); 
       var ansClicked = $(this).attr("value");
       $.ajax({  
          url:        '/answers',  
          type:       'POST',
          data: { entity: "Answer", vote: "Like", id: ansClicked},   
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

    $(".dislikeAnswer").on("click", function(event){ 
        var amount = parseInt($(this).children( "p" ).text());
        $(this).children( "p" ).text(amount + 1); 
        var ansClicked = $(this).attr("value");
        $.ajax({  
           url:        '/answers',  
           type:       'POST',
           data: { entity: "Answer", vote: "Dislike", id: ansClicked},   
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

     $(".likeComment").on("click", function(event){
        var amount = parseInt($(this).children( "p" ).text());
        $(this).children( "p" ).text(amount + 1);  
        var ansClicked = $(this).attr("value");
        $.ajax({  
           url:        '/answers',  
           type:       'POST',
           data: { entity: "Comment", vote: "Like", id: ansClicked},   
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
 
     $(".dislikeComment").on("click", function(event){ 
        var amount = parseInt($(this).children( "p" ).text());
        $(this).children( "p" ).text(amount + 1); 
         var ansClicked = $(this).attr("value");
         $.ajax({  
            url:        '/answers',  
            type:       'POST',
            data: { entity: "Comment", vote: "Dislike", id: ansClicked},   
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

      $(".answerCorrect").on("click", function(event){
        $( this ).parent().parent().parent().hide(300);  
        var ansClicked = $(this).attr("value");
        $.ajax({  
           url:        '/myriddles',  
           type:       'POST',
           data: { vote: "Correct", id: ansClicked},   
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
 
     $(".answerIncorrect").on("click", function(event){ 
         $( this ).parent().parent().parent().hide(300); 
         var ansClicked = $(this).attr("value");
         $.ajax({  
            url:        '/myriddles',  
            type:       'POST',
            data: { vote: "Incorrect", id: ansClicked},   
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


      //Report Button
      $(".reportRiddle").on("click", function(event){ 
          //styling
        //$(this).css({"opacity":"1 !important"});
        var ansClicked = $(this).attr("value");
        console.log(ansClicked);
        $.ajax({  
           url: '/answers',
           type: 'POST',
           data: { entity: "Report", id: ansClicked, vote: "reportRiddle"},   
           dataType: 'text',  
           async: true,  
           
           success: function(data, status) {   
               console.log(data);
           },
           error : function(xhr, textStatus, errorThrown) {  
              //alert('Ajax request failed.');  
           }  
        });  
     });

     $(".reportAnswer").on("click", function(event){ 
        //styling
      $(this).css({"opacity":"1 !important"});
      var ansClicked = $(this).attr("value");
      $.ajax({  
         url:        '/answers',  
         type:       'POST',
         data: { entity: "Report", id: ansClicked, vote:"reportAnswer"},   
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


   $(".reportComment").on("click", function(event){ 
    //styling
  $(this).css({"opacity":"1 !important"});
  var ansClicked = $(this).attr("value");
  console.log(ansClicked);
  $.ajax({  
     url:        '/answers',  
     type:       'POST',
     data: { entity: "Report", id: ansClicked, vote:"reportComment"},   
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

 