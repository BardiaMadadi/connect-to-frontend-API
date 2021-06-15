<?php
header("Content-Type:application/json");

// using :
include_once
    '../functions/create_account.php';
include_once
    '../conf/db.php';

if (isset($_POST['username']) && isset($_POST['mail']) && isset($_POST['pwd']) && isset($_POST['pwd_repeat'])) {
    //variables

    $Username     = safe_normal_input($_POST['username']);
    $mail         = safe_normal_input($_POST['mail']);
    $pwd          = hashing(safe_pwd($_POST['pwd']), $Username);
    $pwd_repeat   = hashing(safe_pwd($_POST['pwd_repeat']), $Username);

    // if connect :
    if ($conn) {
        if (!empty($Username) && !empty($mail) && !empty($pwd) && !empty($pwd_repeat)) {

            if ($pwd == $pwd_repeat) {
                $query = "SELECT * FROM `users` WHERE u_name = '$Username' AND u_email = '$mail' AND pwd = '$pwd' ";
                $rows_len = mysqli_num_rows(mysqli_query($conn, $query));
                if ($rows_len == 0) {
                    $query = "INSERT INTO `users` (`u_name`, `u_email`, `pwd`) VALUES ('$Username', '$mail', '$pwd')";

                    mysqli_query($conn, $query);
                    $response_data = array(
                        'username' => $Username,
                        'mail' => $mail,
                        'pwd' => $pwd
                    );
                    response(200, "User Created", $response_data);
                } else {

                    response(400, "there is account with that info", null);
                }
            } else {
                // pwd and pwd repeat dose not match

                response(400, "pwd and pwd repeat dose not match", null);
            }
        } else {
            //inputs are empty

            response(400, "inputs are empty", null);
        }
    } else {
        //can not connect to server

        response(400, "can not connect to server", null);
    }
}

function response($status, $status_message, $data)
{
    header("HTTP/1.1 " . $status);
    $response['status'] = $status;
    $response['status_message'] = $status_message;
    if($status == 200){
        $response['data'] = $data;
    }
    $json_response = json_encode($response);
    echo $json_response;
}
?>
<!-- <form action="" method="post">

<input name="username" type="text">
<input name="mail" type="text">
<input name="pwd" type="text">
<input name="pwd_repeat" type="text">

<button type="submit">SUBMIT</button>
</form> -->

