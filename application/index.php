<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php
	if (isset($_POST['submit'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$council = $_POST['council'];
		$ce = explode("/", $_POST['country']);
		$cep = explode(".", $ce[2]);
		$country = $cep[0];
		$details = $_POST['details'];
		$phone = $_POST['phone'];

		$query = "INSERT INTO delegates (name, email, council, country, details, phone)";
        $query .= " VALUES ('{$name}', '{$email}', '{$council}', '{$country}', '{$details}', '{$phone}')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            redirect_to("../payment_select.php");
        } else {
            redirect_to("../team.html");
        }
	}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>VITC Inter MUN 2016 | Applications</title>
		<meta name="description" content="VIT chennai inter MUN applications" />
		<meta name="keywords" content="VIT chennai, MUN, VIT chennai inter MUN" />
		<meta name="author" content="Prashant Bhardwaj" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/cs-select.css" />
		<link rel="stylesheet" type="text/css" href="css/cs-skin-boxes.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body>
		<div class="container">

			<div class="fs-form-wrap" id="fs-form-wrap">
				<div class="fs-title">
					<span><a href="../index.html"><img height="15%" width="15%" src="../img/logo_title.png"></a></span>
					<center><h2>Delegate application</h2><hr></center>		
				</div>
				<form action="index.php" method="post" id="myform" class="fs-form fs-form-full" autocomplete="off">
					<ol class="fs-fields">
						<li>
							<label class="fs-field-label fs-anim-upper" for="name">What's your name?</label>
							<input class="fs-anim-lower" id="q1" name="name" type="text" placeholder="Call me Batman." required/>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="email" data-info="We won't send you spam, we promise...">What's your email address?</label>
							<input class="fs-anim-lower" id="q2" name="email" type="email" placeholder="pablo.escobar@cali.com" required/>
						</li>
						<li data-input-trigger> 
							<label class="fs-field-label fs-anim-upper" for="council" data-info="This will help us know what kind of council you need">What's your priority for your council?</label>
							<div class="fs-radio-group fs-radio-custom clearfix fs-anim-lower">
								<span><input id="q3b" name="council" type="radio" value="disec"/><label for="q3b" class="radio-disec">UN-DISEC</label></span>
								<span><input id="q3c" name="council" type="radio" value="hrc"/><label for="q3c" class="radio-hrc">UN-HRC</label></span>
								<span><input id="q3a" name="council" type="radio" value="sc"/><label for="q3a" class="radio-sc">UN-SC</label></span>
								<span><input id="q3a" name="council" type="radio" value="crisis"/><label for="q3a" class="radio-crisis">UN-CRISIS</label></span>
								<span><input id="q3a" name="council" type="radio" value="specpol"/><label for="q3a" class="radio-specpol">UN-SPECPOL</label></span>
							</div>
						</li>
						<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" data-info="We'll make sure to get you what you need.">Choose a country.</label>
							<select name="country" class="cs-select cs-skin-boxes fs-anim-lower">
								<option value="" disabled selected>Pick a country</option>
								<option value="img/flags/ad.png" data-class="color-588c75">AD</option>
								<option value="img/flags/af.png" data-class="afganistan">Afganistan</option>
								<option value="img/flags/in.png" data-class="color-f3e395">India</option>
								<option value="#f3ae73" data-class="color-f3ae73">#f3ae73</option>
								<option value="#da645a" data-class="color-da645a">#da645a</option>
								<option value="#79a38f" data-class="color-79a38f">#79a38f</option>
								<option value="#c1d099" data-class="color-c1d099">#c1d099</option>
								<option value="#f5eaaa" data-class="color-f5eaaa">#f5eaaa</option>
								<option value="#f5be8f" data-class="color-f5be8f">#f5be8f</option>
								<option value="#e1837b" data-class="color-e1837b">#e1837b</option>
								<option value="#9bbaab" data-class="color-9bbaab">#9bbaab</option>
								<option value="#d1dcb2" data-class="color-d1dcb2">#d1dcb2</option>
								<option value="#f9eec0" data-class="color-f9eec0">#f9eec0</option>
								<option value="#f7cda9" data-class="color-f7cda9">#f7cda9</option>
								<option value="#e8a19b" data-class="color-e8a19b">#e8a19b</option>
								<option value="#bdd1c8" data-class="color-bdd1c8">#bdd1c8</option>
								<option value="#e1e7cd" data-class="color-e1e7cd">#e1e7cd</option>
								<option value="#faf4d4" data-class="color-faf4d4">#faf4d4</option>
								<option value="#fbdfc9" data-class="color-fbdfc9">#fbdfc9</option>
								<option value="#f1c1bd" data-class="color-f1c1bd">#f1c1bd</option>
							</select>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="details">Describe about your past experience</label>
							<textarea class="fs-anim-lower" id="q4" name="details" placeholder="I have been a badass delegate."></textarea>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="phone">The number we can call on?</label>
							<input class="fs-mark fs-anim-lower" id="q5" name="phone" type="number" placeholder="Call me maybe?." />
						</li>
						<!--<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" data-info="We'll make sure to get you what you need.">Need accomodation?.</label>
							<select name="hotel" class="cs-select cs-skin-boxes fs-anim-lower">
								<option value="" disabled selected>Pick a choice</option>
								<option value="img/tick_square.png" data-class="color-f3ae73">Yes</option>
								<option value="img/flags/af.png" data-class="afganistan">Afganistan</option>
							</select>
						</li>-->
					</ol><!-- /fs-fields -->
					<input type="submit" value="Submit and select payment method" name="submit"  class="fs-submit"> 
				</form><!-- /fs-form -->
			</div><!-- /fs-form-wrap -->			
			

		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/selectFx.js"></script>
		<script src="js/fullscreenForm.js"></script>
		<script>
			(function() {
				var formWrap = document.getElementById( 'fs-form-wrap' );

				[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
					new SelectFx( el, {
						stickyPlaceholder: true,
						onChange: function(val){
							console.log(el);
							document.querySelector('span.cs-placeholder').style.backgroundImage = 'url('+val+')';
							document.querySelector('span.cs-placeholder').style.backgroundSize = "150px 120px";
						}
					});
				} );

				new FForm( formWrap, {
					onReview : function() {
						classie.add( document.body, 'overview' ); // for demo purposes only
					}
				} );
			})();
		</script>
	</body>
</html>
<?php
if (isset ($conn)){
	mysqli_close($conn);
}
?>