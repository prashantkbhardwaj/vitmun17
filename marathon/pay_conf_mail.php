<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php 
$id = $_GET["id"];

$query = "SELECT * FROM marathon WHERE id = {$id} LIMIT 1";
$result = mysqli_query($conn, $query);
confirm_query($result);
$title = mysqli_fetch_assoc($result);
$email = $title['email'];
$name = $title['fname'];
$rcno = $title['rcno'];

// registration bill html code starts

$content = "<!DOCTYPE html> ";
$content .= "<html> ";
$content .= "<head> ";
$content .= "<title>Bill</title> ";	
$content .= "</head> ";
$content .= "<body style='overflow: hidden;'> ";	
$content .= "<div style='background-color: #20202F; margin-right: 230px;'> ";
$content .= "<header> ";
$content .= "<img src='http://vitcmun.com/marathon/img/vibrance_logo_dark.png' style='width: 80px;height: 80px;margin-right: 300px;'> ";
$content .= "<img src='http://vitcmun.com/marathon/img/vit_logo.png' style='width: 150px;height: 80px; align:right;'> ";
$content .= "</header> ";
$content .= "<h1 style='margin-left: 120px;	font-size: 40px; font-weight: 200px; margin-top: -0.5px; margin-bottom: -50px; color: #E85657;' >Vibrance 2017</h1><br> ";
$content .= "<h3 style='margin-bottom: 0;margin-top: 0;	margin-left: 10px; color: #E85657;'>Bill No: <span>".$rcno."</span></h3><h3 style='margin-left: 160px;font-size: 18px;font-weight: 40px;margin-top: -2.5px;margin-bottom: 15px; color: #E85657;'>Electronic registration slip</h3> ";
$content .= "<br> ";
$content .= "<div style='font-size: 18px;margin-bottom: 12px;padding-bottom: 12px;margin-left: 12px;'> ";
$content .= "<div style='margin-top: -12px;display: block;margin-right: 10px;margin-left: 10px;margin-bottom: -1px;background-color: #2292A4;'> ";
$content .= "<form style='font-size: 18px;margin-bottom: 12px;padding-bottom: 12px;margin-left: 12px;'> ";
$content .= "<table style='border-collapse: collapse;margin-top: 2px;'> ";
$content .= "<tr style='margin-top: 12px;'> ";
$content .= "<td style='padding-top: 5px;padding-bottom: 5px; color: #ffffff;'> ";
$content .= "Event Name: ";
$content .= "</td> ";
$content .= "<td style='padding-right: 12px; color: #ffffff;'> ";
$content .= "<span>Marathon</span> ";
$content .= "</td> ";
$content .= "</tr> ";
$content .= "<tr style='margin-top: 12px;'> ";
$content .= "<td style='padding-top: 5px;padding-bottom: 5px; color: #ffffff;'>Name of the Participant: </td> ";
$content .= "<td style='padding-right: 12px; color: #ffffff;'> ".ucfirst($title['fname'])." ".ucfirst($title['lname'])."</td> ";
$content .= "</tr> ";

$content .= "<tr style='margin-top: 12px;'> ";
$content .= "<td style='padding-top: 5px;padding-bottom: 5px; color: #ffffff;'>Event Registration Fee: </td> ";
$content .= "<td style='padding-right: 12px; color: #ffffff;'> Rs. 206</td> ";
$content .= "</tr> ";
$content .= "</table> ";
$content .= "</div> ";
$content .= "</form> ";
$content .= "<div style='height: 10px;'></div> ";
$content .= "</div> ";
$content .= "</div> ";
$content .= "</body> ";
$content .= "</html>";

// registration bill html ends

require 'admin/public/PHPMailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer;
 
$mail->isSMTP();                                      
$mail->Host = 'smtp.gmail.com';                       
$mail->SMTPAuth = true;                               
$mail->Username = 'vibrancechennai@gmail.com';                   
$mail->Password = 'NayaWala';               
$mail->SMTPSecure = 'tls';                            
$mail->Port = 587;                                    
$mail->setFrom('vibrancechennai@gmail.com', 'Vibrance 2017');
$mail->addAddress("$email");       
$mail->WordWrap = 50; 
$mail->isHTML(true);                                  
 
$mail->Subject = 'Marathon payment confirmation for Vibrance 2017';
$mail->Body    = $content;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
} 

	redirect_to("pay_conf_land.php");
?>
