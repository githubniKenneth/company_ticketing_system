    // ticket-messages.php
$(function(){
    const ticket_id = $('#ticket_id').val();
    const dataStr = 'ticket_id='+ticket_id;
    setInterval(function(){
        $.ajax({
            type:'GET',
            url:'message-loader.php',
            data:dataStr,
            success:function(e){
                $('#ul_data').html(e);
            }
        });
    }, 100);
});

