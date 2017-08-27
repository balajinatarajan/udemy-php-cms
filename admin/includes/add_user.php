
   <div class="col-xs-8">
    <form action="users.php?action=add_user_action" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="user_password">Password</label>
            <input type="password" name="user_password" class="form-control">
        </div>
        <div class="form-group">
            <label for="user_firstname">First Name</label>
            <input type="text" name="user_firstname" class="form-control">
        </div>
        <div class="form-group">
            <label for="user_lastname">Last Name</label>
            <input type="text" name="user_lastname" class="form-control">
        </div>
        <div class="form-group">
            <label for="user_email">Email</label>
            <input type="text" name="user_email" class="form-control">
        </div>
        <div class="form-group">
            <label for="user_image">Image</label>
            <input type="file" name="user_image" class="form-control">
        </div>
        <div class="form-group">
            <label for="user_role">Role</label>
            <select name="user_role" id="user_role" class="form-control">
                <option value="author">Author</option>
                <option value="admin">Admin</option>
                <option value="subscriber">Subscriber</option>
            </select>
        </div>
        <div class="form-group"><button type="submit" name="create_user" class="btn btn-primary">Create</button></div>
    </form>
</div>