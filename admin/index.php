<?php include "includes/admin_header.php"?>

    <div id="wrapper">

        <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Dashboard
                            <small>Hello <?php echo $_SESSION['username'];?>!</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <?php
                if(!empty($_GET['showmsg'])){
                    switch($_GET['showmsg']){
                        case "profileupdated": showMsgDis('Your profile is updated successfully!','success');
                            break;
                        default: //nothing to do
                            break;
                    }
                }
                ?> 

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>