<?php

session_start(); // Démarrage de la session

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification si les champs sont remplis
    if (!empty($_POST['commentaire']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['date']) && !empty($_POST['mail']) && !empty($_POST['reseau']) && !empty($_POST['presentation']) && !empty($_POST['duree']) && isset($_POST['savoir_etre'])) {
        // Récupération des données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date = $_POST['date'];
        $mail = $_POST['mail'];
        $reseau = $_POST['reseau'];
        $presentation = $_POST['presentation'];
        $duree = $_POST['duree'];
        $savoir_etre = $_POST['savoir_etre']; // $savoir_etre est un tableau contenant les valeurs sélectionnées

        // Construction de la demande de référence
        $demande_reference = array(
            'nom' => $nom,
            'prenom' => $prenom,
            'date' => $date,
            'mail' => $mail,
            'reseau' => $reseau,
            'presentation' => $presentation,
            'duree' => $duree,
            'savoir_etre' => $savoir_etre
        );

        // Stockage de la demande de référence dans la session (ou base de données)
        $_SESSION['demande_reference'] = $demande_reference;

        // Envoi du courriel de présentation au Référent avec le lien de confirmation
        $email_subject = "Présentation du projet Jeunes 6.4 - Demande de référence";
       
       // Inclure la bibliothèque PHPMailer
require 'vendor/autoload.php';

// Créer une nouvelle instance de PHPMailer
$mail = new PHPMailer(true);

try {
    // Paramètres SMTP
    $smtpHost = 'tea.o2switch.net';
    $smtpUsername = 'jeune070';
    $smtpPassword = 'ddfwlhiqprtfxerl';
    $smtpPort = 465 ;
    // Configuration SMTP
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
    $mail->SMTPSecure = 'tls';
    $mail->Port = $smtpPort;

    // Destinataire et expéditeur
    $recipientEmail = $_POST['mail'];
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
    // mail($mail, $email_subject, $email_body, $email_headers);

        // Redirection vers la page de confirmation
        header('Location: confirmation.php');
        
    echo 'Le courriel de présentation a été envoyé avec succès au référent.';
      exit;
} catch (Exception $e) {
    echo 'Une erreur est survenue lors de l\'envoi du courriel : ' . $mail->ErrorInfo;
}

        
   } else {
        // Redirection en cas de champs non remplis
        header('Location: formulaire.php?error=empty_fields');
        exit;
    }
} else {
    // Redirection si accès direct au script
    header('Location: formulaire.php');
    exit;
}

?> 