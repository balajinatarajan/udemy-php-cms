<table class="table table-bordered table-hover">
    <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Email</th>
        <th>Comment</th>
        <th>Status</th>
        <th>Date</th>
        <th>In Response To</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
    </tr>
<?php
$comments_query = "SELECT * FROM comments";
$comments = mysqli_query($connection, $comments_query);
while($row = mysqli_fetch_assoc($comments)){
        $comment_id = $row['comment_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_post_id = $row['comment_post_id'];
        $comment_date = $row['comment_date'];
        
    
        //get category title
        $post_qs = "SELECT post_title FROM posts WHERE {$comment_post_id}";
        $post_q = mysqli_query($connection, $post_qs);
        $comment_post_title = '';
        if($post_q){
            $comment_post_title = mysqli_fetch_assoc($post_q)['post_title'];
        }

        echo "<tr>". printColumns([$comment_id,$comment_author,$comment_email,$comment_content,$comment_status,$comment_date]).
            "<td><a href='../post.php?post_id={$comment_post_id}' target='_blank'>{$comment_post_title}</a></td>".
        "<td><a href='comments.php?action=approve_comment&comment_id={$comment_id}'>Approve</a></td>".
        "<td><a href='comments.php?action=unapprove_comment&comment_id={$comment_id}'>Unapprove</a></td>".
        "<td><a href='comments.php?action=delete_comment&comment_id={$comment_id}'>Delete</a></td></tr>";
}
?>
</table>