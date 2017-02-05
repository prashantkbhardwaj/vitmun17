<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php
	if (isset($_POST['submit'])) {
		$val = htmlentities($_POST['ch']);
		$query = "INSERT INTO councils (name) VALUE('{$val}')";
		$result = mysqli_query($conn, $query);
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="test.php">
		<select name="ch">
			<option value="Meghan L. O’Sullivan">Meghan L. O’Sullivan</option>
		</select>
		<input type="submit" name="submit" value="submit">
	</form>
</body>
</html>