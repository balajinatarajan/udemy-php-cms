<div class="col-md-4">
        <!-- Blog Search Well -->
        <div class="well">
            <h4>Blog Search</h4>
            <form action="search.php" method="get">
                <div class="input-group">
                    <input name="search" type="text" class="form-control">
                    <span class="input-group-btn">
                        <button name="submit" class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                    </button>
                    </span>
                </div>
            </form>
            <!-- /.input-group -->
        </div>

        <!-- Blog Categories Well -->
        <div class="well">
            <h4>Blog Categories</h4>
            <div class="row">
               <div class="col-lg-6">
                    <ul class="list-unstyled">
                <?php
                    $cat_query = 'SELECT * FROM categories';
                    $categories = mysqli_query($connection, $cat_query);
                
                    $count = mysqli_num_rows($categories);
                    $index = 0;
                
                    while($row = mysqli_fetch_assoc($categories)){
                        $cat_title = $row['cat_title'];
                        echo '<li><a href="category.php?category='.$cat_title.'">'.$cat_title.'</a>';
                        if($index == floor($count/2)-1){
                            //break the column halfway through
                            echo '</ul></div><div class="col-lg-6"><ul class="list-unstyled">';
                        }
                        
                        $index = $index + 1;
                    }
                ?>
                    </ul>
                </div>
            </div>
            <!-- /.row -->
        </div>

        <?php include "widget.php";?>

    </div>