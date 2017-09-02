<?php include "includes/admin_header.php"?>

    <div id="wrapper">

        <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Categories
                            <small>Hello <?php echo $_SESSION['username'];?>!</small>
                        </h1>
                        
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Categories
                            </li>
                        </ol>
                        
                         <div class="col-xs-6">
                           <?php
                             if(isset($_POST['submit'])){
                                 $cat_title = $_POST['cat_title'];
                                 addCategory($cat_title);
                             }
                             
                             //handle delete
                             if(isset($_GET['delete'])){
                                 $cat_id = $_GET['delete'];
                                 deleteCategory($cat_id);
                             }
                             
                             //handle update
                             if(isset($_POST['updatecat'])){
                                 //echo 'update request received';
                                 $cat_title_upd = $_POST['update_cat_title'];
                                 $cat_title_upd = mysqli_real_escape_string($connection, $cat_title_upd);
                                 
                                 $cat_id_upd = $_POST['cat_id_upd'];
                                 $cat_id_upd = mysqli_real_escape_string($connection, $cat_id_upd);
                                 
                                 updateCategory($cat_id_upd,$cat_title_upd);
                             }
                             ?>
                            <form action="" method="post">
                                <div class="form-group"><input type="text" class="form-control" placeholder="Enter Category Name" name="cat_title"></div>
                                <div class="form-group"><input type="submit" name="submit" class="btn btn-primary"></div>
                            </form>
                        </div>
                        
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                        <?php
                            $cat_query = "SELECT * FROM categories";
                            $cat_result = mysqli_query($connection, $cat_query);
                            while($row = mysqli_fetch_assoc($cat_result)){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                                ?>
                                <tr>
                                    <td><?php echo $cat_id;?></td>
                                    <?php 
                                    if(isset($_GET['edit']) && $_GET['edit'] == $cat_id && !isset($_GET['reset'])){
                                        ?>
                                        <td>
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <input type="hidden" name="cat_id_upd" value="<?php echo $cat_id;?>">
                                                    <input type="text" name="update_cat_title" value="<?php echo $cat_title?>" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" name="updatecat" class="btn btn-primary">
                                                    &nbsp;&nbsp;<a href="categories.php">Discard</a>
                                                </div>
                                            </form>
                                        </td>
                                        <?php
                                        
                                    } else {?>
                                       <td><?php echo $cat_title;?></td>
                                        <?php
                                    }
                                    ?>
                                    <td><a href="categories.php?delete=<?php echo $cat_id?>">Delete</a></td>
                                    <td><a href="categories.php?edit=<?php echo $cat_id?>">Edit</a></td>
                                </tr>
                                <?php
                            }
                        ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>