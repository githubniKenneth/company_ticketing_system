// JS FOR EDIT IT ASSET MODAL
$(document).ready(function() {
    $('.editAsset').click(function(){
        let assetId = $(this).data('id');
        // alert(employeeId);
        $.ajax({
            url: 'action_button/edit-it-asset.php',
            type: 'post',
            data: { assetId: assetId },
            success: function(response){
                $('#target-modal-editAsset').html(response);
                $('#editItAssetModal').modal('show');
            }
        });
    });
});
