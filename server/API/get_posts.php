<?php
//using
header("Content-Type:application/json");
if(isset($_GET['user_id']) || isset($_GET['search'])){

    if (isset($_GET['user_id'])) {
        $userid = $_GET['user_id'];
        $query = "SELECT * FROM `posts` WHERE `user_id`='$userid' ORDER BY `post_id` DESC";
    } else if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $query = "SELECT * FROM `posts` WHERE `post_title` LIKE '%$search%' OR `post_body` LIKE '%$search%' ORDER BY `post_id` DESC";
    } 
}else {
    $query = "SELECT * FROM `posts` ORDER BY `post_id` DESC";
}


include_once '../conf/db.php';
$posts = mysqli_fetch_all(mysqli_query($conn, $query), MYSQLI_ASSOC);
echo json_encode($posts, true);
