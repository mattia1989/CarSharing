<?php
require ('./libs/PHPMailer/class.phpmailer.php');

/**
 * Description of UEmail
 *
 * @author mdl
 */
class UEmail {

    private $mail;
    
    public function sendMail($paramEmailDestinatario, $paramNomeDestinatario, $paramOggetto, $paramTestoMail) {
       
       // Setto i parametri
       
       $this->mail = new PHPMailer();
       $this->mail = IsSendmail();
       $this->mail = AddAddress($paramEmailDestinatario, $paramNomeDestinatario);
       $mittente = $this->mail->SetFrom('localhost/CarSharing', 'CarSharing');
       $this->mail->Subject = $paramOggetto;
       $this->mail->Body = $paramTestoMail;
       $this->mail->IsHTML(TRUE);
       $headers = 'FromName: CarSharing'; // Completare
       
       // Invio
       
       mail($paramEmailDestinatario, $paramOggetto, $paramTestoMail);
       
   }
   
}

?>
