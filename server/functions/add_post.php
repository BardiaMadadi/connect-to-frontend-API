<?php    //response
function response($status, $status_message, $data)
{
    header("HTTP/1.1 " . $status);
    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $json_response = json_encode($response);
    echo $json_response;
}
