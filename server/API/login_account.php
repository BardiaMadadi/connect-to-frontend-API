<?php

header("Content-Type:application/json");

//using
include_once '../functions/login_account.php';
include_once '../conf/db.php';

if (isset($_POST['mail']) && isset($_POST['pwd'])) {

    //if mail AND pwd set

    $mail = safe_normal_input($_POST['mail']);
    $pwd = safe_pwd($_POST['pwd']);
    if ($conn) {
        //when connected to server

        // select user with that mail
        $query = "SELECT * FROM `users` WHERE u_email = '$mail' u_pwd = '$pwd'";
        // return number of users with that info
        $num_row = mysqli_num_rows(mysqli_query($conn, $query));
        if ($num_row > 0) {
            //if there is more than 0 user
            if ($num_row == 1) {



                $query = "SELECT * FROM `users` WHERE u_email = '$mail' LIMIT 1";
                // return number of users with that info
                //
                $user_info = mysqli_fetch_array(mysqli_query($conn, $query), MYSQLI_ASSOC);

                //if there is 1 user with that info
                //
                if (hashing($pwd, $user_info['u_name']) == $user_info['pwd']) {
                    //if pwd match
                    //
                    $data['id'] = $user_info['id'];
                    $data['username'] = $user_info['u_name'];
                    $data['email'] = $user_info['u_email'];
                    response(200,"User found",$data);
                } else {
                    //pwd dose  not match
                    response(250,"password dose not match",null);
                }
            } 
        } else {
            //if there is not user with that info
            response(250,"there is not user with that info",null);
        }
    }
}


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

