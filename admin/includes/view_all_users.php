<?php
if(!empty($_GET['showmsg'])){
    switch($_GET['showmsg']){
        case "deleted": showMsgDis('User Deleted!','success');
            break;
        case "notdeleted": showMsgDis('Problem deleting User!','danger');
            break;
        case "created": showMsgDis('New User Created!','success');
            break;
        case "notcreated": showMsgDis('Problem Creating new user!','danger');
            break;
        case "updated": showMsgDis('User updated!','success');
            break;
        case "notUpdated": showMsgDis('Problem updating User!','danger');
            break;
        default: //nothing to do
            break;
    }
}
?> 
<table class="table table-bordered table-hover">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last name</th>
        <th>Joined Date</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Image</th>
        <th>Action</th>
        <th>Action</th>
    </tr>
<?php
$users_query = "SELECT * FROM users";
$users = mysqli_query($connection, $users_query);
while($row = mysqli_fetch_assoc($users)){
        $user_id = $row['user_id'];
        $user_name = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_status = $row['user_status'];
        $user_date = $row['created_date'];
    
        echo "<tr>". printColumns([$user_id,$user_name,$user_firstname,$user_lastname,$user_date,$user_email,$user_role,$user_status]).
            "<td><a href='../images/{$user_image}' target='_blank'><img width='100' src='../images/{$user_image}' class='img-thumbnail'></a></td>".
        "<td><a href='users.php?action=delete_user&user_id={$user_id}'>Delete</a></td>".
        "<td><a href='users.php?action=edit_user&user_id={$user_id}'>Edit</a></td></tr>";
}
?>
</table>