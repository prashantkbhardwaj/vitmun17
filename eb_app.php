<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $job = $_POST['job'];
        $school = $_POST['school'];
        $phno = $_POST['phno'];
        $email = $_POST['email'];
        $nodel = $_POST['nodel'];
        $del_details = $_POST['del_details'];
        $noeb = $_POST['noeb'];
        $eb_details = $_POST['eb_details'];
        $sec_details = $_POST['sec_details'];
        $council_ch1 = $_POST['council_ch1'];
        $agenda1 = $_POST['agenda1'];
        $agenda1_details = $_POST['agenda1_details'];
        $council_ch2 = $_POST['council_ch2'];
        $agenda2 = $_POST['agenda2'];
        $agenda2_details = $_POST['agenda2_details'];
        $council_ch3 = $_POST['council_ch3'];
        $posit = $_POST['posit'];
        $eb_caps1 = $_POST['eb_caps1'];
        $alt_post = $_POST['alt_post'];
        $eb_caps2 = $_POST['eb_caps2'];
        $eb_caps3 = $_POST['eb_caps3'];
        $hotel = $_POST['hotel'];
        $q_back = $_POST['q_back'];
        $pro_pic = 1;
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["pro_pic"]["name"]);                
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["pro_pic"]["tmp_name"],"img/ab1.jpg");     

        $query = "INSERT INTO eb_apps (name, dob, job, school, phno, email, nodel, del_details, noeb, eb_details, sec_details, council_ch1, agenda1, agenda1_details,council_ch2, agenda2, agenda2_details, council_ch3, posit, eb_caps1, alt_post, eb_caps2, eb_caps3, hotel, q_back, pro_pic)";
        $query .= " VALUES ('{$name}', '{$dob}', '{$job}', '{$school}', '{$phno}', '{$email}', {$nodel}, '{$del_details}', {$noeb}, '{$eb_details}', '{$sec_details}', '{$council_ch1}', '{$agenda1}', '{$agenda1_details}','{$council_ch2}', '{$agenda2}', '{$agenda2_details}', '{$council_ch3}', '{$posit}', '{$eb_caps1}', '{$alt_post}', '{$eb_caps2}', '{$eb_caps3}', '{$hotel}', '{$q_back}', {$pro_pic})";
        $result = mysqli_query($conn, $query);
        if ($result) {
            redirect_to("payment_select.php");
        } else {
            redirect_to("team.html");
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>VITC Inter MUN 2017 | EB Application</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="VIT chennai inter MUN applications" />
    <meta name="keywords" content="VIT chennai, MUN, VIT chennai inter MUN" />
    <meta name="author" content="Prashant Bhardwaj" />
    <link rel="shortcut icon" href="img/favicon.ico">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <script src="inc/js/jquery-1.11.0.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="inc/bootstrap/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="inc/bootstrap/css/bootstrap-theme.min.css">

    <!-- Bootstrap reset -->
    <link rel="stylesheet" href="inc/bootstrap/css/bootstrap-reset.css">

    <!-- flexslider load -->        
    <link rel="stylesheet" href="inc/flexslider/flexslider.css" type="text/css">        

    <!-- easy pie chart -->
    <link rel="stylesheet" type="text/css" href="inc/easy-pie-chart/demo/style.css">

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="inc/magnific/dist/magnific-popup.css"> 

    <!-- YTP -->
    <link href="inc/YTPlayer/css/YTPlayer.css" media="all" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="inc/font-awesome/css/font-awesome.min.css">        
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/colors.css">


</head>
<body>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-50161037-1', 'wpidiots.com');
        ga('send', 'pageview');
    </script>
    <style type="text/css">
        body {
            margin-top: -10px;
        }
    </style>

    <div class="page-loader"></div>

    <div class="l-wrapper">
        <!-- HEADER -->
        <div class="menu-wrap">
            <!-- NAVIGATION -->
            <div class="l-navigation-wrap menu-padd" id="l-navigation">
                <div class="m-navbar container">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="container-fluid">

                            <div class="l-logo">
                              <a href="index.html">
                                  <img height="35%" width="35%" src="img/small_logo.png"> <span style="color:white;"><b>VITCMUN 2017</b></span>
                              </a>
                          </div><!-- l-logo -->



                          <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                          </button>                                
                      </div>
                      <div class="collapse navbar-collapse" id="navbar">

                        <ul class="nav navbar-nav navbar-right">
                          <li >
                           <a href="#splash-image-wrap">Home</a>
                       </li>
                       <li><a href="#page-section">VITCMUN</a></li>

                       <li><a href="#news">Committees</a></li>
                       <li><a href="team.html">Teams</a></li>                      
                      
                       <li><a href="#contact">Contact Us </a></li>
                       
                   </ul>


               </div>
           </div><!-- /.container-fluid -->
       </nav>
   </div><!-- m-navbar -->
</div><!-- l-navigation -->

</div><!-- content -->


<div class="l-content-wrap" id="standard-content">

    <section>

        <div class="l-page-section l-section" id="page-section">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12"><br>
                        <h2 class="text-center">Application for the executive board</h2>

                        <div>
                            <form role="form" action="eb_app.php" method="POST">
                                 <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" style="color: white;" name="name" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Date of birth</label>
                                    <input type="date" style="color: white;" name="dob" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Occupation (curent)</label>
                                    <input type="text" style="color: white;" name="job" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Educational Institution studying in/graduated from</label>
                                    <input type="text" style="color: white;" name="school" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="number" style="color: white;" name="phno" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" style="color: white;" name="email" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Number of Model UN conferences attended as a delegate</label>
                                    <input type="number" style="color: white;" name="nodel" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>List the Model UN conferences attended as a delegate according to the format given below</label>
                                    <textarea style="color: white;" placeholder="No. - Name - Institution - Council - Country/Character Allotted - Award won (if any)" class="form-control" rows="3" name="del_details" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Number of Model UN conferences attended as an Executive Board member.</label>
                                    <input type="number" style="color: white;" name="noeb" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>
                                        List the Model UN conferences attended as an Executive Board member according to the

format given below.</label>
                                    <textarea style="color: white;" placeholder="No. – Name – Institution – Council – Position" class="form-control" rows="3" name="eb_details" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>List below any Model UN conferences organised as a member of the Secretariat.</label>
                                    <textarea style="color: white;" placeholder="No. – Name – Institution – Position" class="form-control" rows="3" name="sec_details" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>State of your council of first preference:</label>
                                    <select style="color: white;" name="council_ch1" required class="form-control">
                                        <option value="United Nations Security Council">United Nations Security Council</option>
                                        <option value="United Nations General Assembly – Disarmament and International Security Council">United Nations General Assembly – Disarmament and International Security Council</option>
                                        <option value="United Nations Human Rights Council">United Nations Human Rights Council</option>
                                        <option value="International Atomic Energy Agency">International Atomic Energy Agency</option>
                                        <option value="Organisation for Security and Cooperation in Europe">Organisation for Security &amp; Cooperation in Europe</option>
                                        <option value="The Trilateral Commission">The Trilateral Commission</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kindly suggest two agendas you would like to see discussed in this council.</label>
                                    <textarea style="color: white;" class="form-control" rows="3" name="agenda1" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Briefly explain any one of these agendas and your reasons as to why you think it must be

discussed.</label>
                                    <textarea style="color: white;" class="form-control" rows="3" name="agenda1_details" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>State of your council of second preference:</label>
                                    <select style="color: white;" name="council_ch2" required class="form-control">
                                        <option value="United Nations Security Council">United Nations Security Council</option>
                                        <option value="United Nations General Assembly – Disarmament and International Security Council">United Nations General Assembly – Disarmament and International Security Council</option>
                                        <option value="United Nations Human Rights Council">United Nations Human Rights Council</option>
                                        <option value="International Atomic Energy Agency">International Atomic Energy Agency</option>
                                        <option value="Organisation for Security and Cooperation in Europe">Organisation for Security &amp; Cooperation in Europe</option>
                                        <option value="The Trilateral Commission">The Trilateral Commission</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kindly suggest two agendas you would like to see discussed in this council.</label>
                                    <textarea style="color: white;" class="form-control" rows="3" name="agenda2" required></textarea>
                                <div class="form-group">
                                    <label>Briefly explain any one of these agendas and your reasons as to why you think it must be

discussed.</label>
                                    <textarea style="color: white;" class="form-control" rows="3" name="agenda2_details" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>State of your council of third preference:</label>
                                    <select style="color: white;" name="council_ch3" required class="form-control">
                                        <option value="United Nations Security Council">United Nations Security Council</option>
                                        <option value="United Nations General Assembly – Disarmament and International Security Council">United Nations General Assembly – Disarmament and International Security Council</option>
                                        <option value="United Nations Human Rights Council">United Nations Human Rights Council</option>
                                        <option value="International Atomic Energy Agency">International Atomic Energy Agency</option>
                                        <option value="Organisation for Security and Cooperation in Europe">Organisation for Security &amp; Cooperation in Europe</option>
                                        <option value="The Trilateral Commission">The Trilateral Commission</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Which post would you like to apply for?</label>
                                    <select style="color: white;" name="posit" required class="form-control">
                                        <option value="Chairperson/President or equivalent">Chairperson/President or equivalent</option>
                                        <option value="Vice-chairperson/Vice-president or equivalent">Vice-chairperson/Vice- president or equivalent</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Briefly explain why you think you merit the post you applied for and what you will do in your

capacity ensure a high standard of debate and moderation.</label>
                                    <textarea style="color: white;" class="form-control" rows="3" name="eb_caps1" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>If not given Chairperson/President or an equivalent post, would you be open to taking up

Vice-chairperson/Vice- president or an equivalent post?</label>
                                    <select style="color: white;" name="alt_post" required class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        <option value="Maybe">Maybe</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Briefly outline your judging criteria (Kindly list any particular parameters you look at when

there are tied scores).</label>
                                    <textarea style="color: white;" class="form-control" rows="3" name="eb_caps2" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Would you be willing to share your grading sheets with the Secretariat at the end of each

day?</label>
                                    <select style="color: white;" class="form-control" name="eb_caps3" required>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        <option value="Maybe">Maybe</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Would you be requiring accommodation?</label>
                                    <select style="color: white;" class="form-control" name="hotel" required>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        <option value="Maybe">Maybe</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Do you have any other queries for us at this time?</label>
                                    <textarea style="color: white;" class="form-control" rows="3" name="q_back" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Upload your picture.</label>
                                    <input type="file" style="color: white;" class="form-control" name="pro_pic" required>
                                </div><br>
                                <input type="submit" class="btn btn-success col-lg-12" value="Submit" name="submit">
                            </form>             
                        </div>

                    </div><!-- col-lg-12 -->
                </div><!-- row -->

                <div class="separator"></div><!-- separator -->               

            </div><!-- container -->                    

        </div><!-- l-page-section -->

    </section>

</div><!-- l-paralax-section -->

</section>
<section>

    

        <div class="l-copyright text-center">

            <div class="container">
                <div class="m-social-icons">            
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>
                </div><!--m-social-icons-->
            </div><!-- container -->
        </div><!-- l-copyright -->
    </div><!-- l-contactus-section -->

</section>

</div><!-- l-content-wrap -->

</div><!-- l-wrapper -->


<!-- LOAD SCRIPTS -->

<!-- Latest compiled and minified JavaScript -->
<script src="inc/bootstrap/js/bootstrap.min.js"></script>

<!-- flexslider -->
<script src="inc/flexslider/jquery.flexslider.js"></script>

<!-- skrollr -->
<script type="text/javascript" src="inc/skrollr/dist/skrollr.min.js"></script>

<!-- easy pie chart -->
<script src="inc/easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

<!-- isotope -->
<script src="inc/isotope/jquery.isotope.min.js" ></script>
<script src="inc/isotope/jquery.isotope.sloppy-masonry.js" ></script>

<!-- nice scroll -->
<script src="inc/nice-scroll/jquery.nicescroll.min.js" ></script>

<!-- google maps -->
<script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>

<!-- Magnific Popup core JS file -->
<script src="inc/magnific/dist/jquery.magnific-popup.js"></script> 

<!-- Waypoints -->
<script src="inc/waypoints/waypoints.min.js"></script>

<!-- YTP -->
<script type="text/javascript" src="inc/YTPlayer/inc/jquery.mb.YTPlayer.js"></script>

<!-- TWITTER SCRIPT -->
<script type="text/javascript" charset="utf-8" src="inc/tweet/twitter/jquery.tweet.js"></script>

<!-- contact form checker -->
<script src="inc/form-validator/dist/jquery.validate.js"></script>

<!-- script calling -->
<script src="inc/js/common.js"></script>        

</body>   
</html>
<?php
if (isset ($conn)){
    mysqli_close($conn);
}
?>