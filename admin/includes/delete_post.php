<?php
if(!empty($_GET['post_id'])){
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
       // unlink("../images/".$post_image);
        //other posts could share this image
    }
    //delete asset
    $delete = "DELETE FROM posts WHERE post_id = {$post_id}";
    if(mysqli_query($connection, $delete)){
        showMsg('Post Successfully Deleted!','success');
    } else {
        showMsg('Post could not be Deleted!','danger');
    }
} 
} else {
    showMsg('Oops! No post id in url!', 'danger');
}
?>