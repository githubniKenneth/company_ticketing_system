<?php 
    session_start();
    include('Includes/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Helpdesk Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    
    <link rel="stylesheet" href="CSS/login.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $("select.company").change(function(){
                var selectedCompany = $(".company option:selected").val();
                $.ajax({
                    type: "POST",
                    url: "department-select.php",
                    data: { company : selectedCompany } 
                }).done(function(data){
                    $("#response").html(data);
                });
            });
        });
    </script>
</head>

<body id="ignore-bootstrap">
    <div class="container-fluid bg">
        <div class="row justify-content-center align-items-center">
            <div class="col-sm-8 col-md-6 col-lg-4">
                <form class="form-container" action="register.php" method="post">
                    <h2 class="text-center">Account Registration</h2>
                    <?php 
                        if(isset($_SESSION['telegram']))
                        {
                            echo $_SESSION['telegram'];
                            unset($_SESSION['telegram']);
                        }
                    
                        if(isset($_SESSION['invalid_username']))
                        {
                            echo $_SESSION['invalid_username'];
                            unset($_SESSION['invalid_username']);
                        }
                    
                        if(isset($_SESSION['password']))
                        {
                            echo $_SESSION['password'];
                            unset($_SESSION['password']);
                        }
                    
                        if(isset($_SESSION['register']))
                        {
                            echo $_SESSION['register'];
                            unset($_SESSION['register']);
                        }
                    ?>
                    <div id="personal-information" class="p">Personal Information
                        <hr>
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" name="firstName" class="form-control" placeholder="Enter First Name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Middle Name</label>
                            <input type="text" name="middleName" class="form-control" placeholder="Enter Middle Name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="lastName" class="form-control" placeholder="Enter Last Name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Telegram</label>
                            <input type="number" name="telegramNumber" class="form-control" placeholder="Ex. 09123456789" required>
                        </div>
                    </div>
                    <div id="system-credentials" class="p">System Credentials
                        <hr>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="userName" class="form-control" placeholder="Enter Username" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <p>Already have account?<a href="index.php"> Login Here</a></p>
                    <button type="submit" name="register_button" class="btn btn-primary btn-block">Enter</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


<?php

    if(isset($_POST['register_button'])){
        
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $lastName = $_POST['lastName'];
        $telegramNumber = $_POST['telegramNumber'];
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        

        $checkUsernameSQL = "SELECT username FROM user WHERE username='$userName'";
        $usernameResult = mysqli_query($con, $checkUsernameSQL);
        $usernameRowCheck = mysqli_num_rows($usernameResult);
        
        if(strlen($telegramNumber) !== 11)
        {
            // echo "Invalid Telegram Number";
            // header('location:'.$siteURL.'register.php');
            $_SESSION['telegram'] = "<div class='alert alert-danger' role='alert'>
                                    Invalid Telegram Number
                                    </div>";
            header('location:'.$siteURL.'register.php');
            
        }
        elseif($usernameRowCheck != 0)
        {   
            // echo "Username already exist";
            $_SESSION['invalid_username'] = "<div class='alert alert-danger' role='alert'>
                                    Username already exist
                                    </div>";
            header('location:'.$siteURL.'register.php');
            // header('location:'.$siteURL.'register.php');
        }
        elseif($password !== $confirmPassword)
        {
            // echo "Password didnt match";
            $_SESSION['password'] = "<div class='alert alert-danger' role='alert'>
                                    Password didnt match
                                    </div>";
            header('location:'.$siteURL.'register.php');
            // header('location:'.$siteURL.'register.php');
        }
        else
        {
            // echo "Account Registration Sent";
            $_SESSION['register'] = "<div class='alert alert-success' role='alert'>
            Account Registration Sent
            </div>";
            header('location:'.$siteURL.'register.php');
            $insertSql = "INSERT INTO user(`first_name`, `middle_name`, `last_name`, `telegram`, `account_type`, `username`, `password`) 
                            VALUES ('$firstName', '$middleName ', '$lastName', '$telegramNumber',0, '$userName', '$password')";
            mysqli_query($con, $insertSql);
        }   
    }
?>