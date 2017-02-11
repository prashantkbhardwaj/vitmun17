<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
	$inmates = $_GET["inmates"];
	$ex_in = explode("_", $inmates);
	
		
	$query = "SELECT * FROM eb_apps WHERE id = {$ex_in[0]} LIMIT 1";
	$result = mysqli_query($conn, $query);
	$list = mysqli_fetch_assoc($result);
	$name = $list['name'];
	$room = $list['room'];
	$mates = "Your roommates are ";		

	$query1 = "SELECT * FROM eb_apps WHERE id = {$ex_in[1]} LIMIT 1";
	$result1 = mysqli_query($conn, $query1);
	$list1 = mysqli_fetch_assoc($result1);
	

	$query2 = "SELECT * FROM eb_apps WHERE id = {$ex_in[2]} LIMIT 1";
	$result2 = mysqli_query($conn, $query2);
	$list2 = mysqli_fetch_assoc($result2);		

	$mate = $list1['name']." and ".$list2['name'];
	$email = $list['email'];

	
	$content = "<!DOCTYPE html> ";
	$content .= "<html> ";
	$content .= "<head> ";
	$content .= "<title>Accommodation</title> ";	
	$content .= "</head> ";
	$content .= "<body style='overflow: hidden;'> ";
	$content .= "<p> ";
	$content .= "<b>Dear ".ucfirst($name)."</b> ";
	$content .= "</p><br><br> ";
	$content .= "<p> ";
	$content .= "Congratulations! Your request for accommodation has been approved for VITCMUN 2017. You have been allotted room number <b>".$room." in Southern Residency, Kellambakkam, Chennai.</b>".$mates."<b>".$mate."</b> We look forward to having you here. :) ";
	$content .= "</p><br><br> ";
	$content .= "<p> ";
	$content .= "<b>Regards<br>VITCMUN 2017 Team</b> ";
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
	 
	$mail->Subject = 'Regarding your accommodation request for VITCMUN 2017';
	$mail->Body    = $content;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
	   echo 'Message could not be sent.';
	   echo 'Mailer Error: ' . $mail->ErrorInfo;
	   exit;
	} 
	

	redirect_to("hotel.php");
?>
