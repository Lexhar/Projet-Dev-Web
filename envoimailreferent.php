<?php

// Inclure la bibliothèque PHPMailer
require 'vendor/autoload.php';

// Créer une nouvelle instance de PHPMailer
$mail = new PHPMailer(true);

try {
    // Paramètres SMTP
    $smtpHost = 'tea.o2switch.net';
    $smtpUsername = 'jeune070@maebaconsulting';
    $smtpPassword = 'B6NH6bIiET1c';
    $smtpPort = 
    // Configuration SMTP
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
    $mail->SMTPSecure = 'tls';
    $mail->Port = $smtpPort;

    // Destinataire et expéditeur
    $recipientEmail = 'emessienerachel@gmail.com';
    $senderEmail = 'jeune070@gmail.com';

    // Contenu du message
    $actual_link = "http://$_SERVER[HTTP_HOST]";
    $subject = 'Présentation du projet Jeunes 6.4';
    $body = 'Bonjour,<br><br>Vous avez reçu une demande de référence sur le projet Jeunes 6.4.<br><br>Veuillez cliquer sur le lien suivant pour confirmer votre participation : <a href="http://$actual_link/page-référent">Confirmer la demande</a><br><br>Cordialement,<br>L\'équipe Jeunes 6.4';

    // Configurer le destinataire et l'expéditeur
    $mail->setFrom($senderEmail);
    $mail->addAddress($recipientEmail);

    // Contenu du message
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;

    // Envoyer le courriel
    $mail->send();

    echo 'Le courriel de présentation a été envoyé avec succès au référent.';
} catch (Exception $e) {
    echo 'Une erreur est survenue lors de l\'envoi du courriel : ' . $mail->ErrorInfo;
}

?>