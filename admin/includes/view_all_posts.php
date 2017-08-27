<?php
if(!empty($_GET['showmsg'])){
    switch($_GET['showmsg']){
        case "statusupdated": showMsgDis('Post Status Updated!','success');
            break;
        case "statusnotupdated": showMsgDis('Problem updating Post Status!','danger');
            break;
        case "deleted": showMsgDis('Post Deleted!','success');
            break;
        case "notdeleted": showMsgDis('Problem deleting Post!','danger');
            break;
        case "created": showMsgDis('New Post Created!','success');
            break;
        case "notcreated": showMsgDis('Problem creating post!','danger');
            break;
        case "updated": showMsgDis('Post updated!','success');
            break;
        case "notUpdated": showMsgDis('Problem updating Post!','danger');
            break;
        default: //nothing to do
            break;
    }
}
?> 
<table class="table table-bordered table-hover">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Category</th>
        <th>Author</th>
        <th>Date</th>
        <th>Comments</th>
        <th>Tags</th>
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
        <th>Action</th>
        <th>Action</th>
    </tr>
<?php
$posts_query = "SELECT * FROM posts";
$posts = mysqli_query($connection, $posts_query);
while($row = mysqli_fetch_assoc($posts)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_comment_count = 0;
        //get comments from comments table
        $comment_qs = "SELECT count(*) AS count FROM comments WHERE comment_post_id = {$post_id}";
        $comment_q = mysqli_query($connection, $comment_qs);
        if($comment_q){
            $post_comment_count = mysqli_fetch_assoc($comment_q)['count'];
        }
    
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
    
        //get category title
        $cat_qs = "SELECT cat_title FROM categories WHERE {$post_category_id}";
        $cat_q = mysqli_query($connection, $cat_qs);
        $post_category_title = '';
        if($cat_q){
            $post_category_title = mysqli_fetch_assoc($cat_q)['cat_title'];
        }
        $post_status_action = '';
        if($post_status == 'draft'){
            $post_status_action = "<a href='posts.php?action=approve_post&post_id={$post_id}'>Approve</a></td>";
        } else {
            $post_status_action = "<a href='posts.php?action=unapprove_post&post_id={$post_id}'>Unapprove</a></td>";
        }

        echo "<tr>". printColumns([$post_id,$post_title,$post_category_title,$post_author,$post_date,$post_comment_count,$post_tags]).
            "<td><a href='../images/{$post_image}' target='_blank'><img width='100' src='../images/{$post_image}' class='img-thumbnail'></a></td>".
            "<td>{$post_status}</td>".
            "<td>".$post_status_action."</td>".
        "<td><a href='posts.php?action=delete_post&post_id={$post_id}'>Delete</a></td>".
        "<td><a href='posts.php?action=edit_post&post_id={$post_id}'>Edit</a></td></tr>";
}
?>
</table>