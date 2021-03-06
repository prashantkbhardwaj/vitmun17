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
    $user_type = $name_title['type'];

    if ($user_type==4) {
        $view_fill = "";
        $view_notFill = "style='display:none;'>";
    } else {
        $view_fill = "style='display:none;'>";
        $view_notFill = "";
    }
    if ($name_title['type']==2) {
        $index_link = "_del_affairs";
        $executive_view = "style='display:none;'";
    } else {
        $index_link = "";
        $executive_view = "";
    }
    if ($user_type==4||$current_user=="akanksha"||$current_user=="tanmay") {
        $perm_view = "";
    } else {
        $perm_view = "style='display:none;'";
    }
    $my_view = "style='display:none;'";
    

?>
<?php
    $count_query = "SELECT COUNT(id) FROM eb_apps";
    $count_result = mysqli_query($conn, $count_query);
    $count_eb = mysqli_fetch_array($count_result);
    $total_eb = $count_eb[0];  
?>
<?php
    $count_hotel_query = "SELECT COUNT(id) FROM eb_apps WHERE hotel = 'Yes'";
    $count_hotel_result = mysqli_query($conn, $count_hotel_query);
    $count_hotel_eb = mysqli_fetch_array($count_hotel_result);
    $total_hotel_eb = $count_hotel_eb[0];  
?>
<?php
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
    confirm_query($result);    
?>
<?php
    $id_get = $_GET['eb_id'];
    $e_id = explode("_", $id_get);
    if ($e_id[1]=="d") {
        $eb_id = $e_id[0];
        $council_query = "SELECT allot_council FROM delegates WHERE id = '{$eb_id}' LIMIT 1";
        $council_result = mysqli_query($conn, $council_query);
        confirm_query($council_result);
        $council_list = mysqli_fetch_assoc($council_result);        
    } else {
        $eb_id = $_GET['eb_id'];
        $council_query = "SELECT allot_council FROM eb_apps WHERE id = '{$eb_id}' LIMIT 1";
        $council_result = mysqli_query($conn, $council_query);
        confirm_query($council_result);
        $council_list = mysqli_fetch_assoc($council_result);
    }     
    if ($eb_id == "c1") {
        $council = "United Nations Security Council";
    } elseif ($eb_id == "c2") {
        $council = "United Nations General Assembly Disarmament and International Security Council";
    } elseif ($eb_id == "c3") {
        $council = "United Nations Human Rights Council";
    } elseif ($eb_id == "c4") {
        $council = "International Atomic Energy Agency";
    } elseif ($eb_id == "c5") {
        $council = "Organisation for Security and Cooperation in Europe";
    } elseif ($eb_id == "c6") {
        $council = "The Trilateral Commission";
    } else {        
        $council = $council_list['allot_council'];
    }

    if (isset($_GET['status'])) {
        $status = $_GET['status'];
    } else {
        $status = "0";
    }
    if ($status == 1) {
        $view_note = "";
        $acct_note = '<span>Payment confimed and email sent.</span>';
        $color_ext = "";
    } else {
        $view_note = "style='display:none;'";
        $acct_note = "";
        $color_ext = "";
    }
    

    $eb_query = "SELECT * FROM eb_apps WHERE allot_council = '{$council}' AND allot = 1";
    $eb_result = mysqli_query($conn, $eb_query);
    confirm_query($eb_result);

    
    if ($council =="United Nations Security Council") {
        $abb = "UNSC";
        $logo = "SC";
    } elseif ($council =="United Nations General Assembly Disarmament and International Security Council") {
        $abb = "UNGA DISEC";
        $logo = "DISEC";
    } elseif ($council =="United Nations Human Rights Council") {
        $abb = "UNHRC";
        $logo = "HRC";
    } elseif ($council =="International Atomic Energy Agency") {
        $abb = "IAEA";
        $logo = "IAEA";
    } elseif ($council =="Organisation for Security and Cooperation in Europe") {
        $abb = "OSCE";
        $logo = "OSCE";
    } elseif ($council =="The Trilateral Commission") {
        $abb = "TLC";
        $logo = "Trilateral";
    }
?>
<?php
    $agenda_query = "SELECT * FROM councils WHERE name = '{$council}' LIMIT 1";
    $agenda_result = mysqli_query($conn, $agenda_query);
    confirm_query($agenda_result);
    $agenda_list = mysqli_fetch_assoc($agenda_result);
    if ($agenda_list['agenda']=='') {
        $view_agenda = "<span style='color:red;'>Not Updated</span>, click <a href='#'' data-toggle='modal' data-target='#agendaform' >here</a> to update.";
    } else {
        $view_agenda = $agenda_list['agenda'];
    }
?>
<?php
    if (isset($_POST['submit'])) {
        $agenda_fill = mysqli_real_escape_string($conn, htmlspecialchars($_POST['agenda_fill']));
        $fill_query = "UPDATE councils SET agenda = '{$agenda_fill}' WHERE name = '{$council}'";
        $fill_result = mysqli_query($conn, $fill_query);
        confirm_query($fill_result);
        redirect_to("council.php?eb_id=$eb_id");
    }
