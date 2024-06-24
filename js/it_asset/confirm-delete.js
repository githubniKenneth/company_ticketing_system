// JS FOR CONFIRMING DELETE IT ASSET
$(document).ready(function() {
    $('.deleteAsset').click(function(){
        let assetId = $(this).data('id');
        // alert(employeeId);
        $.ajax({
            url: 'action_button/confirm-delete-itAsset.php',
            type: 'post',
            data: { assetId: assetId },
            success: function(response){
                $('#delete-itAsset').html(response);
                $('#confirm-delete-itasset').modal('show');
            }
        });
    });
});
