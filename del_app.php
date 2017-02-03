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
                                    <select id="cl1" onchange="toggleDisabilitycouncil(this);" name="council_ch1" required class="councilch form-control">
                                        <option disabled selected>Choose your option</option>
                                        <option value="United Nations Security Council">United Nations Security Council</option>
                                        <option value="United Nations General Assembly Disarmament and International Security Council">United Nations General Assembly – Disarmament and International Security Council</option>
                                        <option value="United Nations Human Rights Council">United Nations Human Rights Council</option>
                                        <option value="International Atomic Energy Agency">International Atomic Energy Agency</option>
                                        <option value="Organisation for Security and Cooperation in Europe">Organisation for Security & Cooperation in Europe</option>
                                        <option value="The Trilateral Commission">The Trilateral Commission</option>
                                    </select>
                                </div>
                                
                                <div id="unsc" style="display:none;">
                                    <div class="form-group col-lg-4">
                                        <label>Select first country preference for your council of first preference</label>
                                        <select onchange="toggleDisabilitycouncil1(this);" name="country1_council1" class="council1ch form-control">
                                            <option disabled selected>Choose your option</option>
                                            <option value="China (Republic of)">China (Republic of)</option>
                                            <option value="France">France</option>
                                            <option value="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                                            <option value="United Kingdom of Great Britain and Northern Ireland">United Kingdom of Great Britain and Northern Ireland</option>
                                            <option value="United States of America">United States of America</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Ukrainian Soviet Socialist Republic">Ukrainian Soviet Socialist Republic</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Czechoslovakia">Czechoslovakia</option>
                                            <option value="India">India</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label>Select second country preference for your council of first preference</label>
                                        <select onchange="toggleDisabilitycouncil1(this);" name="country2_council1" class="council1ch form-control">
                                            <option disabled selected>Choose your option</option>
                                            <option value="China (Republic of)">China (Republic of)</option>
                                            <option value="France">France</option>
                                            <option value="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                                            <option value="United Kingdom of Great Britain and Northern Ireland">United Kingdom of Great Britain and Northern Ireland</option>
                                            <option value="United States of America">United States of America</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Ukrainian Soviet Socialist Republic">Ukrainian Soviet Socialist Republic</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Czechoslovakia">Czechoslovakia</option>
                                            <option value="India">India</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label>Select third country preference for your council of first preference</label>
                                        <select onchange="toggleDisabilitycouncil1(this);" name="country3_council1" class="council1ch form-control">
                                            <option disabled selected>Choose your option</option>
                                            <option value="China (Republic of)">China (Republic of)</option>
                                            <option value="France">France</option>
                                            <option value="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                                            <option value="United Kingdom of Great Britain and Northern Ireland">United Kingdom of Great Britain and Northern Ireland</option>
                                            <option value="United States of America">United States of America</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Ukrainian Soviet Socialist Republic">Ukrainian Soviet Socialist Republic</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Czechoslovakia">Czechoslovakia</option>
                                            <option value="India">India</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="disec" style="display:none;">
                                    <div class="form-group col-lg-4">
                                        <label>Select first country preference for your council of first preference</label>
                                        <select onchange="toggleDisabilitycouncil1(this);" name="country1_council1" class="council1ch form-control">
                                            <option disabled selected>Choose your option</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia (Plurinational State of )">Bolivia (Plurinational State of )</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote d'lvoire">Cote d'lvoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Democratic People's Republic of Korea">Democratic People's Republic of Korea</option>
                                            <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgzystan">Kyrgzystan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libya">Libya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxemborg">Luxemborg</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia (Federal States of)">Micronesia (Federal States of)</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestine(O)">Palestine(O)</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Phillipines">Phillipines</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Republic of Korea">Republic of Korea</option>
                                            <option value="Republic of Moldova">Republic of Moldova</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Sudan">South Sudan</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="The former Yugoslav Republic of Macedonia">The former Yugoslav Republic of Macedonia</option>
                                            <option value="Timor-Leste">Timor-Leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United Republic of Tanzania">United Republic of Tanzania</option>
                                            <option value="United States of America">United States of America</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela (Bolivarian Republic of)">Venezuela (Bolivarian Republic of)</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>

                                        </select>
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label>Select second country preference for your council of first preference</label>
                                        <select onchange="toggleDisabilitycouncil1(this);" name="country2_council1" class="council1ch form-control">
                                            <option disabled selected>Choose your option</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia (Plurinational State of )">Bolivia (Plurinational State of )</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote d'lvoire">Cote d'lvoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Democratic People's Republic of Korea">Democratic People's Republic of Korea</option>
                                            <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgzystan">Kyrgzystan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libya">Libya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxemborg">Luxemborg</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia (Federal States of)">Micronesia (Federal States of)</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestine(O)">Palestine(O)</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Phillipines">Phillipines</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Republic of Korea">Republic of Korea</option>
                                            <option value="Republic of Moldova">Republic of Moldova</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Sudan">South Sudan</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="The former Yugoslav Republic of Macedonia">The former Yugoslav Republic of Macedonia</option>
                                            <option value="Timor-Leste">Timor-Leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United Republic of Tanzania">United Republic of Tanzania</option>
                                            <option value="United States of America">United States of America</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela (Bolivarian Republic of)">Venezuela (Bolivarian Republic of)</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label>Select third country preference for your council of first preference</label>
                                        <select onchange="toggleDisabilitycouncil1(this);" name="country3_council1" class="council1ch form-control">
                                            <option disabled selected>Choose your option</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia (Plurinational State of )">Bolivia (Plurinational State of )</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote d'lvoire">Cote d'lvoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Democratic People's Republic of Korea">Democratic People's Republic of Korea</option>
                                            <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgzystan">Kyrgzystan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libya">Libya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxemborg">Luxemborg</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia (Federal States of)">Micronesia (Federal States of)</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestine(O)">Palestine(O)</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Phillipines">Phillipines</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Republic of Korea">Republic of Korea</option>
                                            <option value="Republic of Moldova">Republic of Moldova</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Sudan">South Sudan</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="The former Yugoslav Republic of Macedonia">The former Yugoslav Republic of Macedonia</option>
                                            <option value="Timor-Leste">Timor-Leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United Republic of Tanzania">United Republic of Tanzania</option>
                                            <option value="United States of America">United States of America</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela (Bolivarian Republic of)">Venezuela (Bolivarian Republic of)</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div id="unhrc">
                                    <div class="form-group col-lg-4">
                                        <label>Select first country preference for your council of second preference</label>
                                        <select onchange="toggleDisabilitycouncil2(this);" name="country1_council2" class="council2ch form-control">
                                            <option disabled selected>Choose your option</option>
                                            <option value="AFGHANISTAN">AFGHANISTAN</option>
                                            <option value="ALBANIA">ALBANIA</option> 
                                            <option value="AMNESTY INTERNATIONAL">AMNESTY INTERNATIONAL</option>
                                            <option value="BANGLADESH">BANGLADESH</option>
                                            <option value="BELGIUM">BELGIUM</option>
                                            <option value="BOLIVIA">BOLIVIA</option>
                                            <option value="BOSNIA & HERZEGOVINA">BOSNIA & HERZEGOVINA</option>
                                            <option value="BOTSWANA">BOTSWANA</option> 
                                            <option value="BRAZIL">BRAZIL</option>
                                            <option value="BURUNDI">BURUNDI</option>
                                            <option value="CANADA">CANADA</option>
                                            <option value="CHINA">CHINA</option>
                                            <option value="CONGO">CONGO</option>
                                            <option value="COTE D'IVOIRE">COTE D'IVOIRE</option>
                                            <option value="CROATIA">CROATIA</option> 
                                            <option value="CUBA">CUBA</option>
                                            <option value="DENMARK">DENMARK</option>
                                            <option value="ECUADOR">ECUADOR</option>
                                            <option value="EGYPT">EGYPT</option>
                                            <option value="EL SALVADOR">EL SALVADOR</option>
                                            <option value="ETHIOPIA">ETHIOPIA</option>
                                            <option value="FRANCE">FRANCE</option>
                                            <option value="GEORGIA">GEORGIA</option>
                                            <option value="GERMANY">GERMANY</option>
                                            <option value="GHANA">GHANA</option> 
                                            <option value="HUNGARY">HUNGARY</option>
                                            <option value="INDIA">INDIA</option>
                                            <option value="INDONESIA">INDONESIA</option>
                                            <option value="IRAN">IRAN</option>
                                            <option value="IRAQ">IRAQ</option>
                                            <option value="JAPAN">JAPAN</option>
                                            <option value="KENYA">KENYA</option>
                                            <option value="KYRGYZSTAN">KYRGYZSTAN</option>
                                            <option value="LATVIA">LATVIA</option>
                                            <option value="LIBYA">LIBYA</option>
                                            <option value="MONGOLIA">MONGOLIA</option>
                                            <option value="NETHERLANDS">NETHERLANDS</option>
                                            <option value="NIGERIA">NIGERIA</option>
                                            <option value="PAKISTAN">PAKISTAN</option>
                                            <option value="PANAMA">PANAMA</option>
                                            <option value="PARAGUAY">PARAGUAY</option>
                                            <option value="PHILIPPINES">PHILIPPINES</option>
                                            <option value="PORTUGAL">PORTUGAL</option> 
                                            <option value="QATAR">QATAR</option>
                                            <option value="REPUBLIC OF KOREA">REPUBLIC OF KOREA</option>
                                            <option value="RUSSIA">RUSSIA</option>
                                            <option value="RWANDA">RWANDA</option>
                                            <option value="SAUDI ARABIA">SAUDI ARABIA</option>
                                            <option value="SLOVENIA">SLOVENIA</option>
                                            <option value="SOUTH AFRICA">SOUTH AFRICA</option>
                                            <option value="SWEDEN">SWEDEN</option>
                                            <option value="SWITZERLAND">SWITZERLAND</option>
                                            <option value="TOGO">TOGO</option>
                                            <option value="TUNISIA">TUNISIA</option>
                                            <option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option>
                                            <option value="UNITED KINGDOM">UNITED KINGDOM</option>
                                            <option value="UNITED STATES OF AMERICA">UNITED STATES OF AMERICA</option>
                                            <option value="VENEZUELA">VENEZUELA</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Select first country preference for your council of second preference</label>
                                        <select onchange="toggleDisabilitycouncil2(this);" name="country1_council2" class="council2ch form-control">
                                            <option disabled selected>Choose your option</option>
                                            <option value="AFGHANISTAN">AFGHANISTAN</option>
                                            <option value="ALBANIA">ALBANIA</option> 
                                            <option value="AMNESTY INTERNATIONAL">AMNESTY INTERNATIONAL</option>
                                            <option value="BANGLADESH">BANGLADESH</option>
                                            <option value="BELGIUM">BELGIUM</option>
                                            <option value="BOLIVIA">BOLIVIA</option>
                                            <option value="BOSNIA & HERZEGOVINA">BOSNIA & HERZEGOVINA</option>
                                            <option value="BOTSWANA">BOTSWANA</option> 
                                            <option value="BRAZIL">BRAZIL</option>
                                            <option value="BURUNDI">BURUNDI</option>
                                            <option value="CANADA">CANADA</option>
                                            <option value="CHINA">CHINA</option>
                                            <option value="CONGO">CONGO</option>
                                            <option value="COTE D'IVOIRE">COTE D'IVOIRE</option>
                                            <option value="CROATIA">CROATIA</option> 
                                            <option value="CUBA">CUBA</option>
                                            <option value="DENMARK">DENMARK</option>
                                            <option value="ECUADOR">ECUADOR</option>
                                            <option value="EGYPT">EGYPT</option>
                                            <option value="EL SALVADOR">EL SALVADOR</option>
                                            <option value="ETHIOPIA">ETHIOPIA</option>
                                            <option value="FRANCE">FRANCE</option>
                                            <option value="GEORGIA">GEORGIA</option>
                                            <option value="GERMANY">GERMANY</option>
                                            <option value="GHANA">GHANA</option> 
                                            <option value="HUNGARY">HUNGARY</option>
                                            <option value="INDIA">INDIA</option>
                                            <option value="INDONESIA">INDONESIA</option>
                                            <option value="IRAN">IRAN</option>
                                            <option value="IRAQ">IRAQ</option>
                                            <option value="JAPAN">JAPAN</option>
                                            <option value="KENYA">KENYA</option>
                                            <option value="KYRGYZSTAN">KYRGYZSTAN</option>
                                            <option value="LATVIA">LATVIA</option>
                                            <option value="LIBYA">LIBYA</option>
                                            <option value="MONGOLIA">MONGOLIA</option>
                                            <option value="NETHERLANDS">NETHERLANDS</option>
                                            <option value="NIGERIA">NIGERIA</option>
                                            <option value="PAKISTAN">PAKISTAN</option>
                                            <option value="PANAMA">PANAMA</option>
                                            <option value="PARAGUAY">PARAGUAY</option>
                                            <option value="PHILIPPINES">PHILIPPINES</option>
                                            <option value="PORTUGAL">PORTUGAL</option> 
                                            <option value="QATAR">QATAR</option>
                                            <option value="REPUBLIC OF KOREA">REPUBLIC OF KOREA</option>
                                            <option value="RUSSIA">RUSSIA</option>
                                            <option value="RWANDA">RWANDA</option>
                                            <option value="SAUDI ARABIA">SAUDI ARABIA</option>
                                            <option value="SLOVENIA">SLOVENIA</option>
                                            <option value="SOUTH AFRICA">SOUTH AFRICA</option>
                                            <option value="SWEDEN">SWEDEN</option>
                                            <option value="SWITZERLAND">SWITZERLAND</option>
                                            <option value="TOGO">TOGO</option>
                                            <option value="TUNISIA">TUNISIA</option>
                                            <option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option>
                                            <option value="UNITED KINGDOM">UNITED KINGDOM</option>
                                            <option value="UNITED STATES OF AMERICA">UNITED STATES OF AMERICA</option>
                                            <option value="VENEZUELA">VENEZUELA</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Select first country preference for your council of second preference</label>
                                        <select onchange="toggleDisabilitycouncil2(this);" name="country1_council2" class="council2ch form-control">
                                            <option disabled selected>Choose your option</option>
                                            <option value="AFGHANISTAN">AFGHANISTAN</option>
                                            <option value="ALBANIA">ALBANIA</option> 
                                            <option value="AMNESTY INTERNATIONAL">AMNESTY INTERNATIONAL</option>
                                            <option value="BANGLADESH">BANGLADESH</option>
                                            <option value="BELGIUM">BELGIUM</option>
                                            <option value="BOLIVIA">BOLIVIA</option>
                                            <option value="BOSNIA & HERZEGOVINA">BOSNIA & HERZEGOVINA</option>
                                            <option value="BOTSWANA">BOTSWANA</option> 
                                            <option value="BRAZIL">BRAZIL</option>
                                            <option value="BURUNDI">BURUNDI</option>
                                            <option value="CANADA">CANADA</option>
                                            <option value="CHINA">CHINA</option>
                                            <option value="CONGO">CONGO</option>
                                            <option value="COTE D'IVOIRE">COTE D'IVOIRE</option>
                                            <option value="CROATIA">CROATIA</option> 
                                            <option value="CUBA">CUBA</option>
                                            <option value="DENMARK">DENMARK</option>
                                            <option value="ECUADOR">ECUADOR</option>
                                            <option value="EGYPT">EGYPT</option>
                                            <option value="EL SALVADOR">EL SALVADOR</option>
                                            <option value="ETHIOPIA">ETHIOPIA</option>
                                            <option value="FRANCE">FRANCE</option>
                                            <option value="GEORGIA">GEORGIA</option>
                                            <option value="GERMANY">GERMANY</option>
                                            <option value="GHANA">GHANA</option> 
                                            <option value="HUNGARY">HUNGARY</option>
                                            <option value="INDIA">INDIA</option>
                                            <option value="INDONESIA">INDONESIA</option>
                                            <option value="IRAN">IRAN</option>
                                            <option value="IRAQ">IRAQ</option>
                                            <option value="JAPAN">JAPAN</option>
                                            <option value="KENYA">KENYA</option>
                                            <option value="KYRGYZSTAN">KYRGYZSTAN</option>
                                            <option value="LATVIA">LATVIA</option>
                                            <option value="LIBYA">LIBYA</option>
                                            <option value="MONGOLIA">MONGOLIA</option>
                                            <option value="NETHERLANDS">NETHERLANDS</option>
                                            <option value="NIGERIA">NIGERIA</option>
                                            <option value="PAKISTAN">PAKISTAN</option>
                                            <option value="PANAMA">PANAMA</option>
                                            <option value="PARAGUAY">PARAGUAY</option>
                                            <option value="PHILIPPINES">PHILIPPINES</option>
                                            <option value="PORTUGAL">PORTUGAL</option> 
                                            <option value="QATAR">QATAR</option>
                                            <option value="REPUBLIC OF KOREA">REPUBLIC OF KOREA</option>
                                            <option value="RUSSIA">RUSSIA</option>
                                            <option value="RWANDA">RWANDA</option>
                                            <option value="SAUDI ARABIA">SAUDI ARABIA</option>
                                            <option value="SLOVENIA">SLOVENIA</option>
                                            <option value="SOUTH AFRICA">SOUTH AFRICA</option>
                                            <option value="SWEDEN">SWEDEN</option>
                                            <option value="SWITZERLAND">SWITZERLAND</option>
                                            <option value="TOGO">TOGO</option>
                                            <option value="TUNISIA">TUNISIA</option>
                                            <option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option>
                                            <option value="UNITED KINGDOM">UNITED KINGDOM</option>
                                            <option value="UNITED STATES OF AMERICA">UNITED STATES OF AMERICA</option>
                                            <option value="VENEZUELA">VENEZUELA</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="iaea" style="display:none;">
                                    <div class="form-group col-lg-4">
                                        <label>Select first country preference for your council of second preference</label>
                                        <select onchange="toggleDisabilitycouncil2(this);" name="country1_council2" class="council2ch form-control">
                                            <option disabled selected>Choose your option</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Australia">Australia</option>
                                            Azerbaijan
                                            Belgium
                                            Brazil
                                            Bulgaria
                                            Cameroon
                                            Canada
                                            Chad
                                            Chile
                                            China
                                            Congo
                                            Costa Rica
                                            Czech Republic
                                            Denmark
                                            DPRK
                                            Egypt
                                            Finland
                                            France
                                            Germany
                                            Greece
                                            Guatemala
                                            Hungary
                                            Iceland
                                            India
                                            Indonesia
                                            Iran
                                            Iraq
                                            Ireland
                                            Israel
                                            Italy
                                            Japan
                                            Jordan
                                            Kazakhstan
                                            Kyrgyzstan
                                            Libya
                                            Luxembourg
                                            Malaysia
                                            Mauritius
                                            Mexico
                                            Morocco
                                            Netherlands
                                            New Zealand 
                                            Nigeria
                                            Pakistan
                                            Palestine
                                            Panama
                                            Peru
                                            Philippines
                                            Portugal
                                            Romania
                                            Russia
                                            Saudi Arabia
                                            Seychelles
                                            Singapore
                                            South Africa
                                            South Korea
                                            Spain
                                            Sri Lanka
                                            Sweden
                                            Switzerland
                                            Syria 
                                            Thailand 
                                            Tunisia
                                            Turkey
                                            UAE
                                            UK
                                            Ukraine
                                            Uruguay
                                            USA
                                            Vietnam
                                            Yemen 

                                        </select>
                                    </div>
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
            var clch1 = document.getElementById("cl1").value;
            if (clch1=="United Nations Security Council") {
                document.getElementById("unsc").style.display = "initial";                
                document.getElementById("disec").style.display = "none";                
            } else if(clch1=="United Nations General Assembly Disarmament and International Security Council") {
                document.getElementById("disec").style.display = "initial";                
                document.getElementById("unsc").style.display = "none";
            } else {
                document.getElementById("unsc").style.display = "none";
                document.getElementById("disec").style.display = "none";
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