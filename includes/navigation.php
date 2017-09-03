<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Game of Thrones</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li>
                <a href="admin/index.php">Admin</a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Categories <span class="caret"></span></a>
                <ul class="dropdown-menu">
                 <?php
                if($connection){
                    //echo "database is available";
                    $query = 'SELECT * FROM categories';
                    $select_all_categories = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_all_categories)){
                        echo "<li><a href='category.php?category={$row['cat_title']}'>{$row['cat_title']}</a></li>";
                    }
                }
            ?>
                <!--li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li-->
                </ul>
              </li>
              <?php if(has_access('posts_crud') && !empty($_GET['post_id'])){?>
                            <li>
                                <a href="admin/posts.php?action=edit_post&post_id=<?php echo $_GET['post_id']; ?>">Edit this Post</a>
                            </li>
                            <?php } ?>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>