<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
    $current_user = $_SESSION["username"];
    $name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
    $name_result = mysqli_query($conn, $name_query);
    confirm_query($name_result);
    $name_title = mysqli_fetch_assoc($name_result);
    $first_name = explode(" ", $name_title['username']);
?>
<?php
    $count_query_del = "SELECT COUNT(id) FROM delegates";
    $count_result_del = mysqli_query($conn, $count_query_del);
    $count_del = mysqli_fetch_array($count_result_del);
    $total_del = $count_del[0];  

    $count_query_del_ext = "SELECT COUNT(id) FROM delegates WHERE in_out = 1";
    $count_result_del_ext = mysqli_query($conn, $count_query_del_ext);
    $count_del_ext = mysqli_fetch_array($count_result_del_ext);
    $total_del_ext = $count_del_ext[0];  

    $count_query_del_allot = "SELECT COUNT(id) FROM delegates WHERE allot = 1";
    $count_result_del_allot = mysqli_query($conn, $count_query_del_allot);
    $count_del_allot = mysqli_fetch_array($count_result_del_allot);
    $total_del_allot = $count_del_allot[0];  
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Prashant Bhardwaj">

    <title>VITC MUN | Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index_del_affairs.php"><span><img src="../../img/small_logo.png" width="15%" height="120%"></span> VITCMUN 2017</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="logout.php" class="dropdown-toggle" ><i class="fa fa-sign-out"></i> </a>
                </li>                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo htmlentities($first_name[0]); ?> </a>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index_del_affairs.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="del.php"><i class="fa fa-fw fa-file-text"></i> Delegates</a>
                    </li>                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#council"><i class="fa fa-fw fa-bank"></i> Councils <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="council" class="collapse">
                            <li>
                                <a href="council.php?eb_id=001">UNSC</a>
                            </li>
                            <li>
                                <a href="council.php?eb_id=002">UNGA DISEC</a>
                            </li>
                            <li>
                                <a href="council.php?eb_id=003">UNHRC</a>
                            </li>
                            <li>
                                <a href="council.php?eb_id=004">IAEA</a>
                            </li>
                            <li>
                                <a href="council.php?eb_id=005">OSCE</a>
                            </li>
                            <li>
                                <a href="council.php?eb_id=006">TLC</a>
                            </li>
                        </ul>
                    </li>                             
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-info-circle"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->            

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $total_del; ?></div>
                                        <div>Delegate applications</div>
                                    </div>
                                </div>
                            </div>
                            <a href="del.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-black-tie fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $total_del_ext; ?></div>
                                        <div>External delegates</div>
                                    </div>
                                </div>
                            </div>
                            <a href="del.php?status=3">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-check-square fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> <?php echo $total_del_allot; ?></div>
                                        <div>Allotted delegates</div>
                                    </div>
                                </div>
                            </div>
                            <a href="del.php#allot">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-money fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">0</div>
                                        <div>Paid delegates</div>
                                    </div>
                                </div>
                            </div>
                            <a href="del.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->                   
                <div class="row"><br><hr>
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center"><i class="fa fa-info-circle"></i>&nbsp;&nbsp; For any type of technical assitance</h3>
                            </div>
                            <div class="panel-body">
                                <strong>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            Please email to
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="mailto:prashant.bhardwaj2014@vit.ac.in?Subject=Need%20of%20technical%20assitance%20from%20delegate%20affairs" target="_top"><i class="fa fa-envelope"></i> prashant.bhardwaj2014@vit.ac.in</a>
                                            or <a href="mailto:vitcmun2017@gmail.com?Subject=Need%20of%20technical%20assitance%20from%20delegate%20affairs" target="_top"><i class="fa fa-envelope"></i> vitcmun2017@gmail.com</a>
                                        </div>
                                    </div><hr>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            You can call on 
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="tel:+91-9962416408"><i class="fa fa-phone"></i> +91-9962416408</a>
                                            or <a href="tel:+91-8789925369"><i class="fa fa-phone"></i> +91-8789925369</a>
                                        </div>
                                    </div>                                   
                                </strong>
                            </div>
                        </div>                       
                    </div>
                </div>  <br><br>             

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
<?php
if (isset ($conn)){
    mysqli_close($conn);
}