$(function () {
    //教える人のhover
    $('#teach-sent').hover(() => {　　
        $('#hovlogo1').fadeIn();
        var specificPropertyParameters = anime({
            targets: '#hovlogo1',
            scale: {
                value: 2,
                duration: 700,
                easing: 'easeInOutQuart'
            },
            delay: 150, // All properties except 'scale' inherit 250ms delay
            direction: 'alternate',
        });
        $('#teach-sent').css('color', 'white');
        //hoverを外した時
    }, function () {
        $('#hovlogo1').fadeOut();　　
        $('#teach-sent').css('color', 'black');
    });  
    
    
        $('#student-sent').hover(() => {　　
        $('#hovlogo2').fadeIn();
        var specificPropertyParameters = anime({
            targets: '#hovlogo2',
            scale: {
                value: 2,
                duration: 700,
                easing: 'easeInOutQuart'
            },
            delay: 150, // All properties except 'scale' inherit 250ms delay
            direction: 'alternate',
        });
        $('#student-sent').css('color', 'white');
        //hoverを外した時
    }, function () {
        $('#hovlogo2').fadeOut();　　
        $('#student-sent').css('color', 'black');
    });
});