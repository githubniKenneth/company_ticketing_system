// REFRESH THE SELECT ITEM OF SUPPLIER ON CLICK SELECT
$(document).ready(function() {
      $(document).on('click', '.supplier', function() {
        let targetSelect = $(this).data('id');
        let selectVal1 = document.querySelector('.targetSupplier-'+targetSelect+'').value;
        $.ajax({
            url: 'action_button/select-supplier.php',
            type: 'post',
            data: { selectVal : selectVal1 },
            success: function(response){
                  $('.targetSupplier-'+targetSelect+'').html(response);
                  $('.error-add').css('display', 'none');
              }
          });
    });
  });
