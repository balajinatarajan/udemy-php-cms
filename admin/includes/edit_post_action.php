<?php
if(isset($_POST['edit_post'])){
    $post_id = mysqli_real_escape_string($connection,$_POST['post_id']);
    $post_category_id = mysqli_real_escape_string($connection,$_POST['post_category_id']);
    $post_title = mysqli_real_escape_string($connection,$_POST['post_title']);
    $post_author = mysqli_real_escape_string($connection,$_POST['post_author']);
    
    $post_image = $_FILES['post_image']['name'];
    $post_current_image = mysqli_real_escape_string($connection, $_POST['post_current_image']);
    if($post_image != '' && !empty($post_image)){
        $post_image_temp = $_FILES['post_image']['tmp_name']; 
        //move uploaded file to server
        move_uploaded_file($post_image_temp, "../images/$post_image");
        //delete old image
        // this is problematic because 2 posts can share same image filename. if you add post id to the image, then you will be maintaining duplicate images in the long run. best practice is to purge orphan image on a timely basis
        //unlink("../images/".$post_current_image);
    }
    
    
    $post_content = mysqli_real_escape_string($connection,$_POST['post_content']);
    $post_tags = mysqli_real_escape_string($connection,$_POST['post_tags']);
    $post_status = mysqli_real_escape_string($connection,$_POST['post_status']);
    
    //insert post
    $update_post = "UPDATE posts SET post_category_id = {$post_category_id}, post_title = '{$post_title}', post_author = '{$post_author}', ";
    if($post_image != '' && !empty($post_image)){
        $update_post .= "post_image = '{$post_image}', ";
    }
    $update_post .= "post_content = '{$post_content}', post_tags = '{$post_tags}', post_status = '{$post_status}' ";
    $update_post .= "WHERE post_id = {$post_id}";
    
    $update_post_query = mysqli_query($connection, $update_post);
    if($update_post_query){
        echo "<div class='alert alert-success'>Post Successfully updated!</div>";
    } else {
        echo "<div class='alert alert-danger'>Problem updating post!".mysqli_error($connection)."</div>";
    }
        
}
?> 