$(window).on('resize', function() {

    // Same code as on load        
    var aspectRatio = 1.25;
    var video = $('#videoWithJs iframe');
    var videoHeight = video.outerHeight();
    var newWidth = videoHeight*aspectRatio;
    var halfNewWidth = newWidth/6;

    video.css({"width":newWidth+"px","left":"50%","margin-left":"-"+halfNewWidth+"px"});

});