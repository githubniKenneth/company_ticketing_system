// JS EDIT EXTERNAL TELEPHONE
  $(document).ready(function() {
      $('.editTelExternal').click(function(){
          let tel_ex_id = $(this).data('id');
          // $('#viewUserModal').modal('show');
          // alert(employeeId);
          $.ajax({
              url: 'action_button/edit-external-line.php',
              type: 'post',
              data: { tel_ex_id: tel_ex_id },
              success: function(response){
                  $('#target-modal-edit').html(response);
                  $('#editTelExternalModal').modal('show');
              }
          });
      });
  });
