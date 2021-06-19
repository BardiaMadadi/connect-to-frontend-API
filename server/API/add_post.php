<?php
//using
header("Content-Type:application/json");
require '../Objects/post.php';
if (isset($_POST['post_img']) && isset($_POST['post_title']) && isset($_POST['post_body']) && isset($_POST['user_id'])) {
    $post = new post($_POST['post_img'], $_POST['post_title'], $_POST['post_body'], $_POST['user_id']);
    $post->post();
}
