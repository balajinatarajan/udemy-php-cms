<?php include "includes/admin_header.php"?>

    <div id="wrapper">

        <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Users
                            <small>Hello <?php echo $_SESSION['username'];?>!</small>
                        </h1>
                        
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View All Users
                            </li>
                        </ol>
                        
                        <div class="col-xs-12">
                            <?php
                                $action = '';
                                if(isset($_GET['action'])){
                                    $action = $_GET['action'];  
                                    if(!empty($action)){
                                        include "includes/user_action.php";
                                    } else {
                                        include "includes/view_all_users.php";
                                    }
                                } else {
                                    include "includes/view_all_users.php";
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