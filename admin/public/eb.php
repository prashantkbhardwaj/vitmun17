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
    $query = "SELECT * FROM eb_apps WHERE allot = 0 ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    confirm_query($result);    
?>
<?php
    $accept_query = "SELECT * FROM eb_apps WHERE allot = 1 ORDER BY id DESC";
    $accept_result = mysqli_query($conn, $accept_query);
    confirm_query($accept_result);    
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
    } elseif ($status == 2) {
        $view_note = "";
        $acct_note = '<span style="color:red;">Application rejected and email sent.</span>';
    } else {
        $view_note = "style='display:none;'";
        $acct_note = "";
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
                <a class="navbar-brand" href="index.php"><span><img src="../../img/small_logo.png" width="15%" height="120%"></span> VITCMUN 2017</a>
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
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-file-text"></i> Delegates</a>
                    </li>
                    <li class="active">
                        <a href="eb.php"><i class="fa fa-fw fa-black-tie"></i> Executive Board</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#council"><i class="fa fa-fw fa-bank"></i> Councils <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="council" class="collapse">
                            <li>
                                <a href="council.php?eb_id=001">UNGA SC</a>
                            </li>
                            <li>
                                <a href="council.php?eb_id=002">UNGA DISEC</a>
                            </li>
                            <li>
                                <a href="council.php?eb_id=003">UN HRC</a>
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
                            Executive Board <small>Applications and profiles</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-info-circle"></i> Click on the applicant's name to view his/her profile. 
                            </li>
                        </ol>
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
                    <div class="col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-hourglass-start"></i> Applied</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responisve">
                                    <table class="table table-bordered table-hover table-striped">
                                    <?php
                                        while ($title = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><a href="eb_profile.php?eb_id=<?php echo urlencode($title['id']); ?>"><?php echo $title['name']; ?></a></td>
                                            </tr>  
                                            <?php
                                        }
                                    ?>                                                      
                                    </table>                                       
                                </div>
                            </div>
                        </div>                       
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-check-square"></i> Accepted</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responisve">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Alloted Council</th>
                                                <th>Alloted Post</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                        while ($title_accept = mysqli_fetch_assoc($accept_result)) { ?>
                                            <tr>
                                                <td><a href="eb_profile.php?eb_id=<?php echo urlencode($title_accept['id']); ?>"><?php echo $title_accept['name']; ?></a></td>
                                                <td><a href="council.php?eb_id=<?php echo urlencode($title_accept['id']); ?>"><?php echo $title_accept['allot_council']; ?></a></td>
                                                <td><a href="eb_profile.php?eb_id=<?php echo urlencode($title_accept['id']); ?>"><?php echo $title_accept['allot_post']; ?></a></td>
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