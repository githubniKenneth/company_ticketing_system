<?php 
    session_start();
    include('../../Includes/connection.php');
    include('../../cls_global_functions.php');
    include('../../upload_files.php');
    date_default_timezone_set('Asia/Manila');
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body>
        <?php
        $user_id = 0;
        $subject = "";
        $ticketDescription = "";
        $message ="";
        $company = "";
        $department = "";
        $ticket_year = 0;
        $ticket_number = 0;
        
        

        if(isset($_POST['addTicketButton'])){
            
            $ticket_id = getPrimaryId('ticket');
            $user_id = $_POST['user_id'];
            $subject = mysqli_real_escape_string($con, $_POST['subject']);
            $ticketDescription = mysqli_real_escape_string($con, $_POST['ticketDescription']);
            $message = mysqli_real_escape_string($con, $_POST['message']);
            
            $assigned_to = $_POST['assigned_to'];
            $priority = $_POST['priority'];
            $company = $_POST['company'];
            $department = $_POST['department'];
            $ticket_date = date_create($_POST['ticket_date']);
            $ticket_year = date_format($ticket_date,"Y");
            $ticket_number = getNewTicketId($ticket_year);
            $date_created = date('Y-m-d H:i:s');
        
            
            $sql = "INSERT INTO ticket(`ticket_id`,`user_id`,`subject`,`ticket_description`,`message`,`assigned_to`,`priority`,`company_id`,`department_id`,`date_created`,`ticket_year`,`ticket_number`)
                    VALUES('$ticket_id','$user_id','$subject','$ticketDescription','$message','$assigned_to','$priority','$company','$department','$date_created','$ticket_year','$ticket_number')";
            
            $add = mysqli_query($con, $sql);

            if($add == true)
            {
                uploadFiles($user_id,$company,$department,$ticket_year,$ticket_number,$ticket_id);
                $_SESSION['add'] = "<div class='alert alert-success' role='alert'>
                                        Ticket Sent Successfully.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/tickets.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='alert alert-danger' role='alert'>
                                        Ticket Failed to Send.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/tickets.php');
            }
        }
        ?>
    </body>
    </html>

