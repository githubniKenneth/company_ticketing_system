// JS CONFIRM DELETE EXTERNAL TELEPHONE
  $(document).ready(function() {
      $('.deleteTelExternal').click(function(){
          let telExternal = $(this).data('id');
          // $('#viewUserModal').modal('show');
          // alert(telLocal);
          $.ajax({
              url: 'action_button/confirm-delete-externalTel.php',
              type: 'post',
              data: { telExternal: telExternal },
              success: function(response){
                  $('#delete-externalTel').html(response);
                  $('#confirm-delete-externalTel').modal('show');
              }
          });
      });
  });
