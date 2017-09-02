<?php
//pages - roles map

$access['adminui'] = ['author','admin'];
$access['posts_crud'] = ['author','admin'];
$access['posts_view'] = ['author','admin'];
$access['cat_view'] = ['admin'];
$access['cat_crud'] = ['admin'];
$access['users_crud'] = ['admin'];
$access['users_view'] = ['admin'];
$access['users_role'] = ['admin'];
$access['dashboard'] = ['author','admin'];
$access['comments_mod'] = ['author','admin'];
$access['comments'] = ['author','admin','subscriber'];

function has_access($pageid){
    global $access;
    //echo $_SESSION['user_role'];
    //echo print_r($access[$pageid]);
    
    if(!empty($_SESSION['user_role'])){
        if(!empty($access[$pageid])){
            foreach($access[$pageid] as $roles_allowed){
                if($_SESSION['user_role'] == $roles_allowed){
                    return true;
                }
            }
        }
    }
    return false;
}


?>