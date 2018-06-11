$(function(){
   $('#seminar-allow').click(function(){
        $('#detail').toggle();  
       var specificPropertyParameters = anime({
            targets: '#detail',
            scale:1,
            rotate: '1turn',
             // All properties except 'scale' inherit 250ms delay
        }); 
   });
    
    $('#seminar-allow').hover(function(){
        $('#detail-sent').fadeIn();   
    },function(){
        $('#detail-sent').fadeOut();
    });
});