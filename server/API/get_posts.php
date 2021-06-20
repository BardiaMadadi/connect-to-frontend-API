<?php
//using
header("Content-Type:application/json");
    include_once '../conf/db.php';
    $query = "SELECT * FROM `posts` ORDER BY `post_id` DESC";
    $posts = mysqli_fetch_all(mysqli_query($conn,$query),MYSQLI_ASSOC);
    echo json_encode($posts,true);

