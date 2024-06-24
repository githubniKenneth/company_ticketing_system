// JS FOR SHOW THE EDIT MODAL OF A SPECIFIC DEVICE TYPE
  $(document).ready(function() {
      $('.editSupplierBtn').click(function(){
          let supplier_id = $(this).data('id');
          // alert(device_type_id);
          $.ajax({
              url: 'action_button/edit-supplier.php',
              type: 'post',
              data: { supplier_id: supplier_id },
              success: function(response){
                  $("#addSupplier").modal('hide');
                  $('.target-modal-editSupplier').html(response);
                  $("#editSupplierModal").modal('show');
              }
          });
      });
  });
