$(function() {
    var xhr = $.get("http://api.giphy.com/v1/gifs/search?q=funny+monkey&api_key=Jh224xwIOI33FI7V5fhOOZsv3uVW7zf3&limit=10");
    xhr.done(function(data) { 
        for (imageId = 0; imageId < 10; imageId++) {
            console.log(data);
            $('#' + 'gifImg' + imageId).attr('src', data.data[imageId].images.fixed_height_downsampled.url);
        }
    });
});

$(".gifImg").click(function(){
    $(".gifImg").removeClass("selectedGif");
    $(this).addClass("selectedGif");
    var currentGif = $(this).attr("src");
    console.log(currentGif);
    $('#gif_comment_commentTxt').val(currentGif);
});

/// Gif Search
$("#gifSearchBtn").click(function(){
    for (imageId = 0; imageId < 10; imageId++) {
        $('#' + 'gifImg' + imageId).attr('src', '../assets/img/loading.gif');
    }
    var xhr = $.get("http://api.giphy.com/v1/gifs/search?q="+$("#gifSearchBar").val()+"&api_key=Jh224xwIOI33FI7V5fhOOZsv3uVW7zf3&limit=10");
    xhr.done(function(data) { 
        for (imageId = 0; imageId < 10; imageId++) {
            $('#' + 'gifImg' + imageId).attr('src', data.data[imageId].images.fixed_height_downsampled.url);
        }
    });

});