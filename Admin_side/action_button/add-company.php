<?php
    session_start();
    include('../../Includes/connection.php');
    $current_id = $_SESSION['user_id'];
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
            if(isset($_POST['addCompanyButton'])){

                $companyName = $_POST['companyName'];
                $current_id;
                $sql = "INSERT INTO company(`company_name`, `user_id`)
                        VALUES('$companyName', '$current_id')";
                $addCompany = mysqli_query($con, $sql);

                if ($addCompany == true)
                {
                    $_SESSION['add'] = "<div class='alert alert-success' role='alert'>
                                        Company Added Successfully.
                                        </div>";
                    header('location:'.$siteURL.'Admin_side/company.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='alert alert-danger' role='alert'>
                                        Adding Company Failed.
                                        </div>";
                    header('location:'.$siteURL.'Admin_side/company.php');
                }
            }
        ?>

    </body>
</html>
