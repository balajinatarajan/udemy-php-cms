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
            $cat_title = mysqli_real_escape_string($connection, $_GET['category']);
            if($cat_title != '' && !empty($cat_title)){
            //get cat_id
            $cat_qs = "SELECT cat_id FROM categories WHERE cat_title = '{$cat_title}'";
            $cat_q = mysqli_query($connection, $cat_qs);
            if($cat_q){
            $cat_id = mysqli_fetch_assoc($cat_q)['cat_id'];
                
            $posts_query = "SELECT * FROM posts WHERE post_category_id = {$cat_id}";
            $posts = mysqli_query($connection, $posts_query);
            if(mysqli_num_rows($posts) == 0){
                echo "<div class='alert alert-danger'>No posts in this category!</div>";
            }
            while($row = mysqli_fetch_assoc($posts)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_content = substr($row['post_content'],0,50) . "...";
                $post_image = $row['post_image'];
                ?>
                <h2>
                    <a href="post.php?post_id=<?php echo $post_id;?>"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content;?></p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php
            }
        ?>

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
    <?php }} //end if GET param set?>

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"?>

</div>
<!-- /.row -->

<hr>
<?php include "includes/footer.php";?>
       