<?php include "includes/admin_header.php"?>
<?php include "functions.php"?>

    <div id="wrapper">

        <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Dashboard
                            <small>Hello admin!</small>
                        </h1>
                        
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View All Comments
                            </li>
                        </ol>
                        
                        <div class="col-xs-12">
                            <?php
                                $action = '';
                                if(isset($_GET['action'])){
                                    $action = $_GET['action'];    
                                }
                                switch($action){
                                    case 'add_post': include "includes/add_post.php";
                                        break;
                                    case 'add_post_action': include "includes/add_post_action.php";
                                        break;
                                    case 'edit_post': include "includes/edit_post.php";
                                        break;
                                    case 'edit_post_action': include "includes/edit_post_action.php";
                                        break;
                                    case 'delete_comment': include "includes/delete_post.php";
                                        break;
                                    default: include "includes/view_all_comments.php";
                                        break;
                                }
                            ?>
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