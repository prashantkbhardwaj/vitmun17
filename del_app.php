<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name']));
        $dob = mysqli_real_escape_string($conn, htmlspecialchars($_POST['dob']));
        $grad_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['grad_year']));        
        $phno = mysqli_real_escape_string($conn, htmlspecialchars($_POST['phno']));
        $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
        $nodel = mysqli_real_escape_string($conn, htmlspecialchars($_POST['nodel']));
        $del_details = mysqli_real_escape_string($conn, htmlspecialchars($_POST['del_details']));
        $noeb = mysqli_real_escape_string($conn, htmlspecialchars($_POST['noeb']));
        $eb_details = mysqli_real_escape_string($conn, htmlspecialchars($_POST['eb_details']));
        $hometown = mysqli_real_escape_string($conn, htmlspecialchars($_POST['hometown']));
        $council_ch1 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['council_ch1']));
        $sex = mysqli_real_escape_string($conn, htmlspecialchars($_POST['sex']));
        $country1_council1 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['country1_council1']));
        $country2_council1 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['country2_council1']));
        $country3_council1 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['country3_council1']));
        $country1_council2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['country1_council2']));
        $country2_council2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['country2_council2']));
        $country3_council2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['country3_council2']));
        $country1_council3 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['country1_council3']));
        $country2_council3 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['country2_council3']));
        $country3_council3 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['country3_council3']));
        $council_ch2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['council_ch2']));
        $gain = mysqli_real_escape_string($conn, htmlspecialchars($_POST['gain']));        
        $council_ch3 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['council_ch3']));        
        $hotel = mysqli_real_escape_string($conn, htmlspecialchars($_POST['hotel']));
        $school_select = $_POST['school_select'];
        if ($school_select=="VITC") {
            $in_out = 0;
            $school = "VIT Chennai";
        } else {
            $in_out = 1;
            $school = mysqli_real_escape_string($conn, htmlspecialchars($_POST['school']));
        }
        
       
        
        $target_dir = "img/del_pics/";
        $target_file = $target_dir . basename($_FILES["pro_pic"]["name"]);                
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["pro_pic"]["tmp_name"],"img/del_pics/$phno.jpg");

        $query = "INSERT INTO delegates (name, dob, grad_year, school, in_out, phno, email, nodel, del_details, noeb, eb_details, hometown, council_ch1, sex, country1_council1, country2_council1, country3_council1, country1_council2, council_ch2, country2_council2, country3_council2, country1_council3, country2_council3, country3_council3, gain,  council_ch3, hotel)";
        $query .= " VALUES ('{$name}', '{$dob}', {$grad_year}, '{$school}', {$in_out}, '{$phno}', '{$email}', {$nodel}, '{$del_details}', {$noeb}, '{$eb_details}', '{$hometown}', '{$council_ch1}', '{$sex}', '{$country1_council1}', '{$country2_council1}', '{$country3_council1}', '{$country1_council2}', '{$council_ch2}', '{$country2_council2}', '{$country3_council2}', '{$country1_council3}', '{$country2_council3}', '{$country3_council3}', '{$gain}',  '{$council_ch3}', '{$hotel}')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            redirect_to("payment_select.php");
            $stsc = "";
        } else {
            $stsc = "Something went wrong! Please try again and see that you are using Google Chrome for this application. In case of any technical failure or for any technical assistance, please call 9962416408.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>VITCMUN 2017 | Delegate Application</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="VIT chennai MUN applications" />
    <meta name="keywords" content="VIT chennai, MUN, VIT chennai MUN" />
    <meta name="author" content="Prashant Bhardwaj" />
    <link rel="shortcut icon" href="img/favicon.ico">

    <!-- Bootstrap Core CSS -->
    <link href="admin/public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin/public/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="admin/public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
        <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:#34495e;" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                    <span><img src="img/small_logo.png" width="15%" height="120%"></span>
                    <span style="color:white;"> VITCMUN 2017</span>
                </a>
            </div>
            <!-- Top Menu Items -->
            <div class="collapse navbar-collapse navbar-ex1-collapse" style="color:#edeeef;">
                <ul class="nav navbar-right top-nav">
                    <li>
                       <a href="index.html">HOME</a>
                    </li>
                    <li><a href="index.html#intro">VITCMUN</a></li>
                    <li><a href="index.html#council">COMMITTEES</a></li>
                    <li><a href="team.html">TEAM</a></li>                                        
                    <li><a href="index.html#contact">CONTACT US</a></li>
                </ul>
            </div>
            
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header text-center">
                            Delegate Application
                        </h1>
                        <ol class="breadcrumb text-center">
                            <li>
                                <i class="fa fa-info-circle"></i> Please use <strong>Google Chrome</strong> to fill this application.
                            </li>                            
                        </ol>
                        <span style="color:red;"><h3 class="text-center"><?php echo $stsc; ?></h3></span>
                    </div>
                </div>
                <!-- /.row --> 

               <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                            <form method="post" action="del_app.php" enctype="multipart/form-data" role="form">
                                
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" required class="form-control">                                  
                                </div>

                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="text" placeholder="dd/mm/yyyy" name="dob" required class="form-control">                                  
                                </div>
                            
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="sex" required class="form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>                                  
                                </div>

                                <div class="form-group">
                                    <label>Educational Institution studying in/graduated from</label>
                                    <select id="school_select" onchange="schoolname();" name="school_select" required class="form-control">                                  
                                        <option disabled selected>Choose your option</option>
                                        <option value="VITC">Vellore Institue of Technology, Chennai Campus</option>
                                        <option value="other">Others</option>
                                    </select>
                                </div>

                                <div id="scnamebox" style="display:none;" class="form-group">
                                    <label>Enter the name of the Educational Institution studying in/graduated from</label>
                                    <input id="scname" type="text" name="school" class="form-control">                                  
                                </div>
                           
                                <div class="form-group">
                                    <label>Year of Graduation</label>
                                    <input type="number" name="grad_year" required class="form-control">                                  
                                </div>

                                <div class="form-group">
                                    <label>City of current residence</label>
                                    <input type="text" name="hometown" required class="form-control">                                  
                                </div>

                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="number" name="phno" required class="form-control">                                  
                                </div>

                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" name="email" required class="form-control">                                  
                                </div>

                                <div class="form-group">
                                    <label>Number of Model UN conferences attended as a delegate</label>
                                    <input type="number" name="nodel" required class="form-control">                                  
                                </div>

                                <div class="form-group">
                                    <label>List the Model UN conferences attended as a delegate according to the format given below</label>
                                    <textarea name="del_details" required placeholder="[No. – Name – Institution – Council – Country/Character Allotted – Award won (if any)]" class="form-control" rows="3"></textarea>                                  
                                </div>

                                <div class="form-group">
                                    <label>Number of Model UN conferences attended as an Executive Board member</label>
                                    <input type="number" name="noeb" required class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>List the Model UN conferences attended as an Executive Board member according to the format given below</label>
                                    <textarea name="eb_details" required placeholder="[No. – Name – Institution – Council – Position]" class="form-control" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>State your first preference of council</label>
                                    <select onchange="toggleDisabilitycouncil(this);" name="council_ch1" required class="councilch form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="United Nations Security Council">United Nations Security Council</option>
                                        <option value="United Nations General Assembly Disarmament and International Security Council">United Nations General Assembly – Disarmament and International Security Council</option>
                                        <option value="United Nations Human Rights Council">United Nations Human Rights Council</option>
                                        <option value="International Atomic Energy Agency">International Atomic Energy Agency</option>
                                        <option value="Organisation for Security and Cooperation in Europe">Organisation for Security & Cooperation in Europe</option>
                                        <option value="The Trilateral Commission">The Trilateral Commission</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Select first country preference for your council of first preference</label>
                                    <select onchange="toggleDisabilitycouncil1(this);" name="country1_council1" class="council1ch form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="India">India</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="China">China</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Select second country preference for your council of first preference</label>
                                    <select onchange="toggleDisabilitycouncil1(this);" name="country2_council1" class="council1ch form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="India">India</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="China">China</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Select third country preference for your council of first preference</label>
                                    <select onchange="toggleDisabilitycouncil1(this);" name="country3_council1" class="council1ch form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="India">India</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="China">China</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>State your second preference of council</label>
                                    <select onchange="toggleDisabilitycouncil(this);" name="council_ch2" required class="councilch form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="United Nations Security Council">United Nations Security Council</option>
                                        <option value="United Nations General Assembly Disarmament and International Security Council">United Nations General Assembly – Disarmament and International Security Council</option>
                                        <option value="United Nations Human Rights Council">United Nations Human Rights Council</option>
                                        <option value="International Atomic Energy Agency">International Atomic Energy Agency</option>
                                        <option value="Organisation for Security and Cooperation in Europe">Organisation for Security & Cooperation in Europe</option>
                                        <option value="The Trilateral Commission">The Trilateral Commission</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Select first country preference for your council of second preference</label>
                                    <select onchange="toggleDisabilitycouncil2(this);" name="country1_council2" class="council2ch form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="India">India</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="China">China</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Select second country preference for your council of second preference</label>
                                    <select onchange="toggleDisabilitycouncil2(this);" name="country2_council2" class="council2ch form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="India">India</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="China">China</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Select third country preference for your council of second preference</label>
                                    <select onchange="toggleDisabilitycouncil2(this);" name="country3_council2" class="council2ch form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="India">India</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="China">China</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>State your third preference of council</label>
                                    <select onchange="toggleDisabilitycounci2(this);" name="council_ch3" required class="councilch form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="United Nations Security Council">United Nations Security Council</option>
                                        <option value="United Nations General Assembly Disarmament and International Security Council">United Nations General Assembly – Disarmament and International Security Council</option>
                                        <option value="United Nations Human Rights Council">United Nations Human Rights Council</option>
                                        <option value="International Atomic Energy Agency">International Atomic Energy Agency</option>
                                        <option value="Organisation for Security and Cooperation in Europe">Organisation for Security & Cooperation in Europe</option>
                                        <option value="The Trilateral Commission">The Trilateral Commission</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Select first country preference for your council of third preference</label>
                                    <select onchange="toggleDisabilitycouncil3(this);" name="country1_council3" class="council3ch form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="India">India</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="China">China</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Select second country preference for your council of third preference</label>
                                    <select onchange="toggleDisabilitycouncil3(this);" name="country2_council3" class="council3ch form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="India">India</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="China">China</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Select third country preference for your council of third preference</label>
                                    <select onchange="toggleDisabilitycouncil1(this);" name="country3_council3" class="council3ch form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="India">India</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="China">China</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>  

                                <div class="form-group">
                                    <label>What do you hope to gain by taking part in VITCMUN 2017?</label>
                                    <textarea name="gain" required class="form-control" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Would you be requiring accommodation?</label>
                                    <select name="hotel" required class="form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Upload your picture</label>
                                    <input type="file" id="myFile" class="form-control" name="pro_pic" required>
                                </div><br>

                                <div class="form-group">
                                    <input type="checkbox" required>&nbsp;&nbsp;
                                    <label>By submitting this form, I hereby affirm my conformity to all conference rules & regulations and acknowledge that a violation of the same could lead to my expulsion. </label>
                                    
                                </div>

                                <input type="submit" id="btt" name="submit" class="btn btn-success col-lg-12" value="Submit">
                                
                            </form><br><br><br><br>

                        </div>
                        
                    </div>
               </div><br><br><br><br>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="admin/public/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin/public/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function toggleDisabilitycouncil(selectElement){   
            var arraySelects = document.getElementsByClassName('councilch');   
            var selectedOption = selectElement.selectedIndex;   
            for(var i=0; i<arraySelects.length; i++) {
                if(arraySelects[i] == selectElement)
                    continue; //Passing the selected Select Element
                arraySelects[i].options[selectedOption].disabled = true;
            }
        }
        function toggleDisabilitycouncil1(selectElement){   
            var arraySelects = document.getElementsByClassName('council1ch');   
            var selectedOption = selectElement.selectedIndex;   
            for(var i=0; i<arraySelects.length; i++) {
                if(arraySelects[i] == selectElement)
                    continue; //Passing the selected Select Element
                arraySelects[i].options[selectedOption].disabled = true;
            }
        }
        function toggleDisabilitycouncil2(selectElement){   
            var arraySelects = document.getElementsByClassName('council2ch');   
            var selectedOption = selectElement.selectedIndex;   
            for(var i=0; i<arraySelects.length; i++) {
                if(arraySelects[i] == selectElement)
                    continue; //Passing the selected Select Element
                arraySelects[i].options[selectedOption].disabled = true;
            }
        }
        function toggleDisabilitycouncil3(selectElement){   
            var arraySelects = document.getElementsByClassName('council3ch');   
            var selectedOption = selectElement.selectedIndex;   
            for(var i=0; i<arraySelects.length; i++) {
                if(arraySelects[i] == selectElement)
                    continue; //Passing the selected Select Element
                arraySelects[i].options[selectedOption].disabled = true;
            }
        }
    </script>
    <script type="text/javascript">
        $('#myFile').bind('change', function() {
            //this.files[0].size gets the size of your file.
            var sz = (this.files[0].size);
            if (sz>300000) {
                alert('File size too large, please upload an image of size less than or equal to 300 Kilobytes.');
                document.getElementById("btt").disabled = true;
            } else {
                document.getElementById("btt").disabled = false;
            }
        });
    </script>
    <script type="text/javascript">
        function schoolname(){   
            var name = document.getElementById("school_select").value;
            if (name=="VITC") {
                document.getElementById("scnamebox").style.display = "none";
                document.getElementById("scname").required = false;
            } else {
                document.getElementById("scnamebox").style.display = "initial";
                document.getElementById("scname").required = true;
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