<?php
    session_start();
    include('Includes/connection.php');
?>
<!-- PUBLIC  -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/tel_directory.css">
    <script src="https://kit.fontawesome.com/748d395acf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Telephone Directory</title>
  </head>
  <body id="ignore-bootstrap">
    <?php require 'header.php'; ?>
    <main class="main-tel-directory w-100">
      <div class="main-table-public w-100 h-100 d-flex align-items-center flex-wrap justify-content-center">
          <div class="w-50 align-self-start mt-5">
            <h2 class="text-uppercase">Telephone Directory</h2>
              <div class="pt-2 pb-2">
                <div class="d-flex">
                  <p class="mr-2">Select by:</p>
                    <select id="selectBy" class="form-control-sm">
                      <option value="">None</option>
                      <option value="company">Company</option>
                      <option value="department">Department</option>
                      <option value="tel_local_directory">Local Telephone</option>
                      <option value="employee">Employee</option>
                    </select>
                </div>
              </div>
              <div class="">
                <form class="form-inline mb-2 d-flex justify-content-end">
                    <div class="">
                      <button id="searchBar_btn" class="btn btn-primary mr-sm-2 mb-2" type="button">Search</button>
                      <input id="searchBar_input" class="form-control mr-sm-2 mb-2 align-middle" type="search" placeholder="Search" aria-label="Search">
                    </div>
                </form>
              </div>
                <table class="shadow table-active table-bordered border-secondary" id="public_tel_local">
                  <thead class="table-warning">
                    <tr class="border-secondary">
                        <th class="border-bottom-0">#</i></th>
                        <th class="border-bottom-0">User's Name</i></th>
                        <th class="border-bottom-0">Local Telephone</i></th>
                        <th class="border-bottom-0">Company</th>
                        <th class="border-bottom-0">Department</th>
                    </tr>
                  </thead>
                  <tbody class="change_table">
                    <?php
                    $counter = 0;
                  $query = "SELECT a.employee_id, CONCAT(firstname, ' ', lastname) AS name, b.company_name, c.department_name, d.tel_local
                  FROM employee a
                  INNER JOIN company b ON a.company_id = b.company_id
                  INNER JOIN department c ON a.department_id = c.department_id
                  INNER JOIN tel_local_directory d ON a.tel_local_id = d.tel_local_id;";

                  $result = mysqli_query($con, $query);
                  while($row = mysqli_fetch_array($result)){
                    $counter++;
                      echo '<tr class="table-active">
                              <td class="text-uppercase"> '.$counter.' </td>
                              <td class="text-uppercase"> '.$row['name'].' </td>
                              <td class="text-uppercase"> '.$row['tel_local'].' </td>
                              <td class="text-uppercase"> '.$row['company_name'].' </td>
                              <td class="text-uppercase"> '.$row['department_name'].' </td>
                          </tr>';
                  }
  ?>
            </tbody>
          </table>
    </div>
    <div class="align-self-center mt-5 pl-5">
        <div class="tel-table2">
            <table class="table shadow table-active table-sm table-bordered border-secondary" id="tel_ex_public">
              <thead class="border-secondary table-warning">
                <tr class="">
                    <th>#</th>
                    <th>External Telephone</th>
                    <th>Reception ID</th>
                    <th>Class of Service</th>
                    <th>Company</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $counter = 0;
                $query = "SELECT a.tel_ex_id, a.tel_external, a.reception_id, a.class_of_service, b.company_id, b.company_name
                FROM tel_external_directory a
                INNER JOIN company b ON a.company_id = b.company_id;";

                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_array($result)){
                  $counter++;
                    echo '<tr class="table-active">
                            <td class="text-uppercase"> '.$counter.' </td>
                            <td class="text-uppercase"> '.$row['tel_external'].' </td>
                            <td class="text-uppercase"> '.$row['reception_id'].' </td>
                            <td class="text-uppercase"> '.$row['class_of_service'].' </td>
                            <td class="text-uppercase"> '.$row['company_name'].' </td>
                            </tr>';
                }
                ?>
              </tbody>
            </table>
        </div>
    </div>
  </div>
    </main>
  </body>
</html>
<script>
$(document).ready( function () {
  $('#public_tel_local').DataTable();
    });
$(document).ready( function () {
  $('#tel_ex_public').DataTable();
    });
let input, filter, selectBy, inputSearch;
    $(document).ready(function(){
      inputSearch = document.querySelector("#searchBar_input");
          inputSearch.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
              event.preventDefault();
              document.getElementById("searchBar_btn").click();

              input = document.querySelector("#searchBar_input").value;
              filter = input.toUpperCase();
              selectBy = document.querySelector("#selectBy").value;
              // alert(filter);
              $.ajax({
                  type: "POST",
                  url: "public/searchTelDirectory.php",
                  data: { selectBy: selectBy, inputVal: filter }
              }).done(function(data){
                  $(".change_table").html(data);
              });
            } else {
              $("#searchBar_btn").click(function(){
                  input = document.querySelector("#searchBar_input").value;
                  filter = input.toUpperCase();
                  selectBy = document.querySelector("#selectBy").value;
                  // alert(filter);
                  $.ajax({
                      type: "POST",
                      url: "public/searchTelDirectory.php",
                      data: { selectBy: selectBy, inputVal: filter }
                  }).done(function(data){
                      $(".change_table").html(data);
                  });
              });
            }
          });

    });
</script>
