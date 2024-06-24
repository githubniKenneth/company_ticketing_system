<?php
session_start();
include('../../Includes/connection.php');

$tel_local_id = $_POST['tel_local_id'];
// SELECT THE LOCAL TELEPHONE DIRECTORY TO PUT IT TO THE MODAL
    $sql="SELECT a.tel_local, a.tel_local_id
                FROM tel_local_directory a
                WHERE a.tel_local_id = $tel_local_id";

    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $tel_local_id = $row['tel_local_id'];
            $tel_local = $row['tel_local'];
            ?>
              <!-- SHOWING THE EXISTING INFORMATION OF A LOCAL TELEPHONE DIRECTORY TO BE EDIT -->
                <form action="action_button/update-local-line.php" method="POST">
                <input type="hidden" name="tel_local_id" value="<?php echo $tel_local_id; ?>">
                <div class="form-group">
                    <label for="">Local Telephone</label>
                    <input type="text" name="tel_local" class="form-control" value="<?php echo $tel_local; ?>" required>
                    <input type="hidden" name="old_tel_local" class="form-control" value="<?php echo $tel_local; ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" id="button" name="updateTelLocalButton" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            <?php
        }
    }
?>
