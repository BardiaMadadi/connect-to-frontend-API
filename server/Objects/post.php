<?php
class post
{
    public $post_img;
    public $post_title;
    public $post_body;
    public $user_id;

    function __construct($post_img, $post_title, $post_body, $user_id)
    {
        $this->post_img = $post_img;
        $this->post_title = $post_title;
        $this->post_body = $post_body;
        $this->user_id = $user_id;
    }

    function post()
    {
        include_once '../conf/db.php';
        include_once '../functions/add_post.php';
        $post_img = $this->post_img;
        $post_title = $this->post_title;
        $post_body = $this->post_body;
        $user_id = $this->user_id;



        if ($conn) {
            $post = "SELECT * FROM `posts` WHERE `post_body`='$post_body' OR `post_title`='$post_title' OR `post_img`= '$post_img'";
            $post_num = mysqli_num_rows(mysqli_query($conn, $post));
            if ($post_num == 0) {
                require_once '../functions/jdf.php';
                $num_date = jdate('Y/m/d');
                $date = jdate('J F V');
                $query = "INSERT INTO `posts`(`post_img`, `post_title`, `post_body`, `num_date`, `date`, `user_id`) VALUES ('$post_img','$post_title','$post_body','$num_date','$date','$user_id')";
                mysqli_query($conn, $query);
                response(200, "Post created", null);
            } else {
                response(400, "same post", null);
            }
        } else {
            response(400, "Cant connect to server", null);
        }
    }


}
