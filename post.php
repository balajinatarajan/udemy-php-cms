<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<!-- Navigation -->
<?php include "includes/navigation.php";?>

<!-- Page Content -->
<div class="container">

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
        </h1>

        <!-- First Blog Post -->
        <?php
            $post_id = mysqli_real_escape_string($connection, $_GET['post_id']);
            if($post_id != '' && !empty($post_id)){
            
            $posts_query = "SELECT * FROM posts WHERE post_id = {$post_id}";
            $posts = mysqli_query($connection, $posts_query);
            while($row = mysqli_fetch_assoc($posts)){
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_content = $row['post_content'];
                $post_image = $row['post_image'];
                ?>
                <h2>
                    <?php echo $post_title;?>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content;?></p>

                <hr>
                <?php
            }
        ?>
    
<!-- Blog Comments -->

               <?php
                //post comments to db
                if(isset($_POST['addcomment'])){
                    $comment_author = mysqli_real_escape_string($connection, $_POST['comment_author']);
                    $comment_email = mysqli_real_escape_string($connection, $_POST['comment_email']);
                    $comment_content = mysqli_real_escape_string($connection, $_POST['comment_content']);
                    
                    $comment_insert_qs = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) ";
                    $comment_insert_qs .= "VALUES ({$post_id},'{$comment_author}','{$comment_email}','{$comment_content}','unapproved',now())";
                    
                    $com_ins_q = mysqli_query($connection, $comment_insert_qs);
                    
                    if($com_ins_q){
                        showMsg('Comment Successfully added and is awaiting moderation! Thank you for commenting!','success');
                    } else {
                        showMsg('Problem adding comment!','danger');
                    }
                }
               ?>
               
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group"><input type="text" class="form-control" name="comment_author" placeholder="Name"></div>
                        <div class="form-group"><input type="text"  class="form-control" name="comment_email" placeholder="Email"></div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="addcomment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php 
                    //get comments for this post
                    $comment_qs = "SELECT * FROM comments WHERE comment_post_id = {$post_id} AND comment_status = 'approved'";
                    $comment_q = mysqli_query($connection, $comment_qs);
                    if($comment_q && mysqli_num_rows($comment_q) > 0){
                        echo "<h3>".mysqli_num_rows($comment_q)." comments</h3>";
                        while($row = mysqli_fetch_assoc($comment_q)){
                            $comment_author = $row['comment_author'];
                            $comment_date = $row['comment_date'];
                            $comment_content = $row['comment_content'];
                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author;?>
                            <small><?php echo $comment_date;?></small>
                        </h4>
                        <?php echo $comment_content;?>
                    </div>
                </div>
                <?php }
                    } //if comment exists 
        else {
            echo "No comments";
        }?>
                <!-- Comment -->
<!--
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                    </div>
                </div>
-->
                
        <!-- Pager -->
<!--
        <ul class="pager">
            <li class="previous">
                <a href="#">&larr; Older</a>
            </li>
            <li class="next">
                <a href="#">Newer &rarr;</a>
            </li>
        </ul>
-->
    <?php } //end if post_id ?>

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"?>

</div>
<!-- /.row -->

<hr>

   
<?php include "includes/footer.php";?>