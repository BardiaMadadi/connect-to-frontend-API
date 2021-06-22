<?php
header("Content-Type:application/json");

// using :
include_once
    '../functions/create_account.php';
include_once
    '../conf/db.php';

if (isset($_POST['username']) && isset($_POST['mail']) && isset($_POST['pwd'])) {
    //variables

    $Username     = safe_normal_input($_POST['username']);
    $mail         = safe_normal_input($_POST['mail']);
    $pwd          = hashing(safe_pwd($_POST['pwd']), $Username);

    // if connect :
    if ($conn) {
        //check how many record with that 

        $check = "SELECT * FROM `users` WHERE u_name = '$Username' OR u_email = '$mail'";
        $rows_len = mysqli_num_rows(mysqli_query($conn, $check));


        //if there is not any user with that email or username
        if ($rows_len == 0) {
            $query = "INSERT INTO `users` (`u_name`, `u_email`, `pwd`) VALUES ('$Username', '$mail', '$pwd')";

            mysqli_query($conn, $query);
            $id = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `users` WHERE `u_name`='$Username' AND `u_email`='$mail'"),MYSQLI_ASSOC) ;
            $data['id'] = $id['id'];
            $data['username'] = $Username;
            response(200, "User Created", $data);
        }

        // else if there is user with that username and that password

        else {

            response(250, "there is account with that info", null);
        }
    }
    //else if can not connect to server
    else {
        //can not connect to server

        response(250, "can not connect to server", null);
    }
}
function response($status, $status_message, $data)
{
    header("HTTP/1.1 " . $status);
    $response['status'] = $status;
    $response['status_message'] = $status_message;
    if ($status == 200) {
        $response['id'] = $data['id'];
        $response['username'] = $data['username'];
    }
    $json_response = json_encode($response);
    echo $json_response;
}
