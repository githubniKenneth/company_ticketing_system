<?php
session_start();
include('../../Includes/connection.php');

    if(isset($_POST["localInputVal"])){
      $input = mysqli_real_escape_string($con, $_POST['localInputVal']); //TO ENSURE THAT THE DATA THAT IS SENT TO THE MYSQL SERVER IS SAFE

      // SELECT THE SUPPLIER TO PUT IT TO THE TABLE OF SUPPLIER FOR ADDING AFTER "SEARCHING"
            $query  = "SELECT a.tel_local_id, a.tel_local, a.date_created, a.status,
            CONCAT(c.first_name, ' ', c.middle_name, ' ', c.last_name) AS created_by
            FROM tel_local_directory a
            INNER JOIN user c ON a.user_id = c.user_id
            WHERE a.tel_local LIKE '%$input%' OR a.date_created  LIKE '%$input%'
            OR c.first_name  LIKE '%$input%'
            OR c.middle_name  LIKE '%$input%' OR c.last_name  LIKE '%$input%'";

            $result = mysqli_query($con, $query);
            $counter = 0;
            while($row = mysqli_fetch_array($result)){
              $tel_local_id = $row['tel_local_id'];
              $date_created = $row['date_created'];
              $tel_local = $row['tel_local'];
              $createdBy = $row['created_by'];
              $telLocalId = $row['status'] == 0 ? "InActive" : "Active";
              $counter++;
            ?>
              <tr>
                    <td class="font-weight-bold"><?php echo $counter;?></td>
                    <td><?php echo $date_created;?></td>
                    <td><?php echo $tel_local;?></td>
                    <td><?php echo $createdBy;?></td>
                    <td><?php echo $telLocalId;?></td>
                    <td>
                    <button type="button" data-toggle="modal" data-id="<?php echo $tel_local_id; ?>" class="editTelLocal btn btn-primary">Edit</button>
                    <button type="button" data-toggle="modal" data-id="<?php echo $tel_local_id; ?>" class="deleteTelLocal btn btn-danger">Delete</button>
                    </td>
                </tr>
        <?php }
               }
?>
<script src="../js/local_telephone/confirm-delete.js"></script>
<script src="../js/local_telephone/edit.js"></script>
