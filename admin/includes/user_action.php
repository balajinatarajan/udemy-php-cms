<?php
function deleteUser($user_id){
    global $connection;
    if(!empty($_GET['user_id'])){
    $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
    if(!empty($user_id)){
        //delete asset
        $delete = "DELETE FROM users WHERE user_id = {$user_id}";
        if(mysqli_query($connection, $delete)){
            header('Location: http://localhost:8888/cms/admin/users.php?showmsg=deleted');
        } else {
            header('Location: http://localhost:8888/cms/admin/users.php?showmsg=notdeleted');
        }
    } 
    } else {
        showMsg('Oops! No user id in url!', 'danger');
    }
}

function addUser(){
    global $connection;
    
    //echo "in add user";
    
    if(isset($_POST['create_user'])){
        $username = mysqli_real_escape_string($connection,$_POST['username']);
        $user_firstname = mysqli_real_escape_string($connection,$_POST['user_firstname']);
        $user_lastname = mysqli_real_escape_string($connection,$_POST['user_lastname']);

        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        $user_email = mysqli_real_escape_string($connection,$_POST['user_email']);
        $user_password = mysqli_real_escape_string($connection,$_POST['user_password']);
        $user_role = mysqli_real_escape_string($connection,$_POST['user_role']);

        //move uploaded file to server
        move_uploaded_file($user_image_temp, "../images/$user_image");

        //insert user
        $insert_user = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role, created_date) ";
        $insert_user .= "VALUES ('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_image}', '{$user_role}', now())";

        $insert_user_query = mysqli_query($connection, $insert_user);
        if($insert_user_query){
            header('Location: http://localhost:8888/cms/admin/users.php?showmsg=created');
            //showMsg('User Successfully created!','success');
        } else {
            header('Location: http://localhost:8888/cms/admin/users.php?showmsg=notcreated');
            //showMsg("Problem creating new user!".mysqli_error($connection),'danger');
        }

    }
}

function editUser(){
    global $connection;
    
    if(isset($_POST['edit_user'])){
        $user_id = mysqli_real_escape_string($connection,$_POST['user_id']);
        $username = mysqli_real_escape_string($connection,$_POST['username']);
        $user_firstname = mysqli_real_escape_string($connection,$_POST['user_firstname']);
        $user_lastname = mysqli_real_escape_string($connection,$_POST['user_lastname']);

        $user_image = $_FILES['user_image']['name'];
        $user_current_image = mysqli_real_escape_string($connection, $_POST['user_current_image']);
        if($user_image != '' && !empty($user_image)){
            $user_image_temp = $_FILES['user_image']['tmp_name']; 
            //move uploaded file to server
            move_uploaded_file($user_image_temp, "../images/$user_image");
        }

        $user_email = mysqli_real_escape_string($connection,$_POST['user_email']);
        $user_password = mysqli_real_escape_string($connection,$_POST['user_password']);
        $user_role = mysqli_real_escape_string($connection,$_POST['user_role']);

        //insert user
        $update_user = "UPDATE users SET username = '{$username}', user_firstname = '{$user_firstname}', ";
        $update_user .= "user_lastname = '{$user_lastname}', user_email = '{$user_email}', ";
        if($user_image != '' && !empty($user_image)){
            $update_user .= "user_image = '{$user_image}', ";
        }
        if(!empty($user_role)){
            $update_user .= "user_role = '{$user_role}', ";
        }
        $update_user .= "user_password = '{$user_password}' ";
        $update_user .= "WHERE user_id = {$user_id}";

        $update_user_query = mysqli_query($connection, $update_user);
        if($update_user_query){
            if($_SESSION['user_role'] == 'admin'){
                header('Location: http://localhost:8888/cms/admin/users.php?showmsg=updated');
            } else {
                header('Location: http://localhost:8888/cms/admin?showmsg=profileupdated');
            }
            //showMsg('User Successfully updated!','success');
        } else {
            header('Location: http://localhost:8888/cms/admin/users.php?showmsg=notupdated');
            //showMsg("Problem updating user!".mysqli_error($connection),'danger');
        }

    }
}

function getUserID(){
    global $connection;
    $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
    if(!empty($user_id)){
        return $user_id;
    } 
    return '';
}

if(!empty($_GET['action'])){
    $action = mysqli_real_escape_string($connection, $_GET['action']);
    
    switch($action){
            case "delete_user": deleteUser(getUserID());
                    break;
            case "add_user": include "includes/add_user.php";
                    break;
            case "edit_user": include "includes/edit_user.php";
                    break;
            case "add_user_action": addUser();
                    break;
            case "edit_user_action": editUser();
                    break;
            default: //nothing to do
                break;
    }
} else {
    showMsg('Something is not right, user action is missing!','danger');
}

?>