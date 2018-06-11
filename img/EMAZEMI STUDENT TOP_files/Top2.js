
$(function () {
    $(document).ready(function(){
    $('.animsition').animsition({
       inClass: 'fade-in',
    outClass: 'fade-out',
    inDuration: 1500,
    outDuration: 800,
    linkElement: '.animsition-link',
    // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
    loading: true,
    loadingParentElement: 'body', //animsition wrapper element
    loadingClass: 'animsition-loading',
    loadingInner: '', // e.g '<img src="loading.svg" />'
    timeout: false,
    timeoutCountdown: 5000,
    onLoadEvent: true,
    browser: [ 'animation-duration', '-webkit-animation-duration'],
    // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
    // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
    overlay : false,
    overlayClass : 'animsition-overlay-slide',
    overlayParentElement : 'body',
    transition: function(url){ window.location.href = url; }
    });
});
    
    
    //教える人のhover
    $('#teach-link').hover(() => {　　
        $('.circle1').fadeIn();
         var specificPropertyParameters = anime({
            targets: '.circle1',
            rotate: {
                value: 360,
                duration: 100,
                easing: 'easeInOutSine'
            },
            scale: {
                value: 2,
                duration: 700,
                easing: 'easeInOutQuart'
            },
            delay: 150, // All properties except 'scale' inherit 250ms delay
            direction: 'alternate',
             loop:true,
        });
        $('#teach-link p').css('color', 'white');
        //hoverを外した時
    }, function () {
        $('.circle1').fadeOut();　　
        $('#teach-link p').css('color', 'black');
    });

    
    $('#learn-link').hover(() => {
        $('.circle2').fadeIn();
        var specificPropertyParameters = anime({
            targets: '.circle2',
            rotate: {
                value: 360,
                duration: 100,
                easing: 'easeInOutSine'
            },
            scale: {
                value: 2,
                duration: 700,
                easing: 'easeInOutQuart'
            },
            delay: 150, // All properties except 'scale' inherit 250ms delay
            direction: 'alternate',
            loop:true,
        });
        $('#learn-link p').css('color', 'white');
        
    }, function () {
        $('.circle2').fadeOut();
        $('#learn-link p').css('color', 'black');
    });
    


    /*var specificPropertyParameters = anime({
        targets: '.circle2',
        rotate: {
            value: 360,
            duration: 1800,
            easing: 'easeInOutSine'
        },
        scale: {
            value: 2,
            duration: 1600,
            delay: 800,
            easing: 'easeInOutQuart'
        },
        delay: 250 // All properties except 'scale' inherit 250ms delay
    });*/

});
