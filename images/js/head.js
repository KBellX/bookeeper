$(function(){
        $(window).scroll(function(){
            $offset = $('#fh5co-header').offset();
            if($(window).scrollTop()>$offset.top){
                $('.nav').css({
                'background':'#fff',
                'position':'fixed',
                'top':'0px',
                'left':$offset.left+'px',
                'z-index':'999'
                });    
            }else{
                $('.nav').removeAttr('style');
            }
        });
    })