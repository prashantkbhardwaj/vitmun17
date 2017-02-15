<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php    
    $del_id = $_GET['del_id'];
    $name_query = "SELECT * FROM delegates WHERE id = {$del_id} LIMIT 1";
    $name_result = mysqli_query($conn, $name_query);
    confirm_query($name_result);
    $name_title = mysqli_fetch_assoc($name_result);    
?>
<?php
	$status=$_POST["status"];
	$firstname=$_POST["firstname"];
	$amount=$_POST["amount"];
	$txnid=$_POST["txnid"];
	$posted_hash=$_POST["hash"];
	$key=$_POST["key"];
	$productinfo=$_POST["productinfo"];
	$email=$_POST["email"];
	$salt="6XG2QugoqF";	

	If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
       $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;        
    }else {	  
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
    }

	$hash = hash("sha512", $retHashSeq);
		 
    if ($hash != $posted_hash) {
	    echo "Invalid Transaction. Please try again";
	} else {           	   
        if ($status=="success") {
        	$update_query = "UPDATE delegates SET pay_status = 1, pay_type = 1, txnid = '{$txnid}' WHERE id = {$del_id} LIMIT 1";
        	$update_result = mysqli_query($conn, $update_query);
        	confirm_query($update_result);
        	if ($update_result) {
        		redirect_to("del_pay_conf_land.php");
        	}
        }              
	}     
?>


<?php
if (isset ($conn)){
    mysqli_close($conn);
}
?>