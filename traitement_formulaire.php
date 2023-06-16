<?php
session_start(); // Démarrage de la session


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification si les champs sont remplis
    if (/*!empty($_POST['commentaire']) && */ !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['date']) && !empty($_POST['mail']) && !empty($_POST['reseau']) && !empty($_POST['presentation']) && !empty($_POST['duree']) && isset($_POST['savoir_etre'])) {
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
        

        
        $to_email = $mail;
        $subject = 'Présentation du projet Jeunes 6.4 - Demande de référence';
        $body = 'Bonjour, Vous avez reçu une demande de référence sur le projet Jeunes 6.4.Veuillez cliquer sur le lien suivant pour confirmer votre participation , camtel.bada1033.odns.fr/devweb/page-referent.html Confirmer la demande Cordialement, Jeunes 6.4
        Si vous ne pouvez pas cliquer sur le lien faites un copier-coller.
        Merci.';
        
        $headers = 'From: jeune070@gmail.com';
        //$headers .= "Content-type: text/html\r\n";
        
        mail($to_email, $subject, $body, $headers);

       // Stockage de la demande de référence dans la session (ou base de données)
        $_SESSION['demande_reference'] = $demande_reference;

        header('Location: confirmation-envoi.html');

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