$(document).ready(function(){
    checkInView();
    $(window).on('scroll resize', function(){
        checkInView();
    })
});

//add animation when the animate-content class is view in screen
function checkInView(){
    $(".animate-content").each(function(){
        var scrollTop = $(window).scrollTop();
        var scrollBottom = scrollTop + $(window).height();
        if(scrollBottom>900){
            $(this).addClass('animate__fadeInUp');
        }else if(scrollBottom<1500){
            $(this).removeClass('animate__fadeInUp');
        }
    });
}