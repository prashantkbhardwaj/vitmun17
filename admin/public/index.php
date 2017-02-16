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
    if ($name_title['type']==2) {
        redirect_to("index_del_affairs.php");
    }
?>
<?php
    $count_query = "SELECT COUNT(id) FROM eb_apps";
    $count_result = mysqli_query($conn, $count_query);
    $count_eb = mysqli_fetch_array($count_result);
    $total_eb = $count_eb[0];  

    $count_query_del = "SELECT COUNT(id) FROM delegates";
    $count_result_del = mysqli_query($conn, $count_query_del);
    $count_del = mysqli_fetch_array($count_result_del);
    $total_del = $count_del[0];  

    $count_query_del_ext = "SELECT COUNT(id) FROM delegates WHERE in_out = 1";
    $count_result_del_ext = mysqli_query($conn, $count_query_del_ext);
    $count_del_ext = mysqli_fetch_array($count_result_del_ext);
    $total_del_ext = $count_del_ext[0];  
?>
<?php
    $count_hotel_query = "SELECT COUNT(id) FROM eb_apps WHERE hotel = 'Yes'";
    $count_hotel_result = mysqli_query($conn, $count_hotel_query);
    $count_hotel_eb = mysqli_fetch_array($count_hotel_result);
    $total_hotel_eb = $count_hotel_eb[0];  

    $count_hotel_query_del = "SELECT COUNT(id) FROM delegates WHERE hotel = 'Yes'";
    $count_hotel_result_del = mysqli_query($conn, $count_hotel_query_del);
    $count_hotel_del = mysqli_fetch_array($count_hotel_result_del);
    $total_hotel_del = $count_hotel_del[0];  

    $total_hotel = $total_hotel_eb + $total_hotel_del;
?>
<?php
    $money_query = "SELECT COUNT(id) FROM delegates WHERE allot = 1 AND pay_status = 1";
    $money_result = mysqli_query($conn, $money_query);
    $money_list = mysqli_fetch_array($money_result);
    $money_ar = $money_list[0];
    $total_money = $money_ar*1300;
?>
<?php
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
    confirm_query($result);    
?>
<?php
    $agenda_query = "SELECT * FROM councils WHERE agenda = ''";
    $agenda_result = mysqli_query($conn, $agenda_query);
    confirm_query($agenda_result);
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
                <a class="navbar-brand" href="index.php"><span><img src="../../img/small_logo.png" width="15%" height="120%"></span> VITCMUN 2017</a>
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
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="del.php"><i class="fa fa-fw fa-file-text"></i> Delegates</a>
                    </li>
                    <li>
                        <a href="eb.php"><i class="fa fa-fw fa-black-tie"></i> Executive Board</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#council"><i class="fa fa-fw fa-bank"></i> Councils <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="council" class="collapse">
                            <li>
                                <a href="council.php?eb_id=c1">UNSC</a>
                            </li>
                            <li>
                                <a href="council.php?eb_id=c2">UNGA DISEC</a>
                            </li>
                            <li>
                                <a href="council.php?eb_id=c3">UNHRC</a>
                            </li>
                            <li>
                                <a href="council.php?eb_id=c4">IAEA</a>
                            </li>
                            <li>
                                <a href="council.php?eb_id=c5">OSCE</a>
                            </li>
                            <li>
                                <a href="council.php?eb_id=c6">TLC</a>
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
                                        <i class="fa fa-money fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><i class="fa fa-inr"></i> <?php echo $total_money; ?></div>
                                        <div>Amount from delegates</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
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
                                        <i class="fa fa-hotel fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $total_hotel; ?></div>
                                        <div>Accomodations required</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
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
                <?php
                    while ($agenda_list = mysqli_fetch_assoc($agenda_result)) { ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-info alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="fa fa-info-circle"></i>  <?php echo "Agenda for ".$agenda_list['name']." not entered. Click <a href='council.php?eb_id=00".$agenda_list['id']."'><strong>here</strong></a> to update it."; ?>
                                </div>
                            </div>
                        </div>    
                        <?php
                    }
                ?>
                            
                <div class="row" id="admins">
                    <div class="col-lg-12">
                        <center><h2>Admin List</h2></center>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Admin Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    while ($title_admin = mysqli_fetch_assoc($result)) { ?>
                                       <tr>
                                            <td><?php echo $title_admin['username']; ?></td>
                                            <td>
                                                <?php
                                                    if ($title_admin['type']==1) {
                                                        echo "Payment Admin";
                                                    } elseif ($title_admin['type']==2) {
                                                        echo "Delegate affairs";
                                                    } elseif ($title_admin['type']==3) {
                                                        echo "Hospitality";
                                                    } elseif ($title_admin['type']==4) {
                                                        echo "Super Admin";
                                                    } elseif ($title_admin['type']==5) {
                                                        echo "Viewer Admin";
                                                    }                                                        
                                                ?>
                                                
                                            </td>
                                        </tr>  
                                        <?php 
                                    }
                                ?>                                      
                                </tbody>
                                
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