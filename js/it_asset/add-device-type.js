// ADDING DEVICE TYPE AND PUT IT TO THE EMPTY SELECTION OF DEVICE TYPE
$(document).ready(function() {
    $('.addDeviceTypeSave').click(function(){
        itAssetInput = document.querySelector("#deviceTypeInput").value;
        let selectDeviceType = document.querySelectorAll(".d-type");
        // alert(itAssetInput);
        $.ajax({
            url: 'action_button/add-device-type.php',
            type: 'post',
            data: { itAssetInput: itAssetInput },
            success: function(response){
              if (response == 1) {
              $('#deviceTypeInput').val('');
              $('.error-add').html('<div class="alert alert-danger" role="alert">The device type already exist</div>');
              $("#addDeviceType2").modal('hide');
            } else {
              for (var i = 0; i < selectDeviceType.length; i++) {
                if (selectDeviceType[i].value == "") { //FIND EMPTY SELECT DEVICE TYPE
                  $(selectDeviceType[i]).html(response);
                  $('#deviceTypeInput').val('');
                  $('#addDeviceType2').modal('hide');
                  $('.error-add').html('<div class="alert alert-success" role="alert">Device Type Added Successfully.</div>');
                  return false;
                }
                else {
                  $('#deviceTypeInput').val('');
                  $('#addDeviceType2').modal('hide');
                  $('.error-add').html('<div class="alert alert-success" role="alert">Device Type Added Successfully.</div>');
                }
              }
            }
            }
        });
    });
});
//JS FOR GETTING THE NEW DEVICE TYPE (EDITED)
$(document).ready(function() {
    $('.updateDeviceTypeBtn').click(function(){
        let device_type_id = document.querySelector(".device_type_id").value;
        let device_type_name = document.querySelector(".device_type_name").value;
        let old_device_type_name = document.querySelector(".old_device_type_name").value;
        // alert(device_type_id);
        $.ajax({
            url: 'action_button/update-device-type.php',
            type: 'post',
            data: { device_type_id: device_type_id, device_type_name : device_type_name, old_device_type_name : old_device_type_name },
            success: function(response){
                if (response == 1) {
                  $("#editDeviceTypeModal").modal('hide');
                  $("#showDeviceType").modal('hide');
                  $("#addDeviceType").modal('show');
                  $('.msg_edit_device_type').html("<p class='alert alert-danger'>The device type already exist</p>");
                }
                else if (response == 2) {
                  $("#editDeviceTypeModal").modal('hide');
                  $("#showDeviceType").modal('hide');
                  $("#addDeviceType").modal('show');
                }
                else {
                  $("#addDeviceType").modal('show');
                  $("#showDeviceType").modal('hide');
                  $("#editDeviceTypeModal").modal('hide');
                  $('.msg_edit_device_type').html(response);
                }
            }
        });
    });
});
