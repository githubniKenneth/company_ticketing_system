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
    if(isset($_POST['addNewUserButton'])){
            
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $telegram = $_POST['telegram'];
        $company_id = $_POST['company_id'];
        $department_id = $_POST['department_id'];
        $account_type = $_POST['account_type'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        $checkUsernameSQL = "SELECT username FROM user WHERE username='$username'";
        $usernameResult = mysqli_query($con, $checkUsernameSQL);
        $usernameRowCheck = mysqli_num_rows($usernameResult);

        if(strlen($telegram) !== 11)
        {
            // echo "Invalid Telegram Number";
            $_SESSION['telegram'] = "<div class='alert alert-danger' role='alert'>
                                    Invalid Telegram Number
                                    </div>";
            header('location:'.$siteURL.'Admin_side/users.php');
            
        }
        elseif($usernameRowCheck != 0)
        {   
            // echo "Username already exist";
            $_SESSION['username'] = "<div class='alert alert-danger' role='alert'>
                                    Username already exist
                                    </div>";
            header('location:'.$siteURL.'Admin_side/users.php');
        }
        elseif($password !== $confirmPassword)
        {
            // echo "Password didnt match";
            $_SESSION['password'] = "<div class='alert alert-danger' role='alert'>
                                    Password didnt match
                                    </div>";
            header('location:'.$siteURL.'Admin_side/users.php');
        }
        else
        {
            // echo "Account Registration Sent";
            $_SESSION['register'] = "<div class='alert alert-success' role='alert'>
            Account Registered Successfully
            </div>";
            $insertSql = "INSERT INTO user(`first_name`, `middle_name`, `last_name`, `telegram`, `company_id`, `department_id`, `account_type`, `username`, `password`, `approved`) 
            VALUES ('$first_name', '$middle_name ', '$last_name', $telegram, $company_id, $department_id, $account_type, '$username', '$password', 1)";
            mysqli_query($con, $insertSql);
            header('location:'.$siteURL.'Admin_side/users.php');
        }   
    }

    ?>

    </body>
</html>