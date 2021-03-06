<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/db_connection.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php require_once("../../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
    $current_user = $_SESSION["username"];
    $name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
    $name_result = mysqli_query($conn, $name_query);
    confirm_query($name_result);
    $name_title = mysqli_fetch_assoc($name_result);    
?>

<?php
	if ($current_user!=="prashant") {
		redirect_to('e404.php');
	}
?>

<?php
if(isset($_POST['submit'])){
	
	$required_fields = array("username", "password");
	validate_presence($required_fields);
	
	$fields_with_max_lengths = array("username" => 200);
	validate_max_lengths($fields_with_max_lengths);

	if (empty($errors)) {
		
		$username = mysql_prep($_POST['username']);	
		$type = $_POST['type'];	
		$hashed_password = password_encrypt($_POST['password']);
					

		$query = "INSERT INTO users (username, type, hashed_password)";
		$query .= " VALUES ('{$username}', {$type}, '{$hashed_password}')";
		$result = mysqli_query($conn, $query);

        if ($result) {
          	$_SESSION["message"] = "Your account created!";	       	
	    } else {
		   	$_SESSION["message"] = "Profile creation failed.";
	    }        	
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head><title>VITMUN'17 Super Admin</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="icon" href="favicon.png" type="image/x-icon">
</head>
<body>
<div id="header">
<h1>VITMUN'17 Super Admin</h1>
</div>
<div id="main">	
	<div id="page">
	<?php echo message(); ?>
	<?php echo form_errors($errors); ?>
	<h2>Sign Up for Admins</h2>
		<p>Please enter your details.</p>
		<p>
		   	<form action="admin_signup.php" method="post">
		   		<table>	   			
		   			<tr>
		   				<td>Username</td>
		   				<td><input type="text" name="username" value="" required /></td>
		   			</tr>
		   			<tr>
		   				<td>Select Admin Type</td>
		   				<td>
		   					<select name="type" required>
		   						<option value="1">Payment Admin</option>
		   						<option value="2">Delegate Affairs Admin</option>
		   						<option value="3">Hospitality Admin</option>
		   						<option value="4">Super Admin</option>
		   						<option value="5">Viewer Admin</option>
		   					</select>
		   				</td>
		   			</tr>
		   			<tr>
		   				<td>Password</td>
		   				<td><input type="password" name="password" id="txtNewPassword" value="" required /></td>
		   			</tr>
		   			<tr>
		   				<td>Repeat Password</td>
		   				<td><input type="password" id="txtConfirmPassword" required /></td>
		   				<td><div class="registrationFormAlert" id="divCheckPasswordMatch" style="margin-left: 160px;"></div></td>
		   			</tr>	   				   			
		   			<tr>
		   				<td><input name="submit" type="submit" value="Submit"></td>
		   			</tr>
		   		</table>			
			</form>
		</p>
	</p>
	</div>
</div>
<script type="text/javascript">
$(function() {
    $("#txtConfirmPassword").keyup(function() {
        var password = $("#txtNewPassword").val();
        $("#divCheckPasswordMatch").html(password == $(this).val() ? "Passwords match." : "Passwords do not match!");
    });

});
</script>
</body>
</html>
<?php
if (isset ($conn)){
	mysqli_close($conn);
}
?>