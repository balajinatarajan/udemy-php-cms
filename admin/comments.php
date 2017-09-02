<?php include "includes/admin_header.php"?>

    <div id="wrapper">

        <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Comments
                            <small>Hello <?php echo $_SESSION['username'];?>!</small>
                        </h1>
                        
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="admin-index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View All Comments
                            </li>
                        </ol>
                        
                        <div class="col-xs-12">
                            <?php
                                $route = '';
                                if(isset($_GET['route'])){
                                    $route = $_GET['route'];    
                                }
                                switch($route){
                                    case 'updatecomment': include "includes/comment_action.php";
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