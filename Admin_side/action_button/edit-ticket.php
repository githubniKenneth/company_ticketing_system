<?php
session_start();
include('../../Includes/connection.php');
include('../../restrictions/restriction-check.php');
include('../cls_constant.php');
include('../../cls_global_functions.php');

    $current_id = $_SESSION['user_id'];
    $ticket_id = $_POST['ticketId'];

    $sql = "SELECT
                a.ticket_id, a.subject, a.ticket_description, a.date_created, a.status, a.message, a.assigned_to, a.priority,
                concat(b.last_name,', ',b.first_name,' ',b.middle_name) as full_name
            FROM ticket a
            INNER JOIN user b ON a.user_id=b.user_id
            WHERE a.ticket_id = $ticket_id
            LIMIT 1";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $sql2 ="SELECT doc_directory, concat(doc_name,'.',doc_type) as file_name
                    FROM ticket_document
                    WHERE ticket_id = $ticket_id";
            $result2 = mysqli_query($con, $sql2);
            $resultCheck2 = mysqli_num_rows($result2);
            if($resultCheck2>0){
                while ($row2 = mysqli_fetch_assoc($result2))
                {
                    $file_name = $row2['file_name'];
                    $doc_directory = $row2['doc_directory'];
                    $downloadDirectory = systemDirectories::downloadDirectory.$doc_directory;
                }
            }

            $subject = $row['subject'];
            $ticket_description = $row['ticket_description'];
            $date_created = $row['date_created'];
            $status = $row['status'];
            $message = $row['message'];
            $full_name = $row['full_name'];
            $assigned_to = $row['assigned_to'];
            $priority = $row['priority'];
            ?>
                <form action="action_button/update-ticket.php" method="POST">

                <input type="hidden" name="ticketID" value="<?php echo $ticket_id; ?>">

                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" value="<?php echo $full_name; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Subject</label>
                    <input type="text" class="form-control" value="<?php echo $subject; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Ticket Description</label>
                    <input type="text" class="form-control" value="<?php echo  $ticket_description; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Message</label>
                    <textarea name="" id="" cols="30" rows="5" class="form-control" disabled><?php echo $message;?></textarea>
                </div>

                <?php
                    if($resultCheck2>0)
                    {
                        ?>
                            <div class="form-group">
                                <label for="">Uploaded File</label>
                                <br>
                                <a href="<?php echo $downloadDirectory;?>" download
                                    style="color: blue; text-decoration: underline blue;">Click to Download: <?php echo $file_name?>
                                </a>
                                <br>
                            </div>
                        <?php
                    }
                    else
                    {

                    }
                ?>
                <div class="form-group">
                    <label for="">Assign To</label>
                    <select name="assigned_to" class="form-control" <?php checkTicketStatus($status);?>>
                        <!-- cls_global_functions.php-->
                        <?php getItAndAdminList($ticket_id); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Priority</label>
                    <select name="priority" class="form-control" <?php checkTicketStatus($status);?>>
                        <option value="0" <?php if($priority==0) echo 'selected="selected"'; ?>>Low</option>
                        <option value="1" <?php if($priority==1) echo 'selected="selected"'; ?>>Moderate</option>
                        <option value="2" <?php if($priority==2) echo 'selected="selected"'; ?>>High</option>
                        <option value="3" <?php if($priority==3) echo 'selected="selected"'; ?>>Urgent</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control" <?php checkTicketStatus($status);?>>
                        <option value="0" <?php if($status==0) echo 'selected="selected"'; ?>>Pending</option>
                        <option value="1" <?php if($status==1) echo 'selected="selected"'; ?>>Closed</option>
                    </select>
                </div>
                <input type="hidden" name="user_id" value="<?php echo $current_id; ?>">
                <div class="modal-footer">
                    <button type="submit" id="button" name="updateTicket" class="btn btn-primary" <?php accessPermissions("sa_edit",$current_id,systemApps::appNum_AllTicket); ?>>Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            <?php
        }
    }
?>
