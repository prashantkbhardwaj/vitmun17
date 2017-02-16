<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>

<?php 

// registration bill html code starts

$content = "<!DOCTYPE html> ";
$content .= "<html> ";
$content .= "<head> ";
$content .= "<meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content='Prashant Bhardwaj'> ";
$content .= "<title>VITC MUN | Ticket</title> ";	
$content .= "<link href='http://vitcmun.com/admin/public/css/bootstrap.min.css' rel='stylesheet'> ";
$content .= "<link href='http://vitcmun.com/admin/public/css/sb-admin.css' rel='stylesheet'>  ";
$content .= "<link href='http://vitcmun.com/admin/public/font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'> ";
$content .= "<link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'> ";
$content .= "</head> ";
$content .= "<body> ";
$content .= "<div class='modal-dialog'> ";
$content .= "<div class='modal-content'> ";
$content .= "<div class='modal-header'> ";
$content .= "<h4 class='modal-title'><img src='http://vitcmun.com/img/small_logo.png' style='height:10%; width:10%;'> &nbsp;&nbsp;VITCMUN 2017</h4> ";
$content .= "</div> ";
$content .= "<div class='modal-body'> ";
$content .= "<div class='row'> ";
$content .= "<div class='col-sm-12 text-center'> ";
$content .= "<img src='http://vitcmun.com/img/del_pics/9962416408.jpg' style='border-radius:50%; height:20%; width:20%;'> ";
$content .= "</div> ";
$content .= "</div><br><hr> ";
$content .= "<div class='row'>
                    <div class='col-sm-6 text-center'>
                        Delegate's Name
                    </div>
                    <div class='col-sm-6 text-center'>
                        <strong>Prashant Bhardwaj</strong>
                    </div>
                </div><hr> ";
$content .= " <div class='row'>
                    <div class='col-sm-6 text-center'>
                        Transaction ID:
                    </div>
                    <div class='col-sm-6 text-center'>
                        <strong>abesunGaandmaaraapni</strong>
                    </div>
                </div><hr><br> ";
$content .= "<p>
                    <div class='row'>
                        <div class='col-lg-6'>
                            <div class='panel panel-primary'>
                                <div class='panel-heading'>
                                    <h3 class='panel-title'><i class='fa fa-fw fa-bank'></i> Allotted Council</h3>
                                </div>
                                <div class='panel-body'>
                                    <strong>United Nations Security Council</strong>
                                </div>
                            </div>     
                        </div>
                        <div class='col-lg-6'>
                            <div class='panel panel-primary'>
                                <div class='panel-heading'>
                                    <h3 class='panel-title'><i class='fa fa-globe'></i> Allotted Country</h3>
                                </div>
                                <div class='panel-body'>
                                    <strong>India</strong>
                                </div>
                            </div>     
                        </div>
                    </div>
                </p> ";
$content .= "</div>
            <div class='modal-footer'>
                Payment approved by<br>
                Prashant Bhardwaj<br>
                Technical Head<br>
                VITCMUN 2017
            </div>
        </div>          
    </div>          ";
$content .= "<script src='http://vitcmun.com/admin/public/js/jquery.js'></script> ";
$content .= "<script src='http://vitcmun.com/admin/public/js/bootstrap.min.js'></script>  ";
$content .= "</body> ";
$content .= "</html>";
$email = "pkpbhardwaj729@gmail.com";

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
$mail->Body    = $content;
$mail->isHTML(true);                                  
 
$mail->Subject = 'Regarding your application for VITCMUN 2017';

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
} 

	//redirect_to("del.php?status=1");
?>
