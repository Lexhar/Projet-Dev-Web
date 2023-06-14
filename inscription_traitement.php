<?php
require_once 'config.php'; // On inclut la connexion à la base de données JSON

// Si les variables existent et ne sont pas vides
if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['date_naissance']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype'])) {
    // Patch XSS
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $date_naissance = htmlspecialchars($_POST['date_naissance']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);

    // Vérification de l'âge minimum de 16 ans
    $today = new DateTime();
    $date_naissance_obj = new DateTime($date_naissance);
    $age = $today->diff($date_naissance_obj)->y;

    if ($age < 16) {
        header('Location: inscription.php?reg_err=age');
        die();
    }

    // Vérification du format du nom et du prénom (lettres uniquement)
    if (!ctype_alpha($prenom) || !ctype_alpha($nom)) {
        header('Location: inscription.php?reg_err=name_letters');
        die();
    }

    // On vérifie si l'utilisateur existe dans la base de données
    $jsonData = json_decode(file_get_contents('data_base.json'), true);

    foreach ($jsonData['utilisateurs'] as $user) {
        if ($user['email'] === $email) {
            header('Location: inscription.php?reg_err=already');
            die();
        }
    }

    $email = strtolower($email);

    if (strlen($email) <= 100 && filter_var($email, FILTER_VALIDATE_EMAIL) && $password === $password_retype) {
        // On crée un nouvel utilisateur
        $newUser = [
            'email' => $email,
            'password' => $password,
            'prenom' => $prenom,
            'nom' => $nom,
            'date_naissance' => $date_naissance
        ];

        // On ajoute le nouvel utilisateur à la liste des utilisateurs
        $jsonData['utilisateurs'][] = $newUser;

        // On enregistre les données mises à jour dans le fichier JSON
        file_put_contents('data_base.json', json_encode($jsonData));

        // On redirige avec le message de succès
        header('Location: inscription.php?reg_err=success');
        die();
    } else {
        if (strlen($email) > 100) {
            header('Location: inscription.php?reg_err=email_length');
            die();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: inscription.php?reg_err=email');
            die();
        } elseif ($password !== $password_retype) {
            header('Location: inscription.php?reg_err=password');
            die();
        }
    }
}
?>
