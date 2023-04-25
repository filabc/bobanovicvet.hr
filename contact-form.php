<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
//////////////////////////
//Specify default values//
//////////////////////////

//Your E-mail
$your_email = 'your@email.com';

//Default Subject if 'subject' field not specified
$default_subject = 'From My Contact Form';

//Message if 'name' field not specified
$name_not_specified = 'Please type a valid name';

//Message if e-mail sent successfully
$email_was_sent = 'Thanks, your message successfully sent';

//Message if e-mail not sent (server not configured)
$server_not_configured = 'Sorry, mail server not configured (function "mail()" disabled on your server?)';


///////////////////////////
//Contact Form Processing//
///////////////////////////
$errors = array();

//"name" field required by this PHP script even if 
// there are no 'aria-required="true"' or 'required' 
// attributes on this HTML input field
if(isset($_POST['name'])) {
	
	if(!empty($_POST['name']))
		$sender_name  = stripslashes(strip_tags(trim($_POST['name'])));
	
	if(!empty($_POST['message']))
		$message      = stripslashes(strip_tags(trim($_POST['message'])));
	
	if(!empty($_POST['email']))
		$sender_email = stripslashes(strip_tags(trim($_POST['email'])));
	
	if(!empty($_POST['subject']))
		$subject      = stripslashes(strip_tags(trim($_POST['subject'])));


	//Message if no sender name was specified
	if(empty($sender_name)) {
		$errors[] = $name_not_specified;
	}

	$from = (!empty($sender_email)) ? 'From: '.$sender_email : '';

	$subject = (!empty($subject)) ? $subject : $default_subject;

    $message = 
    "<div>
        <p>Od: ".$sender_name."</p>
        <p>Email: ".$sender_email."</p>
        <p>Naslov: ".$subject."</p>
        <p>Poruka:</p>
        <p>".$message."</p>
    </div>";

	//sending message if no errors
	if(empty($errors)) {
	    $mail = new PHPMailer;
	    $mail->Host = 'mail.bobanovicvet.hr';
        $mail->SMTPAuth = true;
        $mail->Username = 'autoreply@bobanovicvet.hr'; 
        $mail->Password = 'rmQ3~g2m9QLI';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 465;
        $mail->isHTML(true);
        $mail->setFrom('contact@bobanovicvet.hr', 'Kontakt Forma - '.$sender_name);
        $mail->addAddress('filabc@gmail.com');
        $mail->Subject  = $subject;
        $mail->Body     = $message;
        if(!$mail->send()) {
          echo 'Message was not sent.';
          echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
          echo 'Message has been sent.';
        }
	} else {
		echo '<span class="form-errors">' . implode('<br>', $errors ) . '</span>';
	}
} else {
	// if "name" var not send ('name' attribute of contact form input field was changed or missing)
	echo '"name" variable were not received by server. Please check "name" attributes for your input fields';
}
?>