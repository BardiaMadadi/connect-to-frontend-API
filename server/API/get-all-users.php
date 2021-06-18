<?php
//using : 
include_once '../conf/db.php';


$user = mysqli_query($conn, "SELECT * FROM `users` WHERE u_name = '$FilterUser' LIMIT 50");
$user_info = mysqli_fetch_array($user,MYSQLI_ASSOC);

// response(200, "User found", );


//response function

function response($status, $status_message, $data)
{
    header("HTTP/1.1 " . $status);
    $response['status'] = $status;
    $response['status_message'] = $status_message;
    if ($status == 200) {
        $response['data'] = $data;
    }
    $json_response = json_encode($response);
    echo $json_response;
}
