<?php
    session_start();
    include('Includes/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/login.css">
    <title>IT Helpdesk Login</title>
  </head>

  <body id="ignore-bootstrap">
    <?php require 'header.php'; ?>
    <style>
    .button-icon a i {
      display: block;
      transition: all ease-in-out 300ms;
    }
    </style>
    <main class="main-it-helpdesk d-flex align-items-center">
      <div class="container-fluid">
          <div class="row justify-content-center align-items-center">
              <div class="col-sm-8 col-md-6 col-lg-4">
                  <form class="form-container" method="post">
                      <h2 class="text-center">IT Helpdesk Login</h2>
                      <?php
                          if(isset($_SESSION['login']))
                          {
                              echo $_SESSION['login'];
                              unset($_SESSION['login']);
                          }
                      ?>
                      <div class="form-group">
                          <label for="">Username</label>
                          <input type="text" name="username" class="form-control" placeholder="Enter Username">
                      </div>
                      <div class="form-group">
                          <label for="">Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Enter Password">
                      </div>
                      <p>No account yet? <a href="register.php">Register Here</a></p>
                      <button type="submit" name="login_button" class="btn btn-primary btn-block">Enter</button>
                  </form>
              </div>
          </div>
      </div>
    </main>
  </body>
</html>


<?php
    if(isset($_POST['login_button'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND approved = '1'";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck == 1){
            $row = mysqli_fetch_assoc($result);

            $userid = $row['user_id'];
            $username = $row['username'];
            $accountType = $row['account_type'];
            $first_name = $row['first_name'];
            $middle_name = $row['middle_name'];
            $last_name = $row['last_name'];


            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $userid;
            $_SESSION['account_type'] = $accountType;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['middle_name'] = $middle_name;


            if ($accountType == 0){

                header('location:'.$siteURL.'User_side/');
            }
            elseif ($accountType == 1 || $accountType == 2){
                header('location:'.$siteURL.'Admin_side/');
            }


        }
        else{
            // echo "Incorrect username or password";
            $_SESSION['login'] = "<div class='alert alert-danger' role='alert'>
                                        Incorrect Username or Password.
                                        </div>";
            header('location:'.$siteURL.'it_helpdesk.php');
        }
    }
?>
