<?php 
include('../../Includes/connection.php');
$data=[];
    if(isset($_POST["user"]))
    {
        $user=$_POST["user"];
        // echo $user;
        $countInserted=0;
        $sql = "SELECT sa_id 
                FROM system_application
                WHERE sa_status=1";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result)!=0){
            while($row = mysqli_fetch_assoc($result))
            {
                $sa_id = $row['sa_id'];
                $sql2 ="SELECT uar_code
                        FROM user_access_rights
                        WHERE user_id=$user AND sa_id=$sa_id
                        LIMIT 1";
                $result2 = mysqli_query($con, $sql2);
                
                $records = mysqli_num_rows($result2);
                if($records == 0)
                {   
                    $sql3 = "INSERT INTO user_access_rights(user_id,sa_id)VALUES($user,$sa_id)";
                    mysqli_query($con, $sql3);
                    $countInserted=$countInserted+1;
                }
            }
            $data['insertedValues']=$countInserted;
        }
        else
        {
            $data['insertedValues']=0;
        }
        echo json_encode($data);
    }
?>