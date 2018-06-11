
$(function () {    
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
