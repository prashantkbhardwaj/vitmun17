<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php
	$total_query = "SELECT COUNT(id) FROM delegates WHERE pay_status = 1";
	$total_result = mysqli_query($conn, $total_query);
	confirm_query($total_result);
	$total = mysqli_fetch_array($total_result);
   	echo "Total collection: ".$total[0];  

   	$online_query = "SELECT COUNT(id) FROM delegates WHERE pay_status = 1 AND pay_type = 1";
	$online_result = mysqli_query($conn, $online_query);
	confirm_query($online_result);
	$online = mysqli_fetch_array($online_result);
   	echo "online collection: ".$online[0];  

   	$paytm_query = "SELECT COUNT(id) FROM delegates WHERE pay_status = 1 AND pay_type = 3";
	$paytm_result = mysqli_query($conn, $paytm_query);
	confirm_query($paytm_result);
	$paytm = mysqli_fetch_array($paytm_result);
   	echo "paytm collection: ".$paytm[0];  

   	$offline_query = "SELECT COUNT(id) FROM delegates WHERE pay_status = 1 AND pay_type = 2";
	$offline_result = mysqli_query($conn, $offline_query);
	confirm_query($offline_result);
	$offline = mysqli_fetch_array($offline_result);
   	echo "offline collection: ".$offline[0];  
	
?>
