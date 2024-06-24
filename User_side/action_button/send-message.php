<?php

    include('../../Includes/connection.php');
    // include('../../upload_files.php');
    include('../../cls_global_functions.php');
    include('../../Admin_side/cls_constant.php');

    date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d H:i:s');
    mysqli_real_escape_string($con, $message = $_POST['message']);
    $ticket_id = $_POST['ticket_id'];
    $current_user_id = $_POST['current_user_id'];
    $current_full_name = $_POST['current_full_name'];
    $file = $_FILES['file']['name'];

    $td = date_create($date);
    $ticket_year= date_format($td,"Y");
    
    $td_id = getPrimaryId('ticket_document');
    // $ticket_date_created = $_POST['ticket_date_created'];
    // $ticket_year = date_format($ticket_date_created,"Y");
    
    if($file != "")
    {
        $query = "INSERT INTO ticket_message(td_id,message,ticket_id,user_id,message_date) VALUES ('$td_id','$message','$ticket_id','$current_user_id','$date')";
    }
    else
    {
        $query = "INSERT INTO ticket_message(message,ticket_id,user_id,message_date) VALUES ('$message','$ticket_id','$current_user_id','$date')";
    }
    
        $statement = mysqli_query($con, $query);
        if($statement == true)
        {
            if($file != "")
            {
                // uploadFiles($current_user_id,$ticket_year,$ticket_id);
                $fileTmpName = $_FILES['file']['tmp_name'];
                $fileExt = explode('.', $file);
                $doc_type = strtolower(end($fileExt));
                $uploadedName = explode('.', $file);
                $current_name = current($uploadedName);

                $doc_name = $current_user_id.$ticket_year.$td_id."-".$current_name;
                $doc_name_ext = $doc_name.".".$doc_type;
                $doc_directory = 'ticket/'.$doc_name.".".$doc_type;
                $file_upload = systemDirectories::uploadDirectory.$doc_directory;
                $downloadDirectory = systemDirectories::downloadDirectory.$doc_directory;
                
                $query1 = "INSERT INTO ticket_document(td_id,user_id,ticket_id,doc_name,doc_directory,doc_type) VALUES ('$td_id','$current_user_id','$ticket_id','$doc_name','$doc_directory','$doc_type')";
                $insert = mysqli_query($con, $query1);
                
                if($insert == true) 
                {
                    move_uploaded_file($fileTmpName, $file_upload);
                    $display = array(
                        'current_full_name' => $current_full_name,
                        'message' => $message,
                        'file' => $doc_name_ext,
                        'download_directory' => $downloadDirectory,
                        'current_date' => $date
                    );
                    echo json_encode($display);
                }
                else
                {
                    echo "error";
                }
            }
            else
            {
                $output = array(
                    'message' => $message,
                    'current_full_name' => $current_full_name,
                    'current_date' => $date
                );
                echo json_encode($output);
            }
            
        }
    
    // if($file != "")
    // {
    //     // uploadFiles($current_user_id,$ticket_year,$ticket_id);
    //     $fileTmpName = $_FILES['file']['tmp_name'];
    //     $fileExt = explode('.', $file);
    //     $doc_type = strtolower(end($fileExt));
    //     $uploadedName = explode('.', $file);
    //     $current_name = current($uploadedName);

    //     $doc_name = $current_user_id.$ticket_year.$td_id."-".$current_name;
    //     $doc_name_ext = $doc_name.".".$doc_type;
    //     $doc_directory = 'ticket/'.$doc_name.".".$doc_type;
    //     $file_upload = systemDirectories::uploadDirectory.$doc_directory;
        

    //     $query1 = "INSERT INTO ticket_message(user_id,ticket_id,message,doc_name,doc_directory,doc_type) VALUES ('$current_user_id','$ticket_id','$message','$doc_name','$doc_directory','$doc_type')";
    //     $insert = mysqli_query($con, $query1);
        
    //     if($insert == true) 
    //     {
    //         move_uploaded_file($fileTmpName, $file_upload);
    //         // move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$file);            
    //         // $display = array(
    //         //     'name'=> $name,
    //         //     'message'=> $message,
    //         //     'file' => $doc_name_ext,
    //         //     'download_directory' => $doc_directory
    //         // );
    //         $display = array(
    //             'current_full_name' => $current_full_name,
    //             'message' => $message,
    //             'file' => $doc_name_ext,
    //             'download_directory' => $doc_directory,
    //             'current_date' => $date
    //         );
    //         echo json_encode($display);
    //     }
    //     else
    //     {
    //         echo "error";
    //     }
    //     // $output = array(
    //     //     'message' => $message,
    //     //     'current_full_name' => $current_full_name,
    //     //     'current_date' => $date
    //     // );
    //     // echo json_encode($output);
    // }
    // else
    // {
    //     $query = "INSERT INTO ticket_message(message,ticket_id,user_id,message_date) VALUES ('$message','$ticket_id','$current_user_id','$date')";
    //     $statement = mysqli_query($con, $query);
    //     if($statement == true)
    //     {
    //         $output = array(
    //             'message' => $message,
    //             'current_full_name' => $current_full_name,
    //             'current_date' => $date
    //         );
    //         echo json_encode($output);
    //     }
    // }

    
?>  