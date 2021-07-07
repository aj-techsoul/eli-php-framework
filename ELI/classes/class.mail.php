<?php
class MAILER
{

function auth()
{
  require_once('phpmailer/PHPMailerAutoload.php');
  $mail = new PHPMailer;

  $mail->SMTPDebug = 0;                               // Enable verbose debug output
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = $GLOBALS['config']['SmtpServer']; //'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = $GLOBALS['config']['SmtpUser'];  //'user@example.com';                 // SMTP username
  $mail->Password = $GLOBALS['config']['SmtpPass'];                           // SMTP password
  $mail->SMTPSecure = $GLOBALS['config']['SMTPSecure'];                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = $GLOBALS['config']['SmtpPort'];
  return $mail;
}

function email($to,$subject,$body,$isHTML=true,$from="",$replyto="")
{
  if($from=="")
  {
    $from = $GLOBALS['config']['mailFROM'];
  }

  $mail = self::auth();

  $mail->setFrom($from);
  $mail->addAddress($to);     // Add a recipient
  if($replyto!="")
  {
  $mail->addReplyTo($replyto);
  }
  $mail->isHTML($isHTML);
  $mail->Subject = $subject;
  $mail->Body = $body;
  if(!$mail->send()) {
      $retmsg =  'Message could not be sent.';
      $retmsg .=  'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      $retmsg = 'Message has been sent';
  }
return $retmsg;
}

function mail($to,$subject,$body,$attachments="",$isHTML=true,$from="",$replyto="")
{

  if($from=="")
  {
    $from = $GLOBALS['config']['mailFROM'];
  }

  $mail = self::auth();

  $mail->setFrom($from);
  $mail->addAddress($to);     // Add a recipient
  if($replyto!="")
  {
  $mail->addReplyTo($replyto);
  }
  if($attachments!="" && is_array($attachments))
  {
    foreach ($attachments as $filename => $file) {
      $mail->addAttachment($file,$filename);         // Add attachments
    }
  }
  else {
    if(!is_array($attachments) && $attachments!="")
    {
      $files = explode(',', $attachments);
      foreach ($files as $file) {
        $mail->addAttachment($file);
      }
    }
  }
  $mail->isHTML($isHTML);
  $mail->Subject = $subject;
  $mail->Body = $body;
  if(!$mail->send()) {
      $retmsg =  'Message could not be sent.';
      $retmsg .=  'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      $retmsg = 'Message has been sent';
  }
  return $retmsg;

}

///////////
}
?>
