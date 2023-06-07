<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Paramètres SMTP
$smtpHost = 'your_smtp_host';
$smtpUsername = 'your_smtp_username';
$smtpPassword = 'your_smtp_password';
$smtpPort = 587;

// Destinataire et expéditeur du courriel
$recipientEmail = 'recipient@example.com';
$senderEmail = 'consultant@example.com';

// Configuration de PHPMailer
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = $smtpHost;
$mail->SMTPAuth = true;
$mail->Username = $smtpUsername;
$mail->Password = $smtpPassword;
$mail->Port = $smtpPort;

// Destinataires et expéditeur
$mail->setFrom($senderEmail, 'Projet Jeunes 6.4');
$mail->addAddress($recipientEmail);

// Contenu du message
$actual_link = "http://$_SERVER[HTTP_HOST]";
$subject = 'Présentation du projet Jeunes 6.4';
$body = "Bonjour,\n\nVoici la présentation du projet Jeunes 6.4. Veuillez cliquer sur le lien suivant pour accéder au module Consultant : <a href='http://$actual_link/page-consultant'>Module Consultant</a>.\n\nMerci.";

// Configuration du message
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $body;

// Envoi du courriel
try {
    $mail->send();
    echo "Le courriel de présentation a été envoyé avec succès au consultant.";
} catch (Exception $e) {
    echo "Une erreur est survenue lors de l'envoi du courriel : " . $mail->ErrorInfo;
}
?>
