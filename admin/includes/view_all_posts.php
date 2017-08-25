<table class="table table-bordered table-hover">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Date</th>
        <th>Comments</th>
        <th>Tags</th>
        <th>Status</th>
        <th>Image</th>
        <th>Action</th>
        <th>Action</th>
    </tr>
<?php
$posts_query = "SELECT * FROM posts";
$posts = mysqli_query($connection, $posts_query);
while($row = mysqli_fetch_assoc($posts)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_comment_count = $row['post_comment_count'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];

        echo "<tr>". printColumns([$post_id,$post_title,$post_author,$post_date,$post_comment_count,$post_tags,$post_status]).
            "<td><a href='../images/{$post_image}' target='_blank'><img width='100' src='../images/{$post_image}' class='img-thumbnail'></a></td>".
        "<td><a href='posts.php?action=delete_post&post_id={$post_id}'>Delete</a></td>".
        "<td><a href='posts.php?action=edit_post&post_id={$post_id}'>Edit</a></td></tr>";
}
?>
</table>