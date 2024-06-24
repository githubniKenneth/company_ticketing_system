<?php
    session_start();
    include('../../Includes/connection.php');
    $current_id = $_SESSION['user_id'];
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
            if(isset($_POST['addAppButton'])){

                $appName = $_POST['AppName'];
                $date = date('Y-m-d H:i:s');
                $status = $_POST['status'];

                $sql = "INSERT INTO system_application(`sa_name`, `sa_created_by`, `sa_created_date`, `sa_status`)
                        VALUES('$appName', '$current_id', '$date', '$status')";
                $addApp = mysqli_query($con, $sql);

                if ($addApp == true)
                {
                    $_SESSION['add'] = "<div class='alert alert-success' role='alert'>
                                        Application Added Successfully.
                                        </div>";

                    header('location:'.$siteURL.'Admin_side/system-applications.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='alert alert-danger' role='alert'>
                                        Adding Application Failed.
                                        </div>";
                    header('location:'.$siteURL.'Admin_side/system-applications.php');
                }
            }
        ?>

    </body>
</html>
