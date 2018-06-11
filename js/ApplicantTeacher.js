$(function(){
    $('#btn-submit').click(function(){
       $('#submit-modal').fadeIn(); 
    });
    
     $('#no').click(function(){
       $('#submit-modal').fadeOut(); 
    });
    
    $('#cancel').click(function(){
        $('#submit-modal').fadeOut();
    });
    
    $('#seminar-detail').click(function(){
       $('#seminar-detail-sent').toggle('slow'); 
    });
    
});