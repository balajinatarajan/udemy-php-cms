<?php

function updateCategory($cat_id_upd,$cat_title_upd){
    global $connection;
    
    $update_cat = "UPDATE categories SET cat_title = '{$cat_title_upd}' WHERE cat_id = {$cat_id_upd}";
                                 
     $update_cat_query = mysqli_query($connection, $update_cat);
     if($update_cat_query){
         echo "<div class='alert alert-success'>Category Successfully Updated!</div>";
         header('Location: http://localhost:8888/cms/admin/categories.php');
     } else {
         echo "<div class='alert alert-danger'>Problem updating Category!</div>";
     }
}

function deleteCategory($cat_id){
    global $connection;
    
    $cat_id = mysqli_real_escape_string($connection, $cat_id);
     $cat_delete = "DELETE FROM categories WHERE cat_id = '{$cat_id}'";

     $cat_delete_query = mysqli_query($connection, $cat_delete);
     if($cat_delete_query){
         echo "<div class='alert alert-success'>Category Successfully Deleted!</div>";
     } else {
         echo "<div class='alert alert-danger'>Category does not exists or there is some problem deleting category!</div>";
     }
}

function addCategory($cat_title){
    global $connection;
    
    if(empty($cat_title) || $cat_title == ""){
         echo "<div class='alert alert-danger'>Category Name cannot be empty!</div>";
     } else {
         $cat_title = mysqli_real_escape_string($connection, $cat_title);
         //check if category already exists
         $cat_select = "SELECT * FROM categories WHERE cat_title = '{$cat_title}'";
         $cat_select_query = mysqli_query($connection, $cat_select);
         if(mysqli_num_rows($cat_select_query) > 0){
             echo "<div class='alert alert-danger'>Category Name already exists!</div>";
         } else {
             //insert category
             $cat_insert = "INSERT INTO categories(cat_title) VALUE ('$cat_title')";
             $cat_insert_query = mysqli_query($connection, $cat_insert);

             if($cat_insert_query){
                 echo "<div class='alert alert-success'>Category Successfully added!</div>";
             } else {
                 echo "<div class='alert alert-danger'>Problem adding category!</div>";
             }
         }
     }
}

function printColumns($cols){
    $rowString = '';
    foreach($cols as $col){
        $rowString .= "<td>{$col}</td>";
    }
    return $rowString;
}

?>