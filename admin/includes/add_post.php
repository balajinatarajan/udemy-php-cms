
   <div class="col-xs-8">
    <form action="posts.php?action=add_post_action" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="post_title">Title</label>
            <input type="text" name="post_title" class="form-control">
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
                <option value="<?php echo $cat_id;?>"><?php echo $cat_title;?></option>
                <?php 
                    } 
                ?>
            </select></div>
        <div class="form-group">
            <label for="post_author">Author</label>
            <input type="text" name="post_author" class="form-control">
        </div>
        <div class="form-group">
            <label for="post_date">Date</label>
            <input type="date" name="post_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="post_image">Image</label>
            <input type="file" name="post_image" class="form-control">
        </div>
        <div class="form-group">
            <label for="post_content">Content</label>
            <textarea name="post_content" id="post_content" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="post_tags">Tags</label>
            <input type="text" name="post_tags" class="form-control">
        </div>
        <div class="form-group">
            <label for="post_status">Status</label>
            <select name="post_status" id="post_status" class="form-control">
                <option value="draft">Draft</option>
                <option value="publish">Publish</option>
                <option value="archive">Archive</option>
            </select>
        </div>
        <div class="form-group"><button type="submit" name="create_post" class="btn btn-primary">Create</button></div>
    </form>
</div>