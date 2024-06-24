  // CLOSE THE MODAL OF ADD DEVICE TYPE
  $(document).ready(function(){
        $(".close_modal_add_deviceType").click(function(){
            $("#addDeviceType2").modal('hide');
        });
    });
  // CLOSE THE MODAL OF ADD SUPPLIER
  $(document).ready(function(){
        $(".close_modal_add_supplier").click(function(){
            $("#addSupplier2").modal('hide');
        });
    });
  // CLOSE THE MODAL OF ADD SUPPLIER
  $(document).ready(function(){
        $(".close_show_supplier").click(function(){
            $("#showSupplier").modal('hide');
        });
    });
  // JS FOR CLOSING THE EDIT MODAL AND SHOWING THE LIST OF DEVICE TYPE
    $(document).ready(function(){
        $(".edit_device_type_close").click(function(){
          $("#showDeviceType").modal('show');
          $("#editDeviceTypeModal").modal('hide');
          $("#addDeviceType").modal('show');
        });
    });
  // JS FOR CLOSING THE EDIT MODAL AND SHOWING THE LIST OF SUPPLIER
    $(document).ready(function(){
        $(".edit_supplier_close").click(function(){
          $("#showSupplier").modal('show');
          $("#editSupplierModal").modal('hide');
          $("#addSupplier").modal('show');
        });
    });
  // JS FOR CLOSING THE SHOW DEVICE TYPE LIST
    $(document).ready(function(){
      $(".close_show_device_type").click(function(){
          $("#showDeviceType").modal('hide');
      });
    });
