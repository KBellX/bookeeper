$(function(){
        $(window).scroll(function(){
         
            if($(window).scrollTop()!==0){
                $('.header-inner').css({
                'background':'#fff',
                'position':'fixed',
                'top':'0px',
                // 'left':$offset.left+'px',
                // 'z-index':'999'
                });    
            }else{
                $('.header-inner').removeAttr('style');
            }
        });
    })