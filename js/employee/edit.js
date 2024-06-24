// JS FOR EDIT EMPLOYEE
$(document).ready(function() {
    $('.editEmployee').click(function(){
        let employeeId = $(this).data('id');
        // alert(employeeId);
        $.ajax({
            url: 'action_button/edit-employee.php',
            type: 'post',
            data: { employeeId: employeeId },
            success: function(response){
                $('#target-modal-edit').html(response);
                $('#editEmployeeModal').modal('show');
            }
        });
    });
});
