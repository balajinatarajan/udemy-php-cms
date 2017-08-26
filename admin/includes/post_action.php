<?php
function updatePostStatus($post_id, $status){
    global $connection;
    if(!empty($_GET['post_id'])){
        $update_qs = "UPDATE posts SET post_status = '{$status}' WHERE post_id = {$post_id}";
        $update_q = mysqli_query($connection, $update_qs);
        if($update_q){
            header('Location: http://localhost:8888/cms/admin/posts.php?showmsg=statusupdated');
        } else {
            header('Location: http://localhost:8888/cms/admin/posts.php?showmsg=statusnotupdated');
            //echo mysqli_error($connection);
        }
    } else {
        showMsg('Oops! No post id in url!', 'danger');
    }
}

function deletePost($post_id){
    global $connection;
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
            header('Location: http://localhost:8888/cms/admin/posts.php?showmsg=deleted');
        } else {
            header('Location: http://localhost:8888/cms/admin/posts.php?showmsg=notdeleted');
        }
    } 
    } else {
        showMsg('Oops! No post id in url!', 'danger');
    }
}

function addPost(){
    global $connection;
    
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
        $post_status = mysqli_real_escape_string($connection,$_POST['post_status']);

        //move uploaded file to server
        move_uploaded_file($post_image_temp, "../images/$post_image");

        //insert post
        $insert_post = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
        $insert_post .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

        $insert_post_query = mysqli_query($connection, $insert_post);
        if($insert_post_query){
            header('Location: http://localhost:8888/cms/admin/posts.php?showmsg=created');
            //showMsg('Post Successfully created!','success');
        } else {
            header('Location: http://localhost:8888/cms/admin/posts.php?showmsg=notcreated');
            //showMsg("Problem creating new post!".mysqli_error($connection),'danger');
        }

    }
}

function editPost(){
    global $connection;
    
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
            header('Location: http://localhost:8888/cms/admin/posts.php?showmsg=updated');
            //showMsg('Post Successfully updated!','success');
        } else {
            header('Location: http://localhost:8888/cms/admin/posts.php?showmsg=notupdated');
            //showMsg("Problem updating post!".mysqli_error($connection),'danger');
        }

    }
}

function getPostID(){
    global $connection;
    $post_id = mysqli_real_escape_string($connection, $_GET['post_id']);
    if(!empty($post_id)){
        return $post_id;
    } 
    return '';
}

if(!empty($_GET['action'])){
    $action = mysqli_real_escape_string($connection, $_GET['action']);
    
    switch($action){
            case "approve_post": updatePostStatus(getPostID(), 'publish');
                    break;
            case "unapprove_post": updatePostStatus(getPostID(), 'draft');
                    break;
            case "delete_post": deletePost(getPostID());
                    break;
            case "add_post": include "includes/add_post.php";
                    break;
            case "edit_post": include "includes/edit_post.php";
                    break;
            case "add_post_action": addPost();
                    break;
            case "edit_post_action": editPost();
                    break;
            default: //nothing to do
                break;
    }
} else {
    showMsg('Something is not right, post action is missing!','danger');
}

?>