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
?>
<?php
    $del_id = $_GET['del_id'];
    $query = "SELECT * FROM delegates WHERE id = {$del_id} LIMIT 1";
    $result = mysqli_query($conn, $query);
    confirm_query($result);  
    $del = mysqli_fetch_assoc($result); 
    $y_exp = explode("/", $del['dob']);
    $year = 2016 - $y_exp[2];
    if ($del['hotel']=="No") {
        $view_hotel = "style='display:none;'";
    } else {
        $view_hotel = "";
    }
    if ($del['allot']==1) {
        $view_buttons = "style='display:none;'";
        $view_status = "<span style='color:green;'><strong><i class='fa fa-check-square'></i>  Selected applicant for ".$del['allot_council']." as ".$del['allot_country']."</strong></span>";        
        $view_reject = "style='display:none;'";
    } elseif ($del['allot']==2) {
        $view_buttons = "style='display:none;'";
        $view_status = "<span style='color:red;'><strong><i class='fa fa-close'></i>  Rejected Applicant</strong></span>";
        $view_reject = "style='display:none;'";
    } else {
        $view_buttons = "";        
        $view_status = "<i class='fa fa-info-circle'></i> Click on the accept or reject button at the bottom of the profile to accept or reject the applicant and notify him/her via mail automatically.";
        $view_reject = "";
    }
    if ($user_type==4) {
        $view_action = "";
    } else {
        $view_action = "style='display:none;'";
    }
?>
<?php
    $country_list_unsc_query = "SELECT country FROM country_list WHERE council_code = 'unsc' AND allot = 0";
    $country_list_unsc_result = mysqli_query($conn, $country_list_unsc_query);
    confirm_query($country_list_unsc_result);

    $country_list_disec_query = "SELECT country FROM country_list WHERE council_code = 'disec' AND allot = 0";
    $country_list_disec_result = mysqli_query($conn, $country_list_disec_query);
    confirm_query($country_list_disec_result);

    $country_list_unhrc_query = "SELECT country FROM country_list WHERE council_code = 'unhrc' AND allot = 0";
    $country_list_unhrc_result = mysqli_query($conn, $country_list_unhrc_query);
    confirm_query($country_list_unhrc_result);

    $country_list_iaea_query = "SELECT country FROM country_list WHERE council_code = 'iaea' AND allot = 0";
    $country_list_iaea_result = mysqli_query($conn, $country_list_iaea_query);
    confirm_query($country_list_iaea_result);

    $country_list_osce_query = "SELECT country FROM country_list WHERE council_code = 'osce' AND allot = 0";
    $country_list_osce_result = mysqli_query($conn, $country_list_osce_query);
    confirm_query($country_list_osce_result);

    $country_list_tll_query = "SELECT country FROM country_list WHERE council_code = 'tll' AND allot = 0";
    $country_list_tll_result = mysqli_query($conn, $country_list_tll_query);
    confirm_query($country_list_tll_result);
