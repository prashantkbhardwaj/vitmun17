<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
$del_id = $_GET["del_id"];

$query = "SELECT * FROM delegates WHERE id = {$del_id} LIMIT 1";
$result = mysqli_query($conn, $query);
confirm_query($result);
$title = mysqli_fetch_assoc($result);
$email = $title['email'];
$name = $title['name'];
$allot_council = $title['allot_council'];
$allot_country = $title['allot_country'];
if ($title['in_out']==0) {
	$in_out = "Click <a href='http://vitcmun.com/payment_select.php?del_id=".$del_id."'><b>here</b></a> to pay the delegate fee of Rs. 1341.2 inclusive of all taxes and confirm your seat. Please <b>DO NOT</b> change the email given in the payment portal. Let it be as pkpbhardwaj729@gmail.com. Since you are an internal delegate, you also have an option to pay the fee of Rs. 1300 on our payment desks around the campus.";
} elseif ($title['in_out']==1) {
	$in_out = "Click <a href='http://vitcmun.com/payment_select.php?del_id=".$del_id."'><b>here</b></a> to pay the delegate fee of Rs. 1341.2 inclusive of all taxes and confirm your seat. Please <b>DO NOT</b> change the email given in the payment portal. Let it be as pkpbhardwaj729@gmail.com.";
}


// registration bill html code starts

$content = "<!DOCTYPE html> ";
$content .= "<html> ";
$content .= "<head> ";
$content .= "<title>Acceptance</title> ";	
$content .= "</head> ";
$content .= "<body style='overflow: hidden;'> ";
$content .= "<p> ";
$content .= "<b>Dear ".ucfirst($name)."</b> ";
$content .= "</p><br><br> ";
$content .= "<p> ";
$content .= "Congratulations! You have been allotted <b>".$allot_council."</b> as <b>".$allot_country."</b>. ".$in_out."<br>The last day of fee payment is 21st of February. Please complete your payment before the deadline to confirm your participation.<br>We look forward to see you in the council. :) ";
$content .= "</p><br><br> ";
$content .= "<p> ";
$content .= "<b>Regards<br>Prashant Bhardwaj<br>Technical Head<br>VITCMUN 2017</b> ";
$content .= "</p> ";
$content .= "</body> ";
$content .= "</html>";

// registration bill html ends

require 'PHPMailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer;
 
$mail->isSMTP();                                      
$mail->Host = 'smtp.gmail.com';                       
$mail->SMTPAuth = true;                               
$mail->Username = 'VITCMUN2017@gmail.com';                   
$mail->Password = '25nov1992';               
$mail->SMTPSecure = 'tls';                            
$mail->Port = 587;                                    
$mail->setFrom('VITCMUN2017@gmail.com', 'VITCMUN 2017');
$mail->addAddress("$email");       
$mail->WordWrap = 50; 
$mail->isHTML(true);                                  
 
$mail->Subject = 'Regarding your application for VITCMUN 2017';
$mail->Body    = $content;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
} 

	redirect_to("del.php?status=1");
?>
