<?php
function safe_normal_input($input)
{
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
function safe_pwd($input)
{
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
function hashing($password,$username)
{
    $hash_code = $password.$username;
    $safe_pwd = md5($hash_code,false);
    return $username.$safe_pwd.$password;
}
