// JS FOR SHOW THE EDIT MODAL OF A SPECIFIC DEVICE TYPE
  $(document).ready(function() {
      $('.editDeviceTypeBtn').click(function(){
          let device_type_id = $(this).data('id');
          // alert(device_type_id);
          $.ajax({
              url: 'action_button/edit-device-type.php',
              type: 'post',
              data: { device_type_id: device_type_id },
              success: function(response){
                  $("#addDeviceType").modal('hide');
                  $('.target-modal-editDeviceType').html(response);
                  $("#editDeviceTypeModal").modal('show');
              }
          });
      });
  });
