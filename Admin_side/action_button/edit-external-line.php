<?php
session_start();
include('../../Includes/connection.php');

$tel_ex_id = $_POST['tel_ex_id'];
// SELECT THE EXTERNAL TELEPHONE DIRECTORY TO PUT IT TO THE MODAL
    $sql="SELECT a.tel_external, a.tel_ex_id, a.reception_id, a.class_of_service, a.company_id, b.company_name
                FROM tel_external_directory a
                INNER JOIN company b ON a.company_id = b.company_id
                WHERE a.tel_ex_id = $tel_ex_id";

    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $tel_ex_id = $row['tel_ex_id'];
            $tel_external = $row['tel_external'];
            $reception_id = $row['reception_id'];
            $class_of_service = $row['class_of_service'];
            $company_id = $row['company_id'];

            ?>
            <!-- SHOWING THE EXISTING INFORMATION OF A EXTERNAL TELEPHONE DIRECTORY TO BE EDIT -->
                <form action="action_button/update-external-line.php" method="POST">
                <input type="hidden" name="tel_external_id" value="<?php echo $tel_ex_id; ?>">
                <div class="form-group">
                    <label for="">External Telephone</label>
                    <input type="text" name="tel_external" class="form-control" value="<?php echo $tel_external; ?>" required>
                    <input type="hidden" name="old_tel_external" class="form-control" value="<?php echo $tel_external; ?>">
                </div>
                <div class="form-group">
                    <label for="">Reception ID</label>
                    <input type="number" name="reception_id" class="form-control" value="<?php echo $reception_id; ?>" required>
                    <input type="hidden" name="old_reception_id" class="form-control" value="<?php echo $reception_id; ?>">
                </div>
                <div class="form-group">
                    <label for="">Class of Service</label>
                    <input type="number" name="class_of_service" class="form-control" value="<?php echo $class_of_service; ?>" required>
                    <input type="hidden" name="old_class_of_service" class="form-control" value="<?php echo $class_of_service; ?>">
                </div>
                <div class="form-group">
                    <label>Company:</label>
                    <!-- SELECTING THE EXISTING COMPANY AND ALL THE LIST OF COMPANY -->
                        <select name="company_name" class="company custom-select" required>
                            <option value="">Select Company</option>
                            <?php
                                $companySql = "SELECT company_id, company_name FROM company";
                                $companyQuery = mysqli_query($con, $companySql);
                                $companyRowCheck = mysqli_num_rows($companyQuery);

                                if($companyRowCheck != 0){
                                    while($companyRow = mysqli_fetch_assoc($companyQuery)){
                                        $newCompanyId = $companyRow['company_id'];
                                        $companyNames = $companyRow['company_name'];
                                                ?>
                                        <option value="<?php echo $newCompanyId; ?>" <?php if ($newCompanyId == $company_id) echo 'selected="selected"'?>> <?php echo $companyNames; ?> </option>
                                                <?php
                                        }
                                    }
                                ?>
                        </select>
                        <input type="hidden" name="old_company_name" class="form-control" value="<?php echo $company_id; ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" id="button" name="updateTelExternalButton" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            <?php
        }
    }
?>
