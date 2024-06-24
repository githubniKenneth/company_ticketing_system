// JS FOR SEARCH BAR OF IT ASSET
$(document).ready(function(){
      let itAssetInput = document.querySelector("#itAsset_search");
          itAssetInput.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
              event.preventDefault();
              document.querySelector("#search_itAsset_btn").click();

              let itAssetInput = document.querySelector("#itAsset_search").value;
              let itAssetFilter = itAssetInput.toUpperCase();
              // alert(filter);
              $.ajax({
                  type: "POST",
                  url: "action_button/search-itAsset.php",
                  data: { itAssetInputVal: itAssetFilter }
              }).done(function(data){
                  $(".target-search-itAsset").html(data);
              });
            } else {
              $("#search_itAsset_btn").click(function(){
                  let itAssetInput = document.querySelector("#itAsset_search").value;
                  let itAssetFilter = itAssetInput.toUpperCase();
                  // alert(employeeiInput);
                  $.ajax({
                      type: "POST",
                      url: "action_button/search-itAsset.php",
                      data: { itAssetInputVal: itAssetFilter }
                  }).done(function(data){
                      $(".target-search-itAsset").html(data);
                  });
              });
            }
          });
    });
// DATATABLE
      $(document).ready( function () {
        $('#table_itAsset').DataTable();
          });
