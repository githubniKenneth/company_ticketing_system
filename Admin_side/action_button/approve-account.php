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
            $useridApprove = $_GET['id'];

            $sql = "SELECT company_id, department_id FROM user WHERE user_id=$useridApprove LIMIT 1";
            $sqlResult = mysqli_query($con, $sql);
            $sqlResultCheck = mysqli_num_rows($sqlResult);

            if($sqlResultCheck!=0)
            {
                $row = mysqli_fetch_assoc($sqlResult);
                
                $company_id = $row['company_id'];
                $department_id = $row['department_id'];
            }

            if($company_id==0 || $department_id==0)
            {
                $_SESSION['approve'] = "<div class='alert alert-danger' role='alert'>
                                        Please select Company and Department for the User
                                        </div>";
                header('location:'.$siteURL.'Admin_side/pendingAccounts.php');
            }
            else
            {
                $approveSQL = "UPDATE user SET approved = '1' WHERE user_id='$useridApprove'";
                $approve = mysqli_query($con, $approveSQL);

                if($approve==true)
                {
                    $_SESSION['approve'] = "<div class='alert alert-success' role='alert'>
                                            Account Approved Successfully.
                                            </div>";
                    header('location:'.$siteURL.'Admin_side/pendingAccounts.php');
                }
                else
                {
                    $_SESSION['approve'] = "<div class='alert alert-danger' role='alert'>
                                            Account Failed to Approve.
                                            </div>";
                    header('location:'.$siteURL.'Admin_side/pendingAccounts.php');
                }
            }
            
        ?>
</body>
</html>


