<?php
session_start();
include('../../Includes/connection.php');

    if(isset($_POST["externalInputVal"])){
      $input = mysqli_real_escape_string($con, $_POST['externalInputVal']); //TO ENSURE THAT THE DATA THAT IS SENT TO THE MYSQL SERVER IS SAFE

      // SELECT THE SUPPLIER TO PUT IT TO THE TABLE OF SUPPLIER FOR ADDING AFTER "SEARCHING"
            $query  = "SELECT a.tel_ex_id, a.tel_external, a.reception_id, a.class_of_service, a.date_created, a.status, b.company_name,
            CONCAT(c.first_name, ' ', c.middle_name, ' ', c.last_name) AS created_by
            FROM tel_external_directory a
            INNER JOIN company b ON a.company_id = b.company_id
            INNER JOIN user c ON a.user_id = c.user_id
            WHERE a.tel_external LIKE '%$input%' OR a.reception_id  LIKE '%$input%' OR
            a.class_of_service LIKE '%$input%' OR a.date_created  LIKE '%$input%'
            OR b.company_name  LIKE '%$input%' OR c.first_name  LIKE '%$input%'
            OR c.middle_name  LIKE '%$input%' OR c.last_name  LIKE '%$input%'";

            $result = mysqli_query($con, $query);
            $counter = 0;
            while($row = mysqli_fetch_array($result)){
              $tel_ex_id = $row['tel_ex_id'];
              $date_created = $row['date_created'];
              $tel_external = $row['tel_external'];
              $reception_id = $row['reception_id'];
              $class_of_service = $row['class_of_service'];
              $company_name = $row['company_name'];
              $created_by = $row['created_by'];
              $status = $row['status'] == 0? "InActive" : "Active";
              $counter++;
              ?>
              <tr>
              <td class="font-weight-bold"><?php echo $counter;?></td>
              <td><?php echo $date_created;?></td>
              <td><?php echo $tel_external;?></td>
              <td><?php echo $reception_id;?></td>
              <td><?php echo $class_of_service;?></td>
              <td><?php echo $company_name;?></td>
              <td><?php echo $created_by;?></td>
              <td><?php echo $status;?></td>
              <td>
              <button type="button" data-toggle="modal" data-id="<?php echo $tel_ex_id; ?>" class="editTelExternal btn btn-primary">Edit</button>
              <button type="button" data-toggle="modal" data-id="<?php echo $tel_ex_id; ?>" class="deleteTelExternal btn btn-danger">Delete</button>
              </td>
          </tr>
  <?php          }
          }
?>
<script src="../js/external_telephone/confirm-delete.js"></script>
<script src="../js/external_telephone/edit.js"></script>
