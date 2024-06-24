//  JS FOR ADDING IT ASSET TO EMPLOYEE
  $(document).ready(function() {
      $('.addItAsset').click(function(){
          let employeeId = $(this).data('employee');
          let itAssetId = $(this).data('itasset');
          $(this).closest('tr').remove();
          // alert(itAssetId);
          $.ajax({
              url: 'action_button/set-employee-asset.php',
              type: 'post',
              data: { itAssetId: itAssetId, employeeId : employeeId },
              success: function(response){
                  $('.assign-itAsset-access').html(response);
              }
          });
      });
  });
    $(document).ready( function () {
      $('#table_addEmployeeAsset').DataTable();
        });
