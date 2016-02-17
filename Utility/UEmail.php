<?php

/**
 * Description of UEmail
 *
 * @author mdl
 */
class UEmail {

    public static function sendMail($paramEmailDestinatario, $paramNomeDestinatario, $paramOggetto, $paramTestoMail) {

       // Setto i parametri

       $mail = new PHPMailer();
       $mail->IsSMTP();
       $mail->Host = "smtp.gmail.com";
       $mail->SMTPSecure = "ssl";
       $mail->Port = 465;
       $mail->SMTPAuth = true;
       $mail->Username = "mattiadiluca@gmail.com";
       $mail->Password = 'matt89ii';

       // intestazione

       $mail->From = 'info@CarSharing.it';
       $mail->AddAddress($paramEmailDestinatario);
       $mail->AddReplyTo('mattiadiluca@gmail.com');
       $mail->Subject = $paramOggetto;
       $mail->Body = $paramTestoMail;

       // gestisco l'invio

       if (!$mail->Send()) {
          echo $mail->ErrorInfo;
       } else {
          echo 'email inviati correttamente';
       }

       // chiudo la connessione

       $mail->SmtpClose();
       unset($mail);

   }
   
}

?>
