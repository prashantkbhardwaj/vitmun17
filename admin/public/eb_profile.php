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
    $eb_id = $_GET['eb_id'];
    $query = "SELECT * FROM eb_apps WHERE id = {$eb_id} LIMIT 1";
    $result = mysqli_query($conn, $query);
    confirm_query($result);  
    $eb = mysqli_fetch_assoc($result); 
    $y_exp = explode("-", $eb['dob']);
    $year = 2016 - $y_exp[0];
?>
<?php
    if (isset($_POST['submit'])) {
        $allot_council = $_POST['allot_council'];
        $allot_post = $_POST['allot_post'];
        $allot_hotel = $_POST['allot_hotel'];

        $allot_query = "UPDATE eb_apps SET allot_council = '{$allot_council}', allot_post = '{$allot_post}', allot_hotel = '{$allot_hotel}', allot = 1 WHERE id = {$eb_id} LIMIT 1";
        $allot_result = mysqli_query($conn, $allot_query);

       if ($allot_result && mysqli_affected_rows($conn) == 1) {

            redirect_to("eb_mail.php?eb_id=$eb_id");
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
                    <a href="logout.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sign-out"></i> </a>
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
                        <a href="#"><i class="fa fa-fw fa-edit"></i> Others</a>
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
                                <i class="fa fa-dashboard"></i> Click on the accept or reject button at the bottom of the profile to accept or reject the applicant and notify him/her via mail automatically. 
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->             
                

               <div id="htmlexportPDF">
                   <div class="row">
                       <div class="col-lg-12">
                            <center>
                                <img src="../../img/eb_pics/<?php echo $eb['phno']; ?>.jpg" style="border-radius:50%; height:20%; width:20%;">
                            </center>
                       </div>
                   </div>
                    <!-- /.row -->      
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2><?php echo $eb['name']; ?></h2>
                        </div>
                    </div>     
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h4><?php echo $year; ?> years</h4>
                        </div>
                    </div>          
                    <div class="row">
                        <div class="col-lg-4">
                            <b><?php echo $eb['job']; ?></b>
                        </div>
                        <div class="col-lg-4 text-center">
                            <b><?php echo $eb['school']; ?></b>
                        </div>
                        <div class="col-lg-4 text-center">
                            <b><?php echo $eb['email']; ?></b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <b>Ph. No: +91 <?php echo $eb['phno']; ?></b>
                        </div>                    
                    </div><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Number of Model UN conferences attended as a delegate</b>                        
                            </div>
                            <div class="col-lg-4">                          
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $eb['nodel']; ?></b>
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
                                <?php echo $eb['del_details']; ?>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Number of Model UN conferences attended as an Executive Board member</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $eb['noeb']; ?></b>
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
                                <?php echo $eb['eb_details']; ?> 
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <b>List of Model UN conferences attended as a member of the Secretariat</b> 
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align:justify;" class="col-lg-12">
                                <?php echo $eb['sec_details']; ?>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Council of first preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $eb['council_ch1']; ?></b>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <b>Suggestion of two agendas I would like to see discussed in this council</b> 
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align:justify;" class="col-lg-12">
                                <?php echo $eb['agenda1']; ?>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <b>Explaination of any one of these agendas and my reasons as to why I think it must be discussed.</b> 
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align:justify;" class="col-lg-12">
                                <?php echo $eb['agenda1_details']; ?>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Council of second preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $eb['council_ch2']; ?></b>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <b>Suggestion of two agendas I would like to see discussed in this council</b> 
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align:justify;" class="col-lg-12">
                                <?php echo $eb['agenda2']; ?>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <b>Explaination of any one of these agendas and my reasons as to why I think it must be discussed.</b> 
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align:justify;" class="col-lg-12">
                                <?php echo $eb['agenda2_details']; ?>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Council of third preference</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $eb['council_ch3']; ?></b>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Post I would you like to apply for</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $eb['posit']; ?></b>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <b>Explaination of why I think I merit the post I applied for and what will I do in my capacity to ensure a high standard of debate and moderation.</b> 
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align:justify;" class="col-lg-12">
                                <?php echo $eb['eb_caps1']; ?>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>If not given Chairperson/President or an equivalent post, would I be open to taking up Vice-chairperson/Vice-president or an equivalent post?</b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $eb['alt_post']; ?></b>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <b>A brief outline of my judging criteria. (Includes list of particular parameters I look at when there are tied scores).</b> 
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align:justify;" class="col-lg-12">
                                <?php echo $eb['eb_caps2']; ?>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Will I be willing to share my grading sheets with the Secretariat at the end of each day? </b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $eb['eb_caps3']; ?></b>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>Will I be requiring accommodation? </b>
                            </div>
                            <div class="col-lg-4">                            
                            </div>
                            <div class="col-lg-4 text-center">
                                <b><?php echo $eb['hotel']; ?></b>
                            </div>
                        </div>
                    </p><br>
                    <p>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <b>Any other queries for you (the oraganizers) at this time</b> 
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align:justify;" class="col-lg-12">
                                <?php echo $eb['q_back']; ?>
                            </div>
                        </div>
                    </p><br><br><hr>
               </div>

                <div class="row">
                    <div class="col-lg-4 text-center">
                        <button data-toggle="modal" data-target="#choice" type="button" class="btn btn-lg btn-success">Accept  <i class="fa fa-check"></i></button>
                    </div>
                    <div class="col-lg-4 text-center">
                        <button onclick="javascript:htmltopdf();" type="button" class="btn btn-lg btn-primary">Download  <i class="fa fa-download"></i></button>
                    </div>
                    <div class="col-lg-4 text-center">
                        <button type="button" class="btn btn-lg btn-danger">Reject  <i class="fa fa-close"></i></button>
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
                        <form action="eb_profile.php?eb_id=<?php echo $eb_id; ?>" method="post" role="form">
                            <div class="form-group">
                                <label>Select council for this applicant</label>
                                <select name="allot_council" required class="form-control">
                                    <option value="United Nations Security Council">United Nations Security Council</option>
                                    <option value="United Nations General Assembly – Disarmament and International Security Council">United Nations General Assembly – Disarmament and International Security Council</option>
                                    <option value="United Nations Human Rights Council">United Nations Human Rights Council</option>
                                    <option value="International Atomic Energy Agency">International Atomic Energy Agency</option>
                                    <option value="Organisation for Security and Cooperation in Europe">Organisation for Security &amp; Cooperation in Europe</option>
                                    <option value="The Trilateral Commission">The Trilateral Commission</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select post for this applicant</label>
                                <select class="form-control" name="allot_post" required>
                                    <option value="Chairperson/President or equivalent">Chairperson/President or equivalent</option>
                                    <option value="Vice-chairperson/Vice- president or equivalent">Vice-chairperson/Vice- president or equivalent</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Allot accomodation?</label>
                                <select class="form-control" name="allot_hotel" required>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <input type="submit" name="submit" value="Submit and send" class="btn btn-lg btn-success">&nbsp; 
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

</body>

</html>
<?php
if (isset ($conn)){
    mysqli_close($conn);
}