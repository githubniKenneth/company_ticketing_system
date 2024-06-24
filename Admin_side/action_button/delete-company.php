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
            $companyID = $_GET['id'];
            $deleteCompanySQL = "DELETE FROM company WHERE company_id='$companyID'";
            $deleteDepartmentSQL = "DELETE FROM department WHERE company_id='$companyID'";

            $delete = mysqli_query($con, $deleteCompanySQL);
            $delete2 = mysqli_query($con, $deleteDepartmentSQL);
            if($delete && $delete2 == true)
            {
                
                $_SESSION['delete'] = "<div class='alert alert-success' role='alert'>
                                        Company Deleted Successfully.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/company.php');
            }
            else
            {
                $_SESSION['delete'] = "<div class='alert alert-danger' role='alert'>
                                        Company Failed to Delete.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/company.php');
            }
        ?>
    </body>
    </html>