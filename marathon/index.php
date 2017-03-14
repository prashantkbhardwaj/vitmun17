<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
    $view_note = "style='display:none;'";
    $acct_note = '';
    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phno = $_POST['phno'];
        $regno = $_POST['regno'];
        if ($_POST['school_select']=="VIT") {
            $college = "VIT University";
        } else {
            $college = $_POST['college'];
        }
        if ($_POST['city_select']=="Chennai") {
            $city = "Chennai";
        } else {
            $city = $_POST['city'];
        }

        $rcno = rand();
        date_default_timezone_set('Asia/Calcutta');
        $ptime = date("Y-m-d H:i:s");        

        $check_query = "SELECT id FROM marathon WHERE email = '{$email}'";
        $check_result = mysqli_query($conn, $check_query);
        //confirm_query($check_result);
        $checklist = mysqli_fetch_assoc($check_result);
        if ($checklist['id']=="") {
            $query = "INSERT INTO marathon (fname, lname, email, phno, regno, college, city, rcno, ptime) VALUES ('{$fname}', '{$lname}', '{$email}', '{$phno}', '{$regno}', '{$college}', '{$city}', '{$rcno}', '{$ptime}')";
            $result = mysqli_query($conn, $query);
            confirm_query($result);
            if ($result) {
                $aremail = explode("@", $email);
                $sendEmail = $aremail[0]."_".$aremail[1];
                redirect_to("payment.php?eid=$sendEmail");
                $fail = "";
            } else {
                $fail = "<span style='color:red'>Something went wrong, please email us at vibrancechennai@gmail.com or call us at 9962416408 for imidiate support.</span>";
            }

            $view_note = "style='display:none;'";
            $acct_note = '';
        } else {
            $view_note = "";
            $acct_note = '<span style="color:red;">This email is already used to register.</span>';
        }

        
    }
?>

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
                <?php echo $fail; ?>               
                <div <?php echo $view_note; ?> class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong><?php echo $acct_note; ?></strong> 
                        </div>
                    </div>
                </div>
                <div  id="pay" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">                                
                                <h4 class="modal-title">Please enter your details here.</h4>
                            </div>
                            <div class="modal-body">
                                <p>                            
                                    <form action="index.php" method="post" role="form">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="fname" class="form-control" required>
                                        </div> 
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="lname" class="form-control" required>
                                        </div> 
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div> 
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="number" min="1000000000" max="9999999999" name="phno" class="form-control" placeholder="Please enter your 10 digit mobile number. Do not include +91 " required>
                                        </div> 
                                        <div class="form-group">
                                            <label>Reg. No.</label>
                                            <input type="text" name="regno" placeholder="If you are not from VIT please enter any random number or your registration number" class="form-control" required>
                                        </div> 
                                        <div class="form-group">
                                            <label>College</label>
                                            <select id="school_select" onchange="schoolname();" name="school_select" required class="form-control">                                  
                                        
                                                <option value="VIT">Vellore Institue of Technology</option>
                                                <option value="other">Others</option>
                                            </select>
                                        </div>

                                        <div id="scnamebox" style="display:none;" class="form-group">
                                            <label>Enter the name of your college</label>
                                            <input id="scname" type="text" name="college" class="form-control">                                  
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>City</label>
                                            <select id="city_select" onchange="cityname();" name="city_select" required class="form-control">                                  
                                        
                                                <option value="Chennai">Chennai</option>
                                                <option value="other">Others</option>
                                            </select>
                                        </div>

                                        <div id="cinamebox" style="display:none;" class="form-group">
                                            <label>Enter the name of your city</label>
                                            <input id="ciname" type="text" name="city" class="form-control">                                  
                                        </div> <br>             
                                        <input type="submit" name="submit" value="Submit and proceed to payment" class="btn btn-lg btn-success col-lg-12">&nbsp;
                                    </form>                               
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
    <script type="text/javascript">
        function schoolname(){   
            var name = document.getElementById("school_select").value;
            if (name=="VIT") {
                document.getElementById("scnamebox").style.display = "none";
                document.getElementById("scname").required = false;
            } else {
                document.getElementById("scnamebox").style.display = "initial";
                document.getElementById("scname").required = true;
            }            
        }
        function cityname(){   
            var cname = document.getElementById("city_select").value;
            if (cname=="Chennai") {
                document.getElementById("cinamebox").style.display = "none";
                document.getElementById("ciname").required = false;
            } else {
                document.getElementById("cinamebox").style.display = "initial";
                document.getElementById("ciname").required = true;
            }            
        }
    </script>

</body>

</html>
<?php
if (isset ($conn)){
  mysqli_close($conn);
}
?>