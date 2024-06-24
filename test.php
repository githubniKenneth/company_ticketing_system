<h2 class="my-5">Employee IT Asset</h2>
<?php

?>
<link rel="stylesheet" href="CSS/employee_asset.css">
<div class="d-flex justify-content-end mb-2">
  <div class="form-inline d-flex justify-content-end mb-2">
      <button type="button" data-toggle="modal" data-target="#assignItAssetType" class="btn btn-success mr-2">Assign IT Asset</button>
  </div>
</div>

<form class="form-inline mb-2 d-flex justify-content-between">
      <div class="d-flex align-items-center">
        <p class="mr-2 mb-0">Show:</p>
        <select class="form-control-sm" name="">
          <option value="">10</option>
          <option value="">25</option>
          <option value="">50</option>
          <option value="">100</option>
        </select>
      </div>
      <div class="">
        <button class="btn btn-primary mr-sm-2 mb-2" type="button">Search</button>
        <input id="input_searchBar" class="form-control mr-sm-2 mb-2 align-middle" type="search" placeholder="Search" aria-label="Search">
      </div>
  </form>
<table class="table" id="employee_asset_table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Employee</th>
        <th scope="col">Department</th>
        <th scope="col">Company</th>
        <th scope="col">IT Asset</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
                <tr>
                      <td class="font-weight-bold">1</td>
                      <td>LC32423</td>
                      <td>Bobby Madrona</td>
                      <td>HR</td>
                      <td>Dyn Edge</td>
                      <td>IT Asset</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                      <button type="button" data-toggle="modal" class="editAsset btn btn-primary">Edit</button>
                      <a href=""><button type="button" class="btn btn-danger">Delete</button></a>
                      </td>
                  </tr>
    </tbody>
</table>
