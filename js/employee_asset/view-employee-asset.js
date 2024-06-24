// JS FOR VIEW EMPLOYEE ASSET
$(document).ready(function() {
    $('.reviewAsset').click(function(){
        let employee_id = $(this).data('id');
        // $('#viewUserModal').modal('show');
        // alert(employeeId);
        $.ajax({
            url: 'action_button/view-employee-asset.php',
            type: 'post',
            data: { employee_id: employee_id },
            success: function(response){
                $('#target-modal-viewAsset').html(response);
                $('#viewItAssetModal').modal('show');
            }
        });
    });
});
