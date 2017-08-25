<?php
if(isset($_POST['create_post'])){
    $post_category_id = mysqli_real_escape_string($connection,$_POST['post_category_id']);
    $post_title = mysqli_real_escape_string($connection,$_POST['post_title']);
    $post_author = mysqli_real_escape_string($connection,$_POST['post_author']);
    
    //$post_date = mysqli_real_escape_string($connection,$_POST['post_date']);
    $post_date = date('d-m-y');
    
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    
    $post_content = mysqli_real_escape_string($connection,$_POST['post_content']);
    $post_tags = mysqli_real_escape_string($connection,$_POST['post_tags']);
    $post_comment_count = 0;
    $post_status = mysqli_real_escape_string($connection,$_POST['post_status']);
    
    //move uploaded file to server
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    //insert post
    $insert_post = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    $insert_post .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}')";
    
    $insert_post_query = mysqli_query($connection, $insert_post);
    if($insert_post_query){
        echo "<div class='alert alert-success'>Post Successfully created!</div>";
    } else {
        echo "<div class='alert alert-danger'>Problem creating new post!".mysqli_error($connection)."</div>";
    }
        
}
?> 