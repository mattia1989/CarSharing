<?php
/**
 * Created by PhpStorm.
 * User: Mattia Di Luca
 * Date: 15/02/2016
 * Time: 03:18
 */
error_reporting(E_ALL);
require ('./PHPMailerAutoload.php');
require ('./class.phpmailer.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "ssl";
$mail->SMTPDebug = 4;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "mattiadiluca@gmail.com";
$mail->Password = '';

// intestazione

$mail->From = 'info@CarSharing.it';
$mail->AddAddress('matt.1989@yahoo.it');
$mail->AddReplyTo('mattiadiluca@gmail.com');
$mail->Subject = 'test subject';
$mail->Body = 'testo di beta testing';

// gestisco l'invio

if (!$mail->Send()) {
    echo $mail->ErrorInfo;
} else {
    echo 'email inviati correttamente';
}

// chiudo la connessione

$mail->SmtpClose();
unset($mail);

?>