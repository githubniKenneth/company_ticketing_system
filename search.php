<?php 
    include ('Includes/connection.php');

    $search = $_POST['search'];

    $sql = "SELECT * FROM user WHERE first_name LIKE '%$search%' OR user_id LIKE '%$search%'";

    $res = mysqli_query($con, $sql);

    $count = mysqli_num_rows($res);

    if($count>0)
    {
        while($row=mysqli_fetch_assoc($res))
        {
            
        }
    }
    else
    {
        echo "No Data Available";
    }
?>