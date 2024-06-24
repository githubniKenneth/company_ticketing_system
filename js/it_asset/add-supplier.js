// ADDING SUPPLIER AND PUT IT TO THE EMPTY SELECTION OF SUPPLIER
$(document).ready(function() {
    $('.addSupplierSave').click(function(){
        supplierInput = document.querySelector("#supplierInput").value;
        let selectSupplier = document.querySelectorAll(".supplier");
        // alert(itAssetInput);
        $.ajax({
            url: 'action_button/add-supplier.php',
            type: 'post',
            data: { supplierInput: supplierInput },
            success: function(response){
              if (response == 1) {
              $('#supplierInput').val('');
              $('.error-add').html('<div class="alert alert-danger" role="alert">Supplier already exist.</div>');
              $("#addSupplier2").modal('hide');
            } else {
              for (var i = 0; i < selectSupplier.length; i++) { //FIND EMPTY SELECT SUPPLIER
                if (selectSupplier[i].value == "") {
                  $(selectSupplier[i]).html(response);
                  $('#supplierInput').val('');
                  $('#addSupplier2').modal('hide');
                  $('.error-add').html('<div class="alert alert-success" role="alert">Supplier Added Successfully.</div>');
                  return false;
                }
                else {
                  $('#supplierInput').val('');
                  $('#addSupplier2').modal('hide');
                  $('.error-add').html('<div class="alert alert-success" role="alert">Supplier Added Successfully.</div>');
                }
              }
            }
            }
        });
    });
});
//JS FOR GETTING THE NEW SUPPLIER (EDITED)
$(document).ready(function() {
    $('.updateSupplierBtn').click(function(){
        let supplier_id = document.querySelector(".supplier_id").value;
        let supplier_name = document.querySelector(".supplier_name").value;
        let old_supplier_name = document.querySelector(".old_supplier_name").value;
        // alert(supplier_id);
        $.ajax({
            url: 'action_button/update-supplier.php',
            type: 'post',
            data: { supplier_id: supplier_id, supplier_name : supplier_name, old_supplier_name : old_supplier_name },
            success: function(response){
                if (response == 1) {
                  $("#editSupplierModal").modal('hide');
                  $("#showSupplier").modal('hide');
                  $("#addSupplier").modal('show');
                  $('.msg_edit_supplier').html("<p class='alert alert-danger'>Supplier already exist.</p>");
                }
                else if (response == 2) {
                  $("#editSupplierModal").modal('hide');
                  $("#showSupplier").modal('hide');
                  $("#addSupplier").modal('show');
                }
                else {
                  $("#addSupplier").modal('show');
                  $("#showSupplier").modal('hide');
                  $("#editSupplierModal").modal('hide');
                  $('.msg_edit_supplier').html(response);
                }
            }
        });
    });
});
