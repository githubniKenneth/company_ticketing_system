$(function(){
    const selected_user = $('#selected_user').val();
    const dataStr = 'selected_user='+selected_user;
    
        $.ajax({
            type:'GET',
            url:'access-rights-loader.php',
            data:dataStr,
            success:function(e){
                
            }
        });
    
});