// JS FOR SEARCH BAR OF EMPLOYEE IT ASSET
    $(document).ready(function(){
    let inputSearch = document.querySelector(".input_searchBar");
          inputSearch.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
              event.preventDefault();
              document.querySelector(".btn_searchBar").click();

            let employeeiInput = document.querySelector(".input_searchBar").value;
            let employeefilter = employeeiInput.toUpperCase();
              // alert(filter);
              $.ajax({
                  type: "POST",
                  url: "action_button/search-employeeAsset.php",
                  data: { employeeInputVal: employeefilter }
              }).done(function(data){
                  $(".target-search-employeeAsset").html(data);
              });
            } else {
              $(".btn_searchBar").click(function(){
                let employeeiInput = document.querySelector(".input_searchBar").value;
                let employeefilter = employeeiInput.toUpperCase();
                  // alert(employeeiInput);
                  $.ajax({
                      type: "POST",
                      url: "action_button/search-employeeAsset.php",
                      data: { employeeInputVal: employeefilter }
                  }).done(function(data){
                      $(".target-search-employeeAsset").html(data);
                  });
              });
            }
          });
    });
    $(document).ready( function () {
      $('#table_employeeAsset').DataTable();
        });