?>
<?php
    $count_query_del_ext = "SELECT COUNT(id) FROM delegates WHERE in_out = 1 AND allot_council = '{$council}'";
    $count_result_del_ext = mysqli_query($conn, $count_query_del_ext);
    $count_del_ext = mysqli_fetch_array($count_result_del_ext);
    $total_del_ext = $count_del_ext[0];  

    $count_query_del_int = "SELECT COUNT(id) FROM delegates WHERE in_out = 0 AND allot_council = '{$council}'";
    $count_result_del_int = mysqli_query($conn, $count_query_del_int);
    $count_del_int = mysqli_fetch_array($count_result_del_int);
    $total_del_int = $count_del_int[0];  

    $del_query = "SELECT * FROM delegates WHERE allot = 1 AND allot_council = '{$council}'";
    $del_result = mysqli_query($conn, $del_query);
    confirm_query($del_result);
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
                    <a href="logout.php" class="dropdown-toggle" ><i class="fa fa-sign-out"></i> </a>
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
                    <li>
                        <a href="del.php"><i class="fa fa-fw fa-file-text"></i> Delegates</a>
                    </li>
                    <li <?php echo $executive_view; ?>>
                        <a href="eb.php"><i class="fa fa-fw fa-black-tie"></i> Executive Board</a>
                    </li>
                    <li>
                        <a href="hotel.php"><i class="fa fa-fw fa-hotel"></i> Accommodation</a>
                    </li>
                    <li class="active">
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
                            <span>
                                <img style="height:100%; width:10%;" src="../../img/<?php echo $logo; ?>_logo.png">
                            </span>
                            <?php echo $abb; ?>
                            <small><?php echo $council; ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-info-circle"></i> Agenda: <strong><?php echo $view_agenda; ?></strong>
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
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-globe fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $total_del_ext; ?></div>
                                        <div>External Delegates</div>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-home fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $total_del_int; ?></div>
                                        <div>Internal Delegates</div>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </div>                    
                </div><hr>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-black-tie"></i> Executive Board</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responisve">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Post</th>
                                                <th>Phone Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while ($eb_list = mysqli_fetch_assoc($eb_result)) { ?>
                                                    <tr>
                                                        <td><a href="eb_profile.php?eb_id=<?php echo urlencode($eb_list['id']); ?>"><?php echo $eb_list['name']; ?></a></td>
                                                        <td><?php echo $eb_list['allot_post']; ?></td>
                                                        <td><?php echo $eb_list['phno']; ?></td>
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
                    <div class="col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-video-camera"></i> International Press</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responisve">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Post</th>
                                                <th>Phone Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Prashant Kumar Bhardwaj</td>
                                                <td>Reporter</td>
                                                <td>9962416408</td>
                                            </tr>
                                            <tr>
                                                <td>Prashant Kumar Bhardwaj</td>
                                                <td>Photographer</td>
                                                <td>9962416408</td>
                                            </tr>                                            
                                        </tbody>                                                     
                                    </table>                           
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div><hr>
                <!-- /.row -->             
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading text-center">
                                <h3 class="panel-title"><i class="fa fa-users"></i> Delegates</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responisve">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Country</th>
                                                <th>Phone Number</th>                                                
                                                <th>Payment Status</th>
                                                <th <?php echo $my_view; ?> >Type</th>
                                                <th <?php echo $perm_view; ?> >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while ($del_list = mysqli_fetch_assoc($del_result)) { ?>
                                                    <tr>
                                                        <td>                                                            
                                                            <a href="del_profile.php?del_id=<?php echo urlencode($del_list['id']); ?>"><?php echo $del_list['name']; ?></a>   
                                                        </td>
                                                        <td><?php echo $del_list['allot_country']; ?></td>
                                                        <td><?php echo $del_list['phno']; ?></td>               
                                                        <td>
                                                            <?php
                                                                if ($del_list['pay_status']==1) {
                                                                    echo "<span style='color:green;'>Paid</span>";
                                                                } else {
                                                                    echo "<span style='color:red;'>Not Paid</span>";
                                                                }
                                                            ?>                            
                                                        </td>
                                                        <td <?php echo $my_view; ?> >
                                                            <?php
                                                                if ($del_list['pay_type']==1) {
                                                                    echo "online";
                                                                } elseif ($del_list['pay_type']==2) {
                                                                    echo "offline";
                                                                } elseif ($del_list['pay_type']==3) {
                                                                    echo "paytm";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td <?php echo $perm_view; ?> >
                                                            <a href="del_pay_off.php?del_id=<?php echo urlencode($del_list["id"]); ?>&page_id=<?php echo urlencode($id_get); ?>" onclick="return confirm('Are you sure?');"><?php
                                                                if ($del_list['pay_status']==0) {
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
                </div> <hr><br>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <div class="modal fade" id="agendaform" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Enter the agenda here</h4>
                </div>
                <div class="modal-body">
                    <div <?php echo $view_notFill; ?>>
                        <h3><i class="fa fa-exclamation-triangle"></i> You are not authorized to enter the agenda.</h3>
                    </div>
                    <div <?php echo $view_fill; ?>>                            
                        <form action="council.php?eb_id=<?php echo $eb_id; ?>" method="post" role="form">
                            <div class="form-group">
                                <label>Agenda for <?php echo $council; ?></label>
                                <textarea class="form-control" name="agenda_fill" required></textarea>                                     
                            </div>                             
                            <input type="submit" name="submit" value="Submit" class="btn btn-lg btn-success">
                        </form>                               
                    </div>
                </div>               
            </div>          
        </div>
    </div> <!-- end of modal -->

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