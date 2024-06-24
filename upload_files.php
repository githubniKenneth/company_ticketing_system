<?php 

 // add-ticket.php
function uploadFiles($user_id,$company,$department,$ticket_year,$ticket_number,$ticket_id)
{
    include('Includes/connection.php');
    include('Admin_side/cls_constant.php');
    // include('../../cls_global_functions.php');

    $td_id = getPrimaryId('ticket_document');
    $fileName = $_FILES['file']['name'];
        // $file = $_FILES['file'];
        if($fileName!="")
        {
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode('.', $fileName);
            $doc_type = strtolower(end($fileExt));
            $uploadedName = explode('.', $fileName);
            $current_name = current($uploadedName);
            $date = date('Y-m-d H:i:s');
            $allowed = array('jpg', 'jpeg', 'png', 'pdf');

            if(in_array($doc_type, ($allowed)))
            {
                if($fileError === 0)
                {
                    if($fileSize<5000000)
                    {
                        $doc_name = $user_id.$ticket_year.$ticket_number."-".$current_name;
                        $doc_directory = 'ticket/'.$doc_name.".".$doc_type;
                        $file_upload = systemDirectories::uploadDirectory.$doc_directory;
                        move_uploaded_file($fileTmpName, $file_upload);
                        // $td_id = getPrimaryId('ticket_document');

                        $sql1 = "INSERT INTO ticket_document(`td_id`,`user_id`,`ticket_id`,`company_id`,`department_id`,`td_created_by`,`td_created_date`,`doc_name`,`doc_type`,`doc_directory`)
                                VALUES ('$td_id','$user_id','$ticket_id','$company','$department','$user_id','$date','$doc_name','$doc_type','$doc_directory')";
                        mysqli_query($con, $sql1);
                    }
                    else
                    {
                        echo "The file size is too big";
                    }
                }
                else
                {
                    echo "There was an error uploading your file";
                }
            }
            else
            {
                echo "File invalid type";
            }
        }

}

function uploadMessageFiles($user_id,$td_id,$ticket_id)
{
    include('Includes/connection.php');
    include('Admin_side/cls_constant.php');
        // $file = $_FILES['file'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileExt = explode('.', $file);
        $doc_type = strtolower(end($fileExt));
        $uploadedName = explode('.', $file);
        $current_name = current($uploadedName);

        $doc_name = $user_id.$ticket_year.$td_id."-".$current_name;
        $doc_name_ext = $doc_name.".".$doc_type;
        $doc_directory = 'ticket/'.$doc_name.".".$doc_type;
        $file_upload = systemDirectories::uploadDirectory.$doc_directory;
        move_uploaded_file($fileTmpName, $file_upload);

        $query = "INSERT INTO ajax_upload(name,message,file_name,doc_directory,doc_name,doc_type) VALUES ('$name','$message','$doc_name_ext','$doc_directory','$doc_name','$doc_type')";
        $insert = mysqli_query($con, $query);
        
        if($insert == true) 
        {
            // move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$file);            
            // $display = array(
            //     'name'=> $name,
            //     'message'=> $message,
            //     'file' => $doc_name_ext,
            //     'download_directory' => $doc_directory
            // );
            $display = array(
                'current_full_name' => $current_full_name,
                'message' => $message,
                'file' => $doc_name_ext,
                'download_directory' => $doc_directory,
                'current_date' => $date
            );
            echo json_encode($display);
        }
        // else
        // {
        //     $output= "failed";
        // }
}
?>