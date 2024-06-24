
  // JS FOR SEARCH BAR OF SUPPLIER
  $(document).ready(function(){
        let supplierInput = document.querySelector("#srch_input_supplier");
            supplierInput.addEventListener("keypress", function(event) {
              if (event.key === "Enter") {
                event.preventDefault();
                document.querySelector("#srch_btn_supplier").click();

                let supplierInput = document.querySelector("#srch_input_supplier").value;
                let supplierFilter = supplierInput.toUpperCase();
                // alert(filter);
                $.ajax({
                    type: "POST",
                    url: "action_button/search-supplier.php",
                    data: { supplierInputVal: supplierFilter }
                }).done(function(data){
                    $(".target-search-supplier").html(data);
                });
              } else {
                $("#srch_btn_supplier").click(function(){
                  let  supplierInput = document.querySelector("#srch_input_supplier").value;
                  let  supplierFilter = supplierInput.toUpperCase();
                    // alert(employeeiInput);
                    $.ajax({
                        type: "POST",
                        url: "action_button/search-supplier.php",
                        data: { supplierInputVal: supplierFilter }
                    }).done(function(data){
                        $(".target-search-supplier").html(data);
                    });
                });
              }
            });
      });
      $(document).ready( function () {
        $('#table_supplier').DataTable();
          });
      // JS FOR CLOSING THE SHOW SUPPLIER LIST
        $(document).ready(function(){
          $(".close_show_supplier").click(function(){
              $("#showSupplier").modal('hide');
          });
        });
      // JS FOR CLOSING THE EDIT MODAL AND SHOWING THE LIST OF SUPPLIER
        $(document).ready(function(){
          $(".edit_supplier_close").click(function(){
              $("#editSupplierModal").modal('hide');
              $("#showSupplier").modal('hide');
              $("#addSupplier").modal('show');
          });
        });
