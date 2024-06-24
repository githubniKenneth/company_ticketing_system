// JS FOR CONFIRM DELETE EMPLOYEE
$(document).ready(function() {
    $('.deleteEmployee').click(function(){
        let employeeId = $(this).data('id');
        let telLocalId = $(this).data('tel');
        // alert(employeeId);
        $.ajax({
            url: 'action_button/confirm-delete-employee.php',
            type: 'post',
            data: { employeeId: employeeId, telLocalId: telLocalId},
            success: function(response){
                $('#delete-employee').html(response);
                $('#confirm-delete-employee').modal('show');
            }
        });
    });
});
