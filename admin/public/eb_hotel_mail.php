<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
	$eb_id = $_GET["eb_id"];

	$query = "SELECT * FROM eb_apps WHERE id = {$eb_id} LIMIT 1";
	$result = mysqli_query($conn, $query);
	confirm_query($result);
	$list = mysqli_fetch_assoc($result);
	$name = $list['name'];
	$email = $list['email'];

	$allot_query = "UPDATE eb_apps SET allot_hotel = 1, hotel_by = '{$_SESSION["username"]}' WHERE id = {$eb_id} LIMIT 1";
    $allot_result = mysqli_query($conn, $allot_query);
    confirm_query($allot_result);

    if ($allot_result) {
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
		$content .= "Congratulations! Your request for accommodation has been approved for VITCMUN 2017. You have been allotted in <b><a href='http://www.southernresidency.com/'>Southern Residency, Kellambakkam, Chennai</a>.</b> We look forward to having you here. :) ";	
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
		 
		$mail->Subject = 'Regarding your accommodation request for VITCMUN 2017';
		$mail->Body    = $content;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $mail->ErrorInfo;
		   exit;
		} 
		

		redirect_to("hotel.php?status=1");
    }
		
	
?>
