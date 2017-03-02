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
    if ($user_type==4||$current_user=="tanmay") {
        $perm_view = "";
    } else {
        $perm_view = "style='display:none;'";
    }
?>
<?php
    $query_eb = "SELECT * FROM eb_apps WHERE hotel = 'Yes' AND allot = 1 ORDER BY id DESC";
    $result_eb = mysqli_query($conn, $query_eb);
    confirm_query($result_eb); 

    $query_eb_count = "SELECT COUNT(id) FROM eb_apps WHERE hotel = 'Yes' AND allot_hotel = 1 ORDER BY id DESC";
    $result_eb_count = mysqli_query($conn, $query_eb_count);
    confirm_query($result_eb_count); 
    $count_eb = mysqli_fetch_array($result_eb_count);
    $total_eb = $count_eb[0];  

    $query_del = "SELECT * FROM delegates WHERE hotel = 'Yes' AND allot = 1 AND pay_status = 1 ORDER BY id DESC";
    $result_del = mysqli_query($conn, $query_del);
    confirm_query($result_del); 

    $query_del_count = "SELECT COUNT(id) FROM delegates WHERE hotel = 'Yes' AND allot_hotel = 1 ORDER BY id DESC";
    $result_del_count = mysqli_query($conn, $query_del_count);
    confirm_query($result_del_count); 
    $count_del = mysqli_fetch_array($result_del_count);
    $total_del = $count_del[0];  

    $left = 75 - ($total_del+$total_eb);
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
                            Accomodations <small>Applications and allotments</small>
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
                        <h1><?php echo $left; ?> seats left</h1>
                    </div>
                </div>
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
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center"><i class="fa fa-black-tie"></i> Executive Board</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responisve">
                                    <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Council</th>
                                            <th>Post</th>
                                            <th>Phone Number</th>
                                            <th>Status</th>                                            
                                            <th>Action</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        while ($eb_list = mysqli_fetch_assoc($result_eb)) { ?>
                                            <tr>
                                                <td>
                                                    <a href="del_profile.php?del_id=<?php echo urlencode($eb_list['id']); ?>">
                                                        <?php echo $eb_list['name']; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="council.php?eb_id=<?php echo urlencode($eb_list['id']); ?>">
                                                        <?php echo $eb_list['allot_council']; ?>                  
                                                    </a>
                                                </td>
                                                <td><?php echo $eb_list['allot_post']; ?></td>
                                                <td><?php echo $eb_list['phno']; ?></td>
                                                <td>
                                                    <?php
                                                        if ($eb_list['allot_hotel']==1) { ?>
                                                            <span style="color:green;">Allotted</span>
                                                            <?php
                                                        } else { ?>
                                                            <span style="color:red;">Not allotted</span>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>                                                
                                                <td>
                                                    <?php
                                                        if ($eb_list['allot_hotel']==0) { ?>
                                                            <a onclick="return confirm('Are you sure you want to accept this application?');" href="eb_hotel_mail.php?eb_id=<?php echo urlencode($eb_list['id']); ?>">
                                                                Allot
                                                            </a>
                                                            <?php
                                                        } else {

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
                    
                    <div class="row">
                        <div class="col-lg-12" id="allot">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center"><i class="fa fa-user"></i> Delegates</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responisve">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Council</th>
                                                    <th>Country</th>
                                                    <th>Current Residence</th>
                                                    <th>College</th>
                                                    <th>Status</th>                                                    
                                                    <th>Action</th>  
                                                    <th>Payment</th>
                                                    <th <?php echo $perm_view; ?>>Pay</th>                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php
                                            while ($del_list = mysqli_fetch_assoc($result_del)) { ?>
                                                <tr>
                                                    <td>
                                                        <a href="del_profile.php?del_id=<?php echo urlencode($del_list['id']); ?>">
                                                            <?php echo $del_list['name']; ?>
                                                        </a>
                                                    </td>
                                                    <td><a href="council.php?eb_id=<?php echo urlencode($del_list['id'].'_d'); ?>"><?php echo $del_list['allot_council']; ?></a></td>
                                                    <td><?php echo $del_list['allot_country']; ?></td>
                                                    <td><?php echo $del_list['hometown']; ?></td>
                                                    <td><?php echo $del_list['school']; ?></td>
                                                    <td>
                                                        <?php
                                                            if ($del_list['allot_hotel']==1) { ?>
                                                                <span style="color:green;">Allotted</span>
                                                                <?php
                                                            } else { ?>
                                                                <span style="color:red;">Not allotted</span>
                                                                <?php
                                                            }
                                                        ?>
                                                    </td>                                                    
                                                    <td>
                                                        <?php
                                                            if ($del_list['allot_hotel']==0) { ?>
                                                                <a href="hotel_del.php?del_id=<?php echo urlencode($del_list['id']); ?>">
                                                                    Allot
                                                                </a>
                                                                &nbsp;|&nbsp;
                                                                <a href="hotel_del.php?del_id=<?php echo urlencode($del_list['id']); ?>">
                                                                    <span style="color:red;">Reject</span>
                                                                </a>
                                                                <?php
                                                            } else {

                                                            }
                                                        ?>
                                                    </td>  
                                                    <td>
                                                        <?php
                                                            if ($del_list['hotel_pay_status']==1) {
                                                                echo "<span style='color:green;'>Paid</span>";
                                                            } else {
                                                                echo "<span style='color:red;'>Not Paid</span>";
                                                            }
                                                        ?>
                                                    </td>  
                                                    <td <?php echo $perm_view; ?>>
                                                        <a href="del_pay_off.php?del_id=<?php echo urlencode($del_list["id"]); ?>" onclick="return confirm('Are you sure?');"><?php
                                                            if ($del_list['hotel_pay_status']==0) {
                                                                echo "Pay";
                                                            } else {
                                                                
                                                            } ?>
                                                        </a>        
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