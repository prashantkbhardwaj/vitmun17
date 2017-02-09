<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
	$inmates = $_GET["inmates"];
	$ex_in = explode("_", $inmates);
	if ($ex_in[1]=="") {
		$loop = 1;
		$query = "SELECT * FROM "
	} elseif ($ex_in[2]=="") {
		$loop = 2;
	} else {
		$loop = 3;
	}



	for ($i=0; $i < $loop; $i++) { 
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
		$content .= "Congratulations! You have been selected for the Executive board of VITCMUN 2017 in the <b>".$allot_council."</b> as the <b>".$allot_post."</b>.". $hotel_status ." You will get a call from us very soon about the details.<br>We look forward to see you in the council. :) ";
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
		 
		$mail->Subject = 'Regarding your application for the Executive Board of VITCMUN 2017';
		$mail->Body    = $content;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $mail->ErrorInfo;
		   exit;
		} 
	}

	redirect_to("eb.php?status=1");
?>
