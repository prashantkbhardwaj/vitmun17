<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

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
        	$update_query = "UPDATE delegates SET pay_status = 1, pay_type = 1, txnid = '{$txnid}' WHERE id = {$firstname} LIMIT 1";
        	$update_result = mysqli_query($conn, $update_query);
        	confirm_query($update_result);
        	if ($update_result) {
        		redirect_to("del_pay_conf_mail.php?del_id=$firstname");
        	}
        }              
	}     
?>


<?php
if (isset ($conn)){
    mysqli_close($conn);
}
?>