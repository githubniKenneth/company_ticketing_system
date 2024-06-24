// JS FOR SEARCH BAR OF IT ASSET
$(document).ready(function(){
      let localInput = document.querySelector("#local_input_searchBar");
          localInput.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
              event.preventDefault();
              document.querySelector("#local_btn_searchBar").click();

              let localInput = document.querySelector("#local_input_searchBar").value;
              let localFilter = localInput.toUpperCase();
              // alert(filter);
              $.ajax({
                  type: "POST",
                  url: "action_button/search-local-line.php",
                  data: { localInputVal: localFilter }
              }).done(function(data){
                  $(".target-search-local").html(data);
              });
            } else {
              $("#local_btn_searchBar").click(function(){
                  let localInput = document.querySelector("#local_input_searchBar").value;
                  let localFilter = localInput.toUpperCase();
                  // alert(employeeiInput);
                  $.ajax({
                      type: "POST",
                      url: "action_button/search-local-line.php",
                      data: { localInputVal: localFilter }
                  }).done(function(data){
                      $(".target-search-local").html(data);
                  });
              });
            }
          });
    });
