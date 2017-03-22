<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
    $getEmail = $_GET['eid'];
    $arremail = explode("_", $getEmail);
    $email = $arremail[0]."@".$arremail[1];
    $query = "SELECT * FROM marathon WHERE email = '{$email}' LIMIT 1";
    $result = mysqli_query($conn, $query);
    confirm_query($result);
    $idList = mysqli_fetch_assoc($result);
    $id = $idList['id'];
?>
<?php
    $MERCHANT_KEY = "eA0dOuuq";
    $SALT = "6XG2QugoqF";
    $PAYU_BASE_URL = "https://secure.payu.in";
    $action = '';
    $posted = array();

    if(!empty($_POST)) {    
        foreach($_POST as $key => $value) {    
            $posted[$key] = $value;     
        }
    }

    $formError = 0;

    if(empty($posted['txnid'])) {  
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    } else {
        $txnid = $posted['txnid'];
    }
    
    $hash = '';

    $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
    if(empty($posted['hash']) && sizeof($posted) > 0) {
        if(
            empty($posted['key'])
            || empty($posted['txnid'])
            || empty($posted['amount'])
            || empty($posted['firstname'])
            || empty($posted['email'])
            || empty($posted['phone'])
            || empty($posted['productinfo'])
            || empty($posted['surl'])
            || empty($posted['furl'])
            || empty($posted['service_provider'])
            || $posted['amount'] != "206"
        ) {
            $formError = 1;
        } else {    
            $hashVarsSeq = explode('|', $hashSequence);
            $hash_string = '';  
            foreach($hashVarsSeq as $hash_var) {
                $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                $hash_string .= '|';
            }

            $hash_string .= $SALT;
            $hash = strtolower(hash('sha512', $hash_string));
            $action = $PAYU_BASE_URL . '/_payment';
        }
    } elseif(!empty($posted['hash'])) {
        $hash = $posted['hash'];
        $action = $PAYU_BASE_URL . '/_payment';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="VIT Chennai Vibrance, Marathon registrations">
    <meta name="author" content="Prashant Bhardwaj">

    <title>Vibrance | Marathon Registration</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        var hash = '<?php echo $hash ?>';
        function submitPayuForm() {
          if(hash == '') {
            return;
          }
          var payuForm = document.forms.payuForm;
          payuForm.submit();
        }
    </script> 

</head>

<body onload="submitPayuForm()">

    <div>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://vitvibrance.com/">Vibrance 2017</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="https://www.facebook.com/VibranceVIT" target="_blank" class="dropdown-toggle"><i class="fa fa-facebook"></i></a>                    
                </li>
                <li class="dropdown">
                    <a href="https://www.instagram.com/vibrancevit/" target="_blank" class="dropdown-toggle"><i class="fa fa-instagram"></i></a>                   
                </li>                
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
           
        </nav>
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <span>
                            
                        </span>
                        <h1 class="page-header text-center">
                            <img src="img/vibrance_logo_dark.png" style="height:8%; width:8%;"> Marathon 2017
                        </h1>
                    </div>
                </div>
                <!-- /.row -->                 
                <div  id="pay" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">                                
                                <h4 class="modal-title">Please click on the button below to pay the fee of <i class="fa fa-inr"></i> 206 and confirm your registration.</h4>
                            </div>
                            <div class="modal-body">
                                <p>                            
                                    <form action="<?php echo $action; ?>" method="post" name="payuForm">
                                        <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
                                        <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                                        <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
                                        <input type="hidden" name="amount" value="206" />
                                        <input type="hidden" name="firstname" id="firstname" value="<?php echo $id; ?>" />
                                        <input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
                                        <input type="hidden" name="phone" value="<?php echo $idList['phno']; ?>" />
                                        <textarea style="display:none;" name="productinfo" >marathon fee</textarea>
                                        <input type="hidden" name="surl" value="http://vitcmun.com/marathon/pay_success.php" />
                                        <input type="hidden" name="furl" value="http://vitcmun.com/marathon/pay_fail.php" />
                                        <input type="hidden" name="service_provider" value="payu_paisa" size="64" />        
                                        <?php if(!$hash) { ?>
                                            <strong>
                                                <input type="submit" value="Pay Now" style="font-size:24px;" class="btn btn-primary col-lg-12">&nbsp;
                                            </strong>                                
                                        <?php } ?>       
                                    </form>                             
                                </p>
                            </div>
                            
                        </div>   <br><br>       
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
<?php
if (isset ($conn)){
  mysqli_close($conn);
}
?>