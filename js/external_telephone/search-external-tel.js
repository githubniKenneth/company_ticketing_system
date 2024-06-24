// JS FOR SEARCH BAR OF EXTERNAL TELEPHONE DIRECTORY
$(document).ready(function(){
      externalInput = document.querySelector("#external_input_searchBar");
          externalInput.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
              event.preventDefault();
              document.querySelector("#external_btn_searchBar").click();

              externalInput = document.querySelector("#external_input_searchBar").value;
              externalFilter = externalInput.toUpperCase();
              // alert(filter);
              $.ajax({
                  type: "POST",
                  url: "action_button/search-external-line.php",
                  data: { externalInputVal: externalFilter }
              }).done(function(data){
                  $(".target-search-external").html(data);
              });
            } else {
              $("#external_btn_searchBar").click(function(){
                  let externalInput = document.querySelector("#external_input_searchBar").value;
                  let externalFilter = externalInput.toUpperCase();
                  // alert(employeeiInput);
                  $.ajax({
                      type: "POST",
                      url: "action_button/search-external-line.php",
                      data: { externalInputVal: externalFilter }
                  }).done(function(data){
                      $(".target-search-external").html(data);
                  });
              });
            }
          });
    });
$(document).ready( function () {
  $('#table_externalTel').DataTable();
    });
