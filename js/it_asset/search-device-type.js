// JS FOR SEARCH BAR OF SUPPLIER
$(document).ready(function(){
    let deviceTypeInput = document.querySelector("#srch_input_deviceType");
          deviceTypeInput.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
              event.preventDefault();
              document.querySelector("#srch_btn_deviceType").click();

            let deviceTypeInput = document.querySelector("#srch_input_deviceType").value;
            let deviceTypeFilter = deviceTypeInput.toUpperCase();
              // alert(filter);
              $.ajax({
                  type: "POST",
                  url: "action_button/search-device-type.php",
                  data: { deviceTypeInputVal: deviceTypeFilter }
              }).done(function(data){
                  $(".target-search-deviceType").html(data);
              });
            } else {
              $("#srch_btn_deviceType").click(function(){
                let deviceTypeInput = document.querySelector("#srch_input_deviceType").value;
                let deviceTypeFilter = deviceTypeInput.toUpperCase();
                  // alert(employeeiInput);
                  $.ajax({
                      type: "POST",
                      url: "action_button/search-device-type.php",
                      data: { deviceTypeInputVal: deviceTypeFilter }
                  }).done(function(data){
                      $(".target-search-deviceType").html(data);
                  });
              });
            }
          });
    });
    $(document).ready( function () {
      $('#table_deviceType').DataTable();
        });
  // JS FOR CLOSING THE EDIT MODAL AND SHOWING THE LIST OF DEVICE TYPE
    $(document).ready(function(){
      $(".edit_device_type_close").click(function(){
          $("#editDeviceTypeModal").modal('hide');
          $("#showDeviceType").modal('hide');
          $("#addDeviceType").modal('show');
      });
    });
