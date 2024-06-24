// REFRESH THE SELECT ITEM OF DEVICE TYPE ON CLICK SELECT
$(document).ready(function() {
    $(document).on('click', '.d-type', function(){
      let target = $(this).data('id');
      let selectVal2 = document.querySelector('.targetDeviceType-'+target+'').value;
      $.ajax({
          url: 'action_button/select-device-type.php',
          type: 'post',
          data: { selectVal2 : selectVal2 },
          success: function(response){
              $('.targetDeviceType-'+target+'').html(response);
              $('.error-add').css('display', 'none');
            }
        });
      });
  });
