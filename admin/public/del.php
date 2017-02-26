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
        $index_link = "_del_affairs";
        $executive_view = "style='display:none;'";
    } else {
        $index_link = "";
        $executive_view = "";
    }
?>
<?php
    $query = "SELECT * FROM delegates WHERE allot = 0 AND id < 510 ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    confirm_query($result); 

    $query1 = "SELECT * FROM delegates WHERE allot = 0 AND id >= 510 ORDER BY id DESC";
    $result1 = mysqli_query($conn, $query1);
    confirm_query($result1); 

    $reject_query = "SELECT * FROM delegates WHERE allot = 2 ORDER BY id DESC";
    $reject_result = mysqli_query($conn, $reject_query);
    confirm_query($reject_result);    
?>
<?php
    $accept_query = "SELECT * FROM delegates WHERE allot = 1 ORDER BY id DESC";
    $accept_result = mysqli_query($conn, $accept_query);
    confirm_query($accept_result); 

    $paid_query = "SELECT * FROM delegates WHERE allot = 1 AND pay_status = 1 ORDER BY id DESC";
    $paid_result = mysqli_query($conn, $paid_query);
    confirm_query($paid_result);

    $paid_count_query = "SELECT COUNT(id) FROM delegates WHERE allot = 1 AND pay_status = 1 ORDER BY id DESC";
    $paid_count_result = mysqli_query($conn, $paid_count_query);
    confirm_query($paid_count_result);
    $count_paid_del = mysqli_fetch_array($paid_count_result);
    $total_del_paid = $count_paid_del[0]; 

    $unpaid_query = "SELECT * FROM delegates WHERE allot = 1 AND pay_status = 0 ORDER BY id DESC";
    $unpaid_result = mysqli_query($conn, $unpaid_query);
    confirm_query($unpaid_result);    

    $unpaid_count_query = "SELECT COUNT(id) FROM delegates WHERE allot = 1 AND pay_status = 0 ORDER BY id DESC";
    $unpaid_count_result = mysqli_query($conn, $unpaid_count_query);
    confirm_query($unpaid_count_result);
    $count_unpaid_del = mysqli_fetch_array($unpaid_count_result);
    $total_del_unpaid = $count_unpaid_del[0]; 
