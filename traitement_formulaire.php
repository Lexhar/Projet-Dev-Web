<?phpsession_start(); // Démarrage de la session

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
        $email_body = "Bonjour,\n\nVous avez reçu une demande de référence de la part d'un jeune participant au projet Jeunes 6.4.\n\nVeuillez cliquer sur le lien suivant pour confirmer la demande :\n\nhttp://exemple.com/confirmer_demande.php\n\nMerci pour votre collaboration.\n\nL'équipe du projet Jeunes 6.4";
        $email_headers = "From: projetjeunes@example.com";

        mail($mail, $email_subject, $email_body, $email_headers);

        // Redirection vers la page de confirmation
        header('Location: confirmation.php');
        exit;
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

