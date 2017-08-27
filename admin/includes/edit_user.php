<?php
    $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
    if($user_id != '' && !empty($user_id)){
        //retrieve user
        $user_qs = "SELECT * FROM users WHERE user_id = {$user_id}";
        $user_q = mysqli_query($connection, $user_qs);
        $row = mysqli_fetch_assoc($user_q);
        if($row){
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];

            $user_image = $row['user_image'];
            
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
            $user_role = $row['user_role'];
        ?>
   <div class="col-xs-8">
    <form action="users.php?action=edit_user_action" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username ?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
        </div>
        <div class="form-group">
            <label for="user_password">Password</label>
            <input type="password" name="user_password" class="form-control" value="<?php echo $user_password ?>">
        </div>
        <div class="form-group">
            <label for="user_firstname">First Name</label>
            <input type="text" name="user_firstname" class="form-control" value="<?php echo $user_firstname ?>">
        </div>
        <div class="form-group">
            <label for="user_lastname">Last Name</label>
            <input type="text" name="user_lastname" class="form-control" value="<?php echo $user_lastname ?>">
        </div>
        <div class="form-group">
            <label for="user_email">Email</label>
            <input type="text" name="user_email" class="form-control" value="<?php echo $user_email ?>">
        </div>
        <div class="form-group">
            <label for="user_image">Image</label>
            <input type="file" name="user_image" class="form-control"><br>
            <a href='../images/<?php echo $user_image?>' target='_blank'><img width='100' src='../images/<?php echo $user_image?>' class='img-thumbnail'></a>
            <input type="hidden" name="user_current_image" value="<?php echo $user_image;?>">
        </div>
        <div class="form-group">
            <label for="user_role">Role</label>
            <select name="user_role" id="user_role" class="form-control">
                <option value="author" <?php if($user_role == 'author'){echo "selected";}?>>Author</option>
                <option value="admin" <?php if($user_role == 'admin'){echo "selected";}?>>Admin</option>
                <option value="subscriber" <?php if($user_role == 'subscriber'){echo "selected";}?>>Subscriber</option>
            </select>
        </div>
        <div class="form-group"><button type="submit" name="edit_user" class="btn btn-primary">Update</button></div>
    </form>
</div>
<?php
            } else {
                echo "<div class='alert alert-danger'>Problem finding users!</div>";

            }
    }
?>