?>
<?php
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
    } else {
        $status = "0";
    }
    if ($status == 1) {
        $view_note = "";
        $acct_note = '<span>Application accepted and email sent.</span>';
        $color_ext = "";
    } elseif ($status == 2) {
        $view_note = "";
        $acct_note = '<span style="color:red;">Application rejected and email sent.</span>';
        $color_ext = "";
    } elseif ($status == 3) {
        $view_note = "";
        $acct_note = '<span>Applicants listed in red are external applicants.</span>';
        $color_ext = "style='color:red;'";
    } else {
        $view_note = "style='display:none;'";
        $acct_note = "";
        $color_ext = "";
    }
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
                <a class="navbar-brand" href="index<?php echo $index_link; ?>.php"><span><img src="../../img/small_logo.png" width="15%" height="120%"></span> VITCMUN 2017</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="logout.php" class="dropdown-toggle"><i class="fa fa-sign-out"></i> </a>
                </li>                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo htmlentities($first_name[0]); ?> </a>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index<?php echo $index_link; ?>.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="del.php"><i class="fa fa-fw fa-file-text"></i> Delegates</a>
                    </li>
                    <li <?php echo $executive_view; ?> >
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
                            Delegates <small>Applications and profiles</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-info-circle"></i> Click on the applicant's name to view his/her profile. 
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <a href="../../media/delegates_round2.xlsx">
                            <button class="btn btn-primary">Download the excel sheet for second round of delegate applications.</button>
                        </a>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col-lg-6 text-center">
                        
                        <button class="btn btn-success" data-toggle="modal" data-target="#paid" >
                            <i class="fa fa-check-square"></i> List of paid delegates
                        </button>
                        
                    </div>
                    <div class="col-lg-6 text-center">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#unpaid" >
                            <i class="fa fa-close"></i> List of unpaid delegates
                        </button>
                    </div>
                </div><br><hr>
                <!-- /.row -->    
                <div <?php echo $view_note; ?> class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong><?php echo $acct_note; ?></strong> 
                        </div>
                    </div>
                </div>

               <div class="row">
                    <div class="col-lg-6">
                        <div class="list-group">                            
                            <a href="#" class="list-group-item active"><i class="fa fa-hourglass-start"></i> Applied for round 2</a>
                            <?php
                                while ($title = mysqli_fetch_assoc($result)) { ?>
                                    <a class="list-group-item text-center" href="del_profile.php?del_id=<?php echo urlencode($title['id']); ?>">
                                        <span <?php if ($title['in_out']==1) { echo $color_ext; } ?>><?php echo $title['name']; ?></span>
                                    </a>
                                    <?php
                                }
                            ?>      
                        </div>                       
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="list-group">                            
                            <a href="#" class="list-group-item active"><i class="fa fa-hourglass-start"></i> Applied for round 3</a>
                            <?php
                                while ($title1 = mysqli_fetch_assoc($result1)) { ?>
                                    <a class="list-group-item text-center" href="del_profile.php?del_id=<?php echo urlencode($title1['id']); ?>">
                                        <span <?php if ($title1['in_out']==1) { echo $color_ext; } ?>><?php echo $title1['name']; ?></span>
                                    </a>
                                    <?php
                                }
                            ?>      
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-lg-12" id="allot">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center"><i class="fa fa-check-square"></i> Accepted</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responisve">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Alloted Council</th>
                                                    <th>Alloted Country</th>
                                                    <th>Alloted By</th>
                                                    <th>Payment Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php
                                            while ($title_accept = mysqli_fetch_assoc($accept_result)) { ?>
                                                <tr>
                                                    <td>
                                                        <a href="del_profile.php?del_id=<?php echo urlencode($title_accept['id']); ?>">
                                                            <span <?php if ($title_accept['in_out']==1) { echo $color_ext; } ?> ><?php echo $title_accept['name']; ?></span>
                                                        </a>
                                                    </td>
                                                    <td><a href="council.php?eb_id=<?php echo urlencode($title_accept['id'].'_d'); ?>"><?php echo $title_accept['allot_council']; ?></a></td>
                                                    <td><a href="del_profile.php?del_id=<?php echo urlencode($title_accept['id']); ?>"><?php echo $title_accept['allot_country']; ?></a></td>
                                                    <td><a href="index.php#admins"><?php echo $title_accept['action_by']; ?></a></td>
                                                    <td>
                                                        <?php
                                                            if ($title_accept['pay_status']==1) {
                                                                echo "<span style='color:green;'>Paid</span>";
                                                            } else {
                                                                echo "<span style='color:red;'>Not Paid</span>";
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
    <div class="modal fade" id="paid" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-check-square"></i> List of paid delegates</h4>
                </div>
                <div class="modal-body">
                    <p>                            
                        <div class="table-responisve">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Alloted Council</th>
                                        <th>Alloted Country</th>
                                        <th>Phone Number</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                while ($title_paid = mysqli_fetch_assoc($paid_result)) { ?>
                                    <tr>
                                        <td>
                                            <a href="del_profile.php?del_id=<?php echo urlencode($title_paid['id']); ?>">
                                                <span <?php if ($title_paid['in_out']==1) { echo $color_ext; } ?> ><?php echo $title_paid['name']; ?></span>
                                            </a>
                                        </td>
                                        <td><a href="council.php?eb_id=<?php echo urlencode($title_paid['id'].'_d'); ?>"><?php echo $title_paid['allot_council']; ?></a></td>
                                        <td><a href="del_profile.php?del_id=<?php echo urlencode($title_paid['id']); ?>"><?php echo $title_paid['allot_country']; ?></a></td>
                                        <td><?php echo $title_paid['phno']; ?></td>
                                        <td>
                                            <?php
                                                if ($title_paid['pay_status']==1) {
                                                    echo "<span style='color:green;'>Paid</span>";
                                                } else {
                                                    echo "<span style='color:red;'>Not Paid</span>";
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
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>          
        </div>
    </div>

    <div class="modal fade" id="unpaid" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-close"></i> List of unpaid delegates</h4>
                </div>
                <div class="modal-body">
                    <p>                            
                        <div class="table-responisve">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Alloted Council</th>
                                        <th>Alloted Country</th>
                                        <th>Phone Number</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                while ($title_unpaid = mysqli_fetch_assoc($unpaid_result)) { ?>
                                    <tr>
                                        <td>
                                            <a href="del_profile.php?del_id=<?php echo urlencode($title_unpaid['id']); ?>">
                                                <span <?php if ($title_unpaid['in_out']==1) { echo $color_ext; } ?> ><?php echo $title_unpaid['name']; ?></span>
                                            </a>
                                        </td>
                                        <td><a href="council.php?eb_id=<?php echo urlencode($title_unpaid['id'].'_d'); ?>"><?php echo $title_unpaid['allot_council']; ?></a></td>
                                        <td><a href="del_profile.php?del_id=<?php echo urlencode($title_unpaid['id']); ?>"><?php echo $title_unpaid['allot_country']; ?></a></td>
                                        <td><?php echo $title_unpaid['phno']; ?></td>
                                        <td>
                                            <?php
                                                if ($title_unpaid['pay_status']==1) {
                                                    echo "<span style='color:green;'>Paid</span>";
                                                } else {
                                                    echo "<span style='color:red;'>Not Paid</span>";
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
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>          
        </div>
    </div>
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