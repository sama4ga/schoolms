<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function send_email($email,$body,$subject,$client_name){
  require_once('vendor/autoload.php');

  $mail = new PHPMailer(true);

  date_default_timezone_set('Africa/Lagos');

  $mail->isSMTP();
  $mail->SMTPDebug = 0;
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;             
  $mail->Username = 'mauriceoscar58@gmail.com';
  $mail->Password = 'maurice5782';           
  $mail->SMTPSecure = 'tls';                   
  $mail->Port = 25;

  $mail->setFrom('mauriceafiakinye@gmail.com', 'Infant Jesus Schools');
  //Set an alternative reply-to address
  $mail->addReplyTo('mauriceafiakinye@gmail.com', 'Infant Jesus Schools');
  //Set who the message is to be sent to
  $mail->addAddress($email, $client_name);

  $mail->isHTML(true);                                  
  $mail->Subject = $subject;
  $mail->Body    = $body;
  $mail->AltBody = $body;
  //Attach an image file
  //$mail->addAttachment('images/phpmailer_mini.png');

  //send the message, check for errors
  if (!$mail->send()) {
      return "Mailer Error: " . $mail->ErrorInfo;
  } else {
      return "true";
  }


}



?>