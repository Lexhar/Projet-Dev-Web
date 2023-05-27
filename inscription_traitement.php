<?php
require_once 'config.php'; // On inclut la connexion à la base de données JSON

// Si les variables existent et ne sont pas vides
if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype'])) {
    // Patch XSS
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);

    // On vérifie si l'utilisateur existe
    $jsonData = getJsonData();

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
            'password' => $password
        ];

        // On ajoute le nouvel utilisateur à la liste des utilisateurs
        $jsonData['utilisateurs'][] = $newUser;

        // On enregistre les données mises à jour dans le fichier JSON
        saveJsonData($jsonData);

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
