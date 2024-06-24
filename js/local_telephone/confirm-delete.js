// JS FOR CONFIRM DELETE LOCAL TELEPHONE
  $(document).ready(function() {
    $('.deleteTelLocal').click(function(){
        let telLocal = $(this).data('id');
        // alert(telLocal);
        $.ajax({
            url: 'action_button/confirm-delete-telLocal.php',
            type: 'post',
            data: { telLocal: telLocal },
            success: function(response){
                $('#delete-telLocal').html(response);
                $('#confirm-delete-telLocal').modal('show');
            }
        });
    });
  });
  $(document).ready( function () {
    $('#table_localTel').DataTable();
      });
