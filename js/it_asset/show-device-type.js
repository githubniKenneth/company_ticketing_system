// JS TO SHOW THE LIST OF DEVICE TYPE AFTER CLICKING THE SHOW BTN INSIDE THE ADD DEVICE TYPE MODAL
$(document).ready(function() {
    $('.show_device_type').click(function(){
        $.ajax({
            url: 'action_button/show-device-type.php',
            success: function(response){
                $('.showDeviceType_body').html(response);
                $("#showDeviceType").modal('show');
            }
        });
    });
});
