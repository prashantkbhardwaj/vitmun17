<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="VIT Chennai Vibrance, Marathon registrations">
    <meta name="author" content="Prashant Bhardwaj">

    <title>Vibrance | Marathon Registration</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                <a class="navbar-brand" href="http://vitvibrance.com/">Vibrance 2017</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="https://www.facebook.com/VibranceVIT" target="_blank" class="dropdown-toggle"><i class="fa fa-facebook"></i></a>                    
                </li>
                <li class="dropdown">
                    <a href="https://www.instagram.com/vibrancevit/" target="_blank" class="dropdown-toggle"><i class="fa fa-instagram"></i></a>                   
                </li>                
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
           
        </nav>
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <span>
                            
                        </span>
                        <h1 class="page-header text-center">
                            <img src="img/vibrance_logo_dark.png" style="height:8%; width:8%;"> Marathon 2017
                        </h1>
                    </div>
                </div>
                <!-- /.row -->                 
                <div  id="pay" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">                            
                            <div class="modal-body">
                                <p>
                                    <div class="text-center"><img src="img/tick.png"></div>                            
                                    <h3 class="text-center">Congratulations! You have successfully registered and paid for Marathon in Vibrance 2017. Please check your email for the same.</h3><br>
                                    <div class="text-center">Please check your spam folder if you don't get the email in your inbox.</div>                        
                                </p>
                            </div>
                            
                        </div>   <br><br>       
                    </div>
                </div>

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

</body>

</html>
<?php
if (isset ($conn)){
  mysqli_close($conn);
}
?>