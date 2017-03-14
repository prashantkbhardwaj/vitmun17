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
    $total_query = "SELECT COUNT(id) FROM marathon WHERE pay_status = 1";
    $total_result = mysqli_query($conn, $total_query);
    confirm_query($total_result);
    $total = mysqli_fetch_array($total_result);    //$total[0];  

    $query = "SELECT * FROM marathon WHERE pay_status = 1 ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    confirm_query($result);    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Prashant Bhardwaj">

    <title>Vibrance 2017 | Admin</title>

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

    <div>

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
                <a class="navbar-brand" href="index.php"> Vibrance 2017</a>
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
            
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->            

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-money fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $total[0]; ?></div>
                                        <div>Confirmed Participants</div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="panel-footer">
                                <span class="pull-left">Amount</span>
                                <span class="pull-right"><i class="fa fa-inr"></i> <?php echo $total[0]*200; ?></span>
                                <div class="clearfix"></div>
                            </div>
                            
                        </div>
                    </div>                    
                </div>
                <!-- /.row -->                
                     
                <div class="row">
                        <div class="col-lg-12" id="allot">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center"><i class="fa fa-check-square"></i> Confirmed Participants</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responisve">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone No.</th>
                                                    <th>College</th>
                                                    <th>Reg. No.</th>
                                                    <th>City</th>
                                                    <th>Bill No.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php
                                            while ($list = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $list['fname']." ".$list['lname']; ?></td>
                                                    <td><?php echo $list['email']; ?></td>
                                                    <td><?php echo $list['phno']; ?></td>
                                                    <td><?php echo $list['college']; ?></td>
                                                    <td><?php echo $list['regno']; ?></td>
                                                    <td><?php echo $list['city']; ?></td>
                                                    <td><?php echo $list['rcno']; ?></td>
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