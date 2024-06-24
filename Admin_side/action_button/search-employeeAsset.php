<?php
session_start();
include('../../Includes/connection.php');

    if(isset($_POST["employeeInputVal"])){
      $input = mysqli_real_escape_string($con, $_POST['employeeInputVal']); //TO ENSURE THAT THE DATA THAT IS SENT TO THE MYSQL SERVER IS SAFE
      $counter = 0;
      // SELECT THE EMPLOYEE TO PUT IT TO THE TABLE OF EMPLOYEE ASSET AFTER "SEARCHING"
          $query = "SELECT CONCAT(a.firstname, ' ', a.lastname) AS employee_name, a.employee_id
          FROM employee a
          WHERE a.firstname LIKE '%$input%' OR a.lastname LIKE '%$input%'";
          $result = mysqli_query($con, $query);
          while($row = mysqli_fetch_array($result)){
            $employee_id = $row['employee_id'];
            $employee_name = $row['employee_name'];
            $counter++;
      ?>
            <tr>
                <td class="font-weight-bold"><?php echo $counter;?></td>
                <td><?php echo $employee_name;?></td>
                <!-- SELECT THE HOW MANY QUANTITY IT ASSET OF THE EMPLOYEE -->
                <?php $rowAsset = "SELECT * FROM employee_asset WHERE employee_id = '$employee_id'";
                $resultAsset = mysqli_query($con, $rowAsset);
                $rowCheck = mysqli_num_rows($resultAsset);
                echo "<td>".$rowCheck."</td>";
                ?>
                <td>
                <button type="button" data-toggle="modal" data-id="<?php echo $employee_id; ?>" class="reviewAsset btn btn-primary">View Asset</button>
                <button type="button" data-toggle="modal" data-id="<?php echo $employee_id; ?>" class="addAsset btn btn-success">Add Asset</button>
                </td>
            </tr>
            <?php
          }
        }
?>
<script src="../js/employee_asset/add-employee-asset.js"></script>
<script src="../js/employee_asset/view-employee-asset.js"></script>
