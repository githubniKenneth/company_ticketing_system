<?php 
    session_start();
    include('../../Includes/connection.php');
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
            
            $useridDelete = $_GET['id'];
            $deleteSQL = "DELETE FROM user WHERE user_id='$useridDelete'";
            $delete = mysqli_query($con, $deleteSQL);

            if($delete==true)
            {
                // decline account
                $_SESSION['delete'] = "<div class='alert alert-success' role='alert'>
                                        Account Declined Successfully.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/pendingAccounts.php');
            }
            else
            {
                // decline account
                $_SESSION['delete'] = "<div class='alert alert-danger' role='alert'>
                                        Account Declined to Delete.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/pendingAccounts.php');
            }
        ?>
    </body>
    </html>



