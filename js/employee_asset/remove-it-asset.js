// REMOVING EMPLOYEE IT ASSET
  $(document).ready(function() {
      $('.removeItAsset').click(function(){
          let employeeId = $(this).data('employee');
          let itAssetId = $(this).data('itasset');
          $(this).closest('tr').remove();
          // alert(itAssetId);
          $.ajax({
              url: 'action_button/remove-employee-asset.php',
              type: 'post',
              data: { itAssetId: itAssetId, employeeId : employeeId },
              success: function(response){
                  $('.remove-itAsset-access').html(response);
              }
          });
      });
  });
  $(document).ready( function () {
    $('#table_viewEmployeeAsset').DataTable();
      });
