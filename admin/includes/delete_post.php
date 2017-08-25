<?php
$post_id = mysqli_real_escape_string($connection, $_GET['post_id']);
if(!empty($post_id)){
    $post_image = '';
    $select_post_image = "SELECT post_image FROM posts WHERE post_id = {$post_id}";
    $query = mysqli_query($connection, $select_post_image);
    
    while($row = mysqli_fetch_assoc($query)){
        $post_image = $row['post_image'];
    }
    //delete image
    if($post_image != '' && !empty($post_image)){
        unlink("../images/".$post_image);
    }
    //delete asset
    $delete = "DELETE FROM posts WHERE post_id = {$post_id}";
    if(mysqli_query($connection, $delete)){
        echo "<div class='alert alert-success'>Post Successfully Deleted!</div>";
    } else {
        echo "<div class='alert alert-danger'>Post could not be Deleted!</div>";
    }
} 
?>