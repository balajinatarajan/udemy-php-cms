<?php
    $post_id = mysqli_real_escape_string($connection, $_GET['post_id']);
    if($post_id != '' && !empty($post_id)){
        //retrieve post
        $post_qs = "SELECT * FROM posts WHERE post_id = {$post_id}";
        $post_q = mysqli_query($connection, $post_qs);
        $row = mysqli_fetch_assoc($post_q);
        if($row){
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_author = $row['post_author'];
            
            //$post_date
            
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_status = $row['post_status'];
        ?>
   <div class="col-xs-8">
    <form action="posts.php?action=edit_post_action" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="post_title">Title</label>
            <input type="text" name="post_title" class="form-control" value="<?php echo $post_title ?>">
            <input type="hidden" name="post_id" value="<?php echo $post_id;?>">
        </div>
        <div class="form-group">
            <label for="post_category_id">Category</label>
            <select name="post_category_id" id="post_category_id" class="form-control">
               <?php
                    $cat_query = "SELECT * FROM categories";
                    $cat_result = mysqli_query($connection, $cat_query);
                    while($row = mysqli_fetch_assoc($cat_result)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        ?>
                <option value="<?php echo $cat_id;?>" <?php if($cat_id == $post_category_id){echo "selected";}?>><?php echo $cat_title;?></option>
                <?php 
                    } 
                ?>
            </select></div>
        <div class="form-group">
            <label for="post_author">Author</label>
            <input type="text" name="post_author" class="form-control" value="<?php echo $post_author ?>">
        </div>
        <!--div class="form-group">
            <label for="post_date">Date</label>
            <input type="date" name="post_date" class="form-control">
        </div-->
        <div class="form-group">
            <label for="post_image">Image</label>
            <input type="file" name="post_image" class="form-control"><br>
            <a href='../images/<?php echo $post_image?>' target='_blank'><img width='100' src='../images/<?php echo $post_image?>' class='img-thumbnail'></a>
            <input type="hidden" name="post_current_image" value="<?php echo $post_image;?>">
        </div>
        <div class="form-group">
            <label for="post_content">Content</label>
            <textarea name="post_content" id="post_content" cols="30" rows="10" class="form-control"><?php echo $post_content ?></textarea>
        </div>
        <div class="form-group">
            <label for="post_tags">Tags</label>
            <input type="text" name="post_tags" class="form-control" value="<?php echo $post_tags ?>">
        </div>
        <div class="form-group">
            <label for="post_status">Status</label>
            <select name="post_status" id="post_status" class="form-control">
                <option value="draft" <?php if($post_status == 'draft'){echo "selected";}?>>Draft</option>
                <option value="publish" <?php if($post_status == 'publish'){echo "selected";}?>>Publish</option>
                <option value="archive" <?php if($post_status == 'archive'){echo "selected";}?>>Archive</option>
            </select>
        </div>
        <div class="form-group"><button type="submit" name="edit_post" class="btn btn-primary">Update</button></div>
    </form>
</div>
<?php
            } else {
                echo "<div class='alert alert-danger'>Problem finding posts!</div>";

            }
    }
?>