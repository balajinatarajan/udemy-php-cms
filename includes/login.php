<?php include "db.php"; ?>
<?php
if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $password = mysqli_real_escape_string($connection,$_POST['password']);
    if(!empty($username) && !empty($password)){
        $login_qs = "SELECT * FROM users WHERE username = '{$username}' AND user_password = '{$password}'";
        $login_q = mysqli_query($connection, $login_qs);
        if($login_q && mysqli_num_rows($login_q) > 0){
            $row = mysqli_fetch_assoc($login_q);
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_role = $row['user_role'];
            $user_id = $row['user_id'];
            $user_status = $row['user_status'];
            
            if($user_status == 'pending'){
                header('Location: http://localhost:8888/cms?showmsg=userpending');
            } else {
                //echo "Login successful";
                session_start();
                $_SESSION["username"] = $username;
                $_SESSION["user_firstname"] = $user_firstname;
                $_SESSION["user_lastname"] = $user_lastname;
                $_SESSION["user_role"] = $user_role;
                $_SESSION["user_id"] = $user_id;

                if($user_role == 'subscriber'){
                    header('Location: http://localhost:8888/cms?showmsg=subloginsuccess');
                } else {
                    header('Location: http://localhost:8888/cms/admin');   
                }   
            }
            
        } else {
            //echo "Login failed";
            header('Location: http://localhost:8888/cms?showmsg=loginfailed');
        }
    } else {
        header('Location: http://localhost:8888/cms');
    }
}
?>