// JS FOR SEARCH BAR OF EMPLOYEE LIST
$(document).ready(function(){
      let employeeInput = document.querySelector("#srch_input_employee");
          employeeInput.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
              event.preventDefault();
              document.querySelector("#srch_btn_employee").click();

              let employeeInput = document.querySelector("#srch_input_employee").value;
              let employeeFilter = employeeInput.toUpperCase();
              // alert(filter);
              $.ajax({
                  type: "POST",
                  url: "action_button/search-employee.php",
                  data: { employeeInputVal: employeeFilter }
              }).done(function(data){
                  $(".target-search-employee").html(data);
              });
            } else {
              $("#srch_btn_employee").click(function(){
                  let employeeInput = document.querySelector("#srch_input_employee").value;
                  let employeeFilter = employeeInput.toUpperCase();
                  // alert(employeeiInput);
                  $.ajax({
                      type: "POST",
                      url: "action_button/search-employee.php",
                      data: { employeeInputVal: employeeFilter }
                  }).done(function(data){
                      $(".target-search-employee").html(data);
                  });
              });
            }
          });
    });
$(document).ready( function () {
  $('#table_employee').DataTable();
    });
