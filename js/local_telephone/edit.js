// JS FOR EDIT LOCAL TELEPHONE
  $(document).ready(function() {
      $('.editTelLocal').click(function(){
          let tel_local_id = $(this).data('id');
          // alert(employeeId);
          $.ajax({
              url: 'action_button/edit-local-line.php',
              type: 'post',
              data: { tel_local_id: tel_local_id },
              success: function(response){
                  $('#target-modal-edit').html(response);
                  $('#editTelLocalModal').modal('show');
              }
          });
      });
  });
