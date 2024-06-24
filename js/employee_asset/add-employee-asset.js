// JS FOR ADD EMPLOYEE ASSET
$(document).ready(function() {
    $('.addAsset').click(function(){
        let employee_id = $(this).data('id');
        // $('#viewUserModal').modal('show');
        // alert(employeeId);
        $.ajax({
            url: 'action_button/add-employee-asset.php',
            type: 'post',
            data: { employee_id: employee_id },
            success: function(response){
                $('#target-modal-addAsset').html(response);
                $('#addEmployeeItAssetModal').modal('show');
            }
        });
    });
});
