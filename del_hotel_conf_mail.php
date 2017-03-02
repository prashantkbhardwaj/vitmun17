<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

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
$content .= "Congratulations! Your request for accommodation has been approved for VITCMUN 2017. You have been allotted in <b><a href='http://www.southernresidency.com/'>Southern Residency, Kellambakkam, Chennai</a>.</b> Your payment and participation has been <b>confirmed</b>. <br>We look forward to see you in the council. :) ";
$content .= "</p><br><br> ";
$content .= "<p> ";
$content .= "<b>Regards<br>Prashant Bhardwaj<br>Technical Head<br>VITCMUN 2017</b> ";
$content .= "</p> ";
$content .= "</body> ";
$content .= "</html>";

// registration bill html ends

require 'admin/public/PHPMailer-master/PHPMailerAutoload.php';

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
 
$mail->Subject = 'Payment confirmed for accommodation of VITCMUN 2017';
$mail->Body    = $content;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
} 

	redirect_to("del_hotel_conf_land.php");
?>
