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

        // Construction du tableau de réponses du formulaire
        $reponses_formulaire = array(
            'nom' => $nom,
            'prenom' => $prenom,
            'date' => $date,
            'mail' => $mail,
            'reseau' => $reseau,
            'presentation' => $presentation,
            'duree' => $duree,
            'savoir_etre' => $savoir_etre
        );

        // Chargement du contenu du fichier data_base.json
        $data = file_get_contents('data_base.json');
        $data = json_decode($data, true);

        // Recherche de l'utilisateur dans le tableau utilisateurs
        $utilisateurIndex = -1;
        foreach ($data['utilisateurs'] as $index => $utilisateur) {
            if ($utilisateur['email'] === $mail) {
                $utilisateurIndex = $index;
                break;
            }
        }

        // Ajout des réponses du formulaire à l'utilisateur
        if ($utilisateurIndex !== -1) {
            $data['utilisateurs'][$utilisateurIndex]['reponses_formulaire'][] = $reponses_formulaire;
        } else {
            // Création d'un nouvel utilisateur avec les réponses du formulaire
            $nouvelUtilisateur = array(
                'email' => $mail,
                'password' => '', // Vous pouvez ajouter le champ password si nécessaire
                'reponses_formulaire' => array($reponses_formulaire)
            );
            $data['utilisateurs'][] = $nouvelUtilisateur;
        }

        // Sauvegarde des données dans le fichier data_base.json
        $data = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents('data_base.json', $data);

        // Redirection vers la page de confirmation
        header('Location: confirmation.php');
        exit;
    } else {
        // Redirection en cas de champs non remplis
        header('Location: formulaire.php?error=empty_fields');
        exit;
    }
} else {
    // Affichage du formulaire si accès direct à la page
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulaire</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Formulaire</h1>

    <!-- Formulaire -->
    <form action="formulaire.php" method="POST">
        <!-- Champs du formulaire -->
        <!-- ... -->
        
        <!-- Bouton de soumission -->
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
<?php
}
?>
