<?php 
    session_start();
    include('../../Includes/connection.php');
    date_default_timezone_set('Asia/Manila');
        if(isset($_POST['updateTicket']))
        {
            $ticket_id = $_POST['ticketID'];
            $priority = $_POST['priority'];
            $status = $_POST['status'];
            $user_id = $_POST['user_id'];
            $assigned_to = $_POST['assigned_to'];
            $date_closed = date("Y-m-d H:i:s");
            switch ($status) {
                case '1':
                    $updateSQL = "UPDATE ticket SET status = '$status', date_closed = '$date_closed', priority = '$priority',closed_by = '$user_id',assigned_to = '$assigned_to' 
                                    WHERE ticket_id='$ticket_id'";
                    break;
                
                case '0':
                    $updateSQL = "UPDATE ticket SET status = '$status',priority = '$priority',assigned_to = '$assigned_to' 
                                    WHERE ticket_id='$ticket_id'";
                    break;
            }

            $update = mysqli_query($con, $updateSQL);

            if($update == true)
            {
                $_SESSION['update'] = "<div class='alert alert-success' role='alert'>
                                        Ticket Updated Successfully.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/tickets.php');
            }
            else
            {

                $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>
                                        Ticket Failed to Update.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/tickets.php');
            }
        }
        ?>



