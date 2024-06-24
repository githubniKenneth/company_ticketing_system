<?php
    session_start();
    include('../../Includes/connection.php');
?>


        <?php
        if(isset($_POST['updateUserButton']))
        {
            $user_id = $_POST['user_id'];
            $first_name = $_POST['first_name'];
            $middle_name = $_POST['middle_name'];
            $last_name = $_POST['last_name'];
            $telegram = $_POST['telegram'];
            $account_type = $_POST['account_type'];
            $company_id = $_POST['company_name'];
            $department_id = $_POST['department_id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            // $password = 1;
            // $confirm_password = 1;


            // $updateSQL = "UPDATE user SET account_type = '0' WHERE username= 'gg'";
            if ($password !== $confirm_password || strlen($telegram) != 11)
            {

            }
            elseif ($password=="" && $confirm_password=="")
            {
                $updateSQL = "UPDATE user SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',telegram='$telegram',account_type='$account_type',
                                            company_id='$company_id',department_id='$department_id',username='$username'
                            WHERE user_id='$user_id'";
                $update = mysqli_query($con, $updateSQL);
            }
            else
            {
                $updateSQL = "UPDATE user SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',telegram='$telegram',account_type='$account_type',
                                            company_id='$company_id',department_id='$department_id',username='$username',password='$password'
                            WHERE user_id='$user_id'";
                $update = mysqli_query($con, $updateSQL);
            }


            if($update == true)
            {
                $_SESSION['update'] = "<div class='alert alert-success' role='alert'>
                                        Account Updated Successfully.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/users.php');
            }
            else
            {
                $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>
                                        Account Failed to Update.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/users.php');
            }
        }
        ?>
