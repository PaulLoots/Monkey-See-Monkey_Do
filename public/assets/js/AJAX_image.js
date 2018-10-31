$(document).ready(function(){   

    $(".selectImage").on("click", function(event){
        $('.selectImage').removeClass('activePP');
        $(".la-check").hide();
        $(this).children(".la-check").show();
        $(this).addClass('activePP');
        var ansClicked = $(this).attr("value");
        console.log(ansClicked);

        $.ajax({  
           url:        '/editprofile',  
           type:       'POST',
           data: {action: "changeImage", id: ansClicked},   
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

    $("#imageUpload").change(function(){
        ("#Uploadform").submit();
    });
 
 });  

 function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.filebutton2').css('background-image', 'url(' + e.target.result + ')');
            $('.filebutton2').hide();
            $('.filebutton2').fadeIn(650);
            $("#profile_image_submit").css('display', 'block');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
