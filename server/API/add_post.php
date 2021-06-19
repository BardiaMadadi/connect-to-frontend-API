<?php
//using
header("Content-Type:application/json");
require '../Objects/post.php';
$post = new post($_POST['post_img'], $_POST['post_title'], $_POST['post_body'], $_POST['user_id']);
$post->post();