?>
<?php
    if (isset($_POST['submit'])) {
        $allot_council = $_POST['allot_council'];
        if ($_POST['allot_council']=="United Nations Security Council") {
            $allot_country = $_POST['allot_country1'];
            $council_update = "unsc";
        } elseif ($_POST['allot_council']=="United Nations General Assembly Disarmament and International Security Council") {
            $allot_country = $_POST['allot_country2'];
            $council_update = "disec";
        } elseif ($_POST['allot_council']=="United Nations Human Rights Council") {
            $allot_country = $_POST['allot_country3'];
            $council_update = "unhrc";
        } elseif ($_POST['allot_council']=="International Atomic Energy Agency") {
            $allot_country = $_POST['allot_country4'];
            $council_update = "iaea";
        } elseif ($_POST['allot_council']=="Organisation for Security and Cooperation in Europe") {
            $allot_country = $_POST['allot_country5'];
            $council_update = "osce";
        } elseif ($_POST['allot_council']=="The Trilateral Commission") {
            $allot_country = $_POST['allot_country6'];
            $council_update = "tll";
        }      
               

        $allot_query = "UPDATE delegates SET allot_council = '{$allot_council}', allot_country = '{$allot_country}', allot = 1, action_by = '{$current_user}' WHERE id = {$del_id} LIMIT 1";
        $allot_result = mysqli_query($conn, $allot_query);

        $update_country_list = "UPDATE country_list SET allot = 1 WHERE council_code = '{$council_update}' LIMIT 1";
        $update_country_result = mysqli_query($conn, $update_country_list);

       if ($allot_result && mysqli_affected_rows($conn) == 1  && $update_country_result) {

            redirect_to("del_mail.php?del_id=$del_id");
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
    <script type='text/javascript' src="http://codeinnovators.meximas.com/pdfexport/jspdf.debug.js"></script>
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
                    <li class="active">
                        <a href="del.php"><i class="fa fa-fw fa-file-text"></i> Delegates</a>
                    </li>
                    <li>
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
                                <?php echo $view_status; ?> 
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->             
                

               <div id="htmlexportPDF">
                   <div class="row">
                       <div class="col-lg-12">
                            <center>
                                <img src="../../img/del_pics/<?php echo $del['phno']; ?>.jpg" style="border-radius:50%; height:20%; width:20%;">
                            </center>
                       </div>
                   </div>
                    <!-- /.row -->      
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2><?php echo $del['name']; ?></h2>
                        </div>
                    </div>     
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h4><?php echo $year; ?> years</h4>
                        </div>
                    </div>          
                    <div class="row">
                        <div class="col-lg-4">
                            <b><?php echo $del['sex']; ?></b>
                        </div>
                        <div class="col-lg-4 text-center">
                            <b><?php echo $del['school']; ?></b>
                        </div>
                        <div class="col-lg-4 text-center">
                            <b><?php echo $del['email']; ?></b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <b>Ph. No: +91 <?php echo $del['phno']; ?></b>
                        </div>                    
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <b>Year of Graduation <?php echo $del['grad_year']; ?></b>
                        </div> 
                        <div class="col-lg-4 text-center">
                        </div>           
                        <div class="col-lg-4 text-center">
                            <b>City of current residence <?php echo $del['hometown']; ?></b>
                        </div>                    
                    </div><br><hr>
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Number of Model UN conferences attended as a delegate</b>                        
                            </div>
                            <div class="col-lg-4">                          
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['nodel']; ?></b>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <b>List of Model UN conferences attended as a delegate</b>
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align:justify;" class="col-lg-12">
                                <?php echo $del['del_details']; ?>
                            </div>
                        </div>
                    </p><br><hr>
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Number of Model UN conferences attended as an Executive Board member</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['noeb']; ?></b>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <b>List of Model UN conferences attended as an Executive Board member</b> 
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align:justify;" class="col-lg-12">
                                <?php echo $del['eb_details']; ?> 
                            </div>
                        </div>
                    </p><br>  <hr>                  
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Council of first preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['council_ch1']; ?></b>
                            </div>
                        </div>
                    </p><br>

                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>1st choice of country for council of first preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['country1_council1']; ?></b>
                            </div>
                        </div>
                    </p><br>

                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>2nd choice of country for council of first preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['country2_council1']; ?></b>
                            </div>
                        </div>
                    </p><br>

                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>3rd choice of country for council of first preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['country3_council1']; ?></b>
                            </div>
                        </div>
                    </p><br><hr>
                    
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Council of second preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['council_ch2']; ?></b>
                            </div>
                        </div>
                    </p><br>

                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>1st choice of country for council of second preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['country1_council2']; ?></b>
                            </div>
                        </div>
                    </p><br>

                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>2nd choice of country for council of second preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['country2_council2']; ?></b>
                            </div>
                        </div>
                    </p><br>

                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>3rd choice of country for council of second preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['country3_council2']; ?></b>
                            </div>
                        </div>
                    </p><br><hr>
                    
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Council of third preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['council_ch3']; ?></b>
                            </div>
                        </div>
                    </p><br>   

                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>1st choice of country for council of third preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['country1_council3']; ?></b>
                            </div>
                        </div>
                    </p><br>   

                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>2nd choice of country for council of third preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['country2_council3']; ?></b>
                            </div>
                        </div>
                    </p><br>   
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>3rd choice of country for council of third preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['country3_council3']; ?></b>
                            </div>
                        </div>
                    </p><br><hr>
                    
                    <p>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <b>What do I hope to gain by taking part in VITCMUN 2017?</b> 
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align:justify;" class="col-lg-12">
                                <?php echo $del['gain']; ?> 
                            </div>
                        </div>
                    </p><br> <hr>              
                    
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Will I be requiring accommodation? </b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $del['hotel']; ?></b>
                            </div>
                        </div>
                    </p><br>
                    <br><hr>
               </div>

                <div <?php echo $view_action; ?> class="row">
                    <div <?php echo $view_buttons; ?> class="col-lg-4 text-center">
                        <button data-toggle="modal" data-target="#choice" type="button" class="btn btn-lg btn-success">Accept  <i class="fa fa-check"></i></button>
                    </div>                    
                    <div class="col-lg-4 text-center">
                        <button onclick="javascript:htmltopdf();" type="button" class="btn btn-lg btn-primary">Download  <i class="fa fa-download"></i></button>
                    </div>
                    <div <?php echo $view_reject; ?> class="col-lg-4 text-center">
                        <a href="eb_reject.php?eb_id=<?php echo $eb_id; ?>">
                            <button type="button" class="btn btn-lg btn-danger" onclick="return confirm('Are you sure you want to reject this application?');">Reject  <i class="fa fa-close"></i></button>
                        </a>
                    </div>
                </div><br><br><br>
    
            </div>
            <!-- /.container-fluid -->

        </div><br><br>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <div class="modal fade" id="choice" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Select the choices and click to send the mail</h4>
                </div>
                <div class="modal-body">
                    <p>                            
                        <form action="del_profile.php?del_id=<?php echo $del_id; ?>" method="post" role="form">
                            <div class="form-group">
                                <label>Select council for this applicant</label>
                                <select id="cl" onchange="country_allot();" name="allot_council" required class="form-control">
                                    <option value="United Nations Security Council">United Nations Security Council</option>
                                    <option value="United Nations General Assembly Disarmament and International Security Council">United Nations General Assembly – Disarmament and International Security Council</option>
                                    <option value="United Nations Human Rights Council">United Nations Human Rights Council</option>
                                    <option value="International Atomic Energy Agency">International Atomic Energy Agency</option>
                                    <option value="Organisation for Security and Cooperation in Europe">Organisation for Security &amp; Cooperation in Europe</option>
                                    <option value="The Trilateral Commission">The Trilateral Commission</option>
                                </select>
                            </div>
                            
                            <div id="unsc" style="display:none;">
                                <div class="form-group">
                                    <label>Select country for this applicant</label>
                                    <select class="form-control" name="allot_country1">
                                        <?php
                                            while ($unsc_list = mysqli_fetch_assoc($country_list_unsc_result)) { ?>
                                                <option value="<?php echo $unsc_list['country']; ?>"><?php echo $unsc_list['country']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>  
                            </div>   
                            <div id="disec" style="display:none;">
                                <div class="form-group">
                                    <label>Select country for this applicant</label>
                                    <select class="form-control" name="allot_country2">
                                        <?php
                                            while ($disec_list = mysqli_fetch_assoc($country_list_disec_result)) { ?>
                                                <option value="<?php echo $disec_list['country']; ?>"><?php echo $disec_list['country']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>  
                            </div>   
                            <div id="unhrc" style="display:none;">
                                <div class="form-group">
                                    <label>Select country for this applicant</label>
                                    <select class="form-control" name="allot_country3">
                                        <?php
                                            while ($unhrc_list = mysqli_fetch_assoc($country_list_unhrc_result)) { ?>
                                                <option value="<?php echo $unhrc_list['country']; ?>"><?php echo $unhrc_list['country']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>  
                            </div>   
                            <div id="iaea" style="display:none;">
                                <div class="form-group">
                                    <label>Select country for this applicant</label>
                                    <select class="form-control" name="allot_country4">
                                        <?php
                                            while ($iaea_list = mysqli_fetch_assoc($country_list_iaea_result)) { ?>
                                                <option value="<?php echo $iaea_list['country']; ?>"><?php echo $iaea_list['country']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>  
                            </div>   
                            <div id="osce" style="display:none;">
                                <div class="form-group">
                                    <label>Select country for this applicant</label>
                                    <select class="form-control" name="allot_country5">
                                        <?php
                                            while ($osce_list = mysqli_fetch_assoc($country_list_osce_result)) { ?>
                                                <option value="<?php echo $osce_list['country']; ?>"><?php echo $osce_list['country']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>  
                            </div>    
                            <div id="tll" style="display:none;">
                                <div class="form-group">
                                    <label>Select country for this applicant</label>
                                    <select class="form-control" name="allot_country6">
                                        <?php
                                            while ($tll_list = mysqli_fetch_assoc($country_list_tll_result)) { ?>
                                                <option value="<?php echo $tll_list['country']; ?>"><?php echo $tll_list['country']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>  
                            </div>                          
                            <input type="submit" name="submit" value="Submit and send" onclick="return confirm('Are you sure you want to accept this application?');" class="btn btn-lg btn-success">&nbsp; 
                            <button type="reset" class="btn btn-lg btn-warning">Reset</button>
                        </form>                               
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>          
        </div>
    </div> <!-- end of single modal -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
    <script type='text/javascript'>
    function htmltopdf() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        source = $('#htmlexportPDF')[0];
        specialElementHandlers = {
            '#bypassme': function(element, renderer) {
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        pdf.fromHTML(
            source,
            margins.left,
            margins.top, {
                'width': margins.width,
                'elementHandlers': specialElementHandlers
            },

            function(dispose) {
                pdf.save('Eb_app.pdf');
            }, margins);
    }
    </script>
    <script type="text/javascript">
        function country_allot(){
            var cl = document.getElementById("cl").value;
            if (cl=="United Nations Security Council") {
                document.getElementById("unsc").style.display = "initial";                
                document.getElementById("disec").style.display = "none";
                document.getElementById("unhrc").style.display = "none";
                document.getElementById("iaea").style.display = "none";
                document.getElementById("osce").style.display = "none";
                document.getElementById("tll").style.display = "none";                
            } else if(cl=="United Nations General Assembly Disarmament and International Security Council") {
                document.getElementById("unsc").style.display = "none";                
                document.getElementById("disec").style.display = "initial";
                document.getElementById("unhrc").style.display = "none";
                document.getElementById("iaea").style.display = "none";
                document.getElementById("osce").style.display = "none";
                document.getElementById("tll").style.display = "none"; 
            } else if (cl=="United Nations Human Rights Council") {
                document.getElementById("unsc").style.display = "none";                
                document.getElementById("disec").style.display = "none";
                document.getElementById("unhrc").style.display = "initial";
                document.getElementById("iaea").style.display = "none";
                document.getElementById("osce").style.display = "none";
                document.getElementById("tll").style.display = "none"; 
            } else if (cl=="International Atomic Energy Agency") {
                document.getElementById("unsc").style.display = "none";                
                document.getElementById("disec").style.display = "none";
                document.getElementById("unhrc").style.display = "none";
                document.getElementById("iaea").style.display = "initial";
                document.getElementById("osce").style.display = "none";
                document.getElementById("tll").style.display = "none"; 
            } else if (cl=="Organisation for Security and Cooperation in Europe") {
                document.getElementById("unsc").style.display = "none";                
                document.getElementById("disec").style.display = "none";
                document.getElementById("unhrc").style.display = "none";
                document.getElementById("iaea").style.display = "none";
                document.getElementById("osce").style.display = "initial";
                document.getElementById("tll").style.display = "none"; 
            } else if (cl=="The Trilateral Commission") {
                document.getElementById("unsc").style.display = "none";                
                document.getElementById("disec").style.display = "none";
                document.getElementById("unhrc").style.display = "none";
                document.getElementById("iaea").style.display = "none";
                document.getElementById("osce").style.display = "none";
                document.getElementById("tll").style.display = "initial"; 
            } else {
                document.getElementById("unsc").style.display = "none";                
                document.getElementById("disec").style.display = "none";
                document.getElementById("unhrc").style.display = "none";
                document.getElementById("iaea").style.display = "none";
                document.getElementById("osce").style.display = "none";
                document.getElementById("tll").style.display = "none"; 
            }     
        }
    </script>
</body>

</html>
<?php
if (isset ($conn)){
    mysqli_close($conn);
}