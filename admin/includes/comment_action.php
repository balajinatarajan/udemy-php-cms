<?php
function updateCommentStatus($comment_id, $status){
    global $connection;
    $update_qs = "UPDATE comments SET comment_status = '{$status}' WHERE comment_id = {$comment_id}";
    $update_q = mysqli_query($connection, $update_qs);
    if($update_q){
        header('Location: http://localhost:8888/cms/admin/comments.php?showmsg=statusupdated');
    } else {
        header('Location: http://localhost:8888/cms/admin/comments.php?showmsg=statusnotupdated');
        //echo mysqli_error($connection);
    }
}

function deleteComment($comment_id){
    global $connection;
    $delete_qs = "DELETE FROM comments WHERE comment_id = {$comment_id}";
    $delete_q = mysqli_query($connection, $delete_qs);
    if($delete_q){
        header('Location: http://localhost:8888/cms/admin/comments.php?showmsg=deleted');
    } else {
        header('Location: http://localhost:8888/cms/admin/comments.php?showmsg=notdeleted');
    }
}

if(!empty($_GET['action'])){
    $action = mysqli_real_escape_string($connection, $_GET['action']);
    $comment_id = mysqli_real_escape_string($connection, $_GET['comment_id']);
    if(!empty($comment_id)){
        switch($action){
            case "approve_comment": //echo "Approve Comment action invoked!";
                updateCommentStatus($comment_id, 'approved');
                break;
            case "unapprove_comment": //echo "Unapprove Comment action invoked!";
                updateCommentStatus($comment_id, 'unapproved');
                break;
            case "delete_comment": //echo "Delete Comment action invoked!";
                deleteComment($comment_id);
                break;
            default: showMsg('Unsupported comment action! something doesnt look right','danger');
                break;
        }
    } else {
        showMsg('No comment to take action on! Something doesnt look right','danger');
    }
} else {
    showMsg('Something is not right, comment action is missing!','danger');
}

?>