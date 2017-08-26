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
            if(isset($_GET['submit'])){
                $search = $_GET['search'];   
                $search = mysqli_real_escape_string($connection, $search);
                
                $search_query = "SELECT * FROM posts WHERE post_status = 'publish' AND post_tags LIKE '%$search%'";
                $search_result = mysqli_query($connection, $search_query);
                
                if(!$search_result){
                    die("Could not execute search query");
                } else {
                    if(mysqli_num_rows($search_result)>0){
                        
                        while($row = mysqli_fetch_assoc($search_result)){
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_content = $row['post_content'];
                            $post_image = $row['post_image'];
                            ?>
                            <h2>
                                <a href="#"><?php echo $post_title;?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $post_author;?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                            <hr>
                            <p><?php echo $post_content;?></p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>
                <?php
                        }
                    } else {
                        echo "<div class='alert alert-danger'>No matching posts found! Please try a new search!</div>";
                    }
                }
                
            }    
            
        ?>

        <!-- Pager -->
        <ul class="pager">
            <li class="previous">
                <a href="#">&larr; Older</a>
            </li>
            <li class="next">
                <a href="#">Newer &rarr;</a>
            </li>
        </ul>

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"?>

</div>
<!-- /.row -->

<hr>
<?php include "includes/footer.php";?>
       
