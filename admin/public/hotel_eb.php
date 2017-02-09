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
    $eb_id = $_GET['eb_id'];
    $query_eb = "SELECT * FROM eb_apps WHERE id = {$eb_id} LIMIT 1";
    $result_eb = mysqli_query($conn, $query_eb);
    confirm_query($result_eb); 
    $eb_list = mysqli_fetch_assoc($result_eb);

    $query_un = "SELECT * FROM eb_apps WHERE hotel = 'Yes' AND allot = 1 AND allot_hotel = 0 ORDER BY id DESC";
    $result_un = mysqli_query($conn, $query_un);
    confirm_query($result_un); 

    $result_un2 = mysqli_query($conn, $query_un);
    confirm_query($result_un2); 

    $query_room = "SELECT * FROM rooms WHERE allot = 0 ";
    $result_room = mysqli_query($conn, $query_room);
    confirm_query($result_room); 
?>
<?php
    if (isset($_POST['submit'])) {
        $mate1 = $_POST['mate1'];
        $mate2 = $_POST['mate2'];
        $room = $_POST['room'];
        $inmates = $eb_id."_".$mate1."_".$mate2;        

        $ex_in = explode("_", $inmates);

        if ($ex_in[1]=="") {
            $allot_query = "UPDATE eb_apps SET allot_hotel = 1, hotel_by = '{$current_user}' WHERE id = {$eb_id} LIMIT 1";
            $allot_result = mysqli_query($conn, $allot_query);

            $allot_query1 = "";
            $allot_result1 = "";

            $allot_query2 = "";
            $allot_result2 = "";
        } elseif ($ex_in[2]=="") {
            $allot_query = "UPDATE eb_apps SET allot_hotel = 1, mate1 = '{$mate1}', hotel_by = '{$current_user}' WHERE id = {$eb_id} LIMIT 1";
            $allot_result = mysqli_query($conn, $allot_query);

            $allot_query1 = "UPDATE eb_apps SET allot_hotel = 1, mate1 = '{$eb_id}', hotel_by = '{$current_user}' WHERE id = {$mate1} LIMIT 1";
            $allot_result1 = mysqli_query($conn, $allot_query1);

            $allot_query2 = "";
            $allot_result2 = "";
        } else {
            $allot_query = "UPDATE eb_apps SET allot_hotel = 1, mate1 = '{$mate1}', mate2 = '{$mate2}', hotel_by = '{$current_user}' WHERE id = {$eb_id} LIMIT 1";
            $allot_result = mysqli_query($conn, $allot_query);

            $allot_query1 = "UPDATE eb_apps SET allot_hotel = 1, mate1 = '{$eb_id}', mate2 = '{$mate2}', hotel_by = '{$current_user}' WHERE id = {$mate1} LIMIT 1";
            $allot_result1 = mysqli_query($conn, $allot_query1);

            $allot_query2 = "UPDATE eb_apps SET allot_hotel = 1, mate1 = '{$eb_id}', mate2 = '{$mate1}', hotel_by = '{$current_user}' WHERE id = {$mate2} LIMIT 1";
            $allot_result2 = mysqli_query($conn, $allot_query2);
        }


        $update_room_list = "UPDATE rooms SET allot = 1, inmates = '{$inmates}' WHERE roomno = '{$room}' LIMIT 1";
        $update_room_result = mysqli_query($conn, $update_room_list);

       if ($allot_result && mysqli_affected_rows($conn) == 1  && $update_room_result) {

            redirect_to("eb_hotel_mail.php?inmates=$inmates");
        }  
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
                                <i class="fa fa-info-circle"></i> Select choices and submit the form to send them email automatically. 
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->                  

               <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center"><i class="fa fa-black-tie"></i> Executive Board</h3>
                            </div>
                            <div class="panel-body">
                                <div>
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <h3>Accomodation for <?php echo $eb_list['name']; ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="hotel_eb.php?eb_id=<?php echo $eb_id; ?>" method="post" role="form">
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4 text-center">
                                                <label>Select 1<sup>st</sup> roommate</label>
                                                <select  name="mate1" class="form-control">
                                                    <option selected disabled>Choose your option</option>
                                                    <?php
                                                        while ($un_list = mysqli_fetch_assoc($result_un)) { ?>
                                                            <option value="<?php echo $un_list['id']; ?>">
                                                                <?php echo $un_list['name']; ?>          
                                                            </option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div><br><hr><br>
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4 text-center">
                                                <label>Select 2<sup>nd</sup> roommate</label>
                                                <select  name="mate2" class="form-control">
                                                    <option selected disabled>Choose your option</option>
                                                    <?php
                                                        while ($un_list2 = mysqli_fetch_assoc($result_un2)) { ?>
                                                            <option value="<?php echo $un_list2['id']; ?>">
                                                                <?php echo $un_list2['name']; ?>          
                                                            </option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div><br><hr><br>   
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4 text-center">
                                                <label>Select room</label>
                                                <select name="room" class="form-control">
                                                    <option selected disabled>Choose your option</option>
                                                    <?php
                                                        while ($room_list = mysqli_fetch_assoc($result_room)) { ?>
                                                            <option value="<?php echo $room_list['roomno']; ?>">
                                                                <?php echo $room_list['roomno']; ?>          
                                                            </option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div><br><hr><br>                                     
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4 text-center">
                                                <input type="submit" name="submit" value="Submit and send email" class="btn btn-lg btn-success" onclick="return confirm('Are you sure you want to accept this application?');">
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>  <br><br>                                      
                                    </form>
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