$(function(){
    //tab1をクリック
    $('#tab1').click(function(){
        $('#tab2-content').hide();
        $('#tab3-content').hide();
        $('#tab1-content').show();
    });
    //tab2をクリック
    $('#tab2').click(function(){
        $('#tab1-content').hide();
        $('#tab3-content').hide();
        $('#tab2-content').show();
    });
    //tab3をクリッ区
    $('#tab3').click(function(){
        $('#tab1-content').hide();
        $('#tab2-content').hide();
        $('#tab3-content').show();
    });
    
    //tab選択時のホバー
    
    
});