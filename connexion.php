<?php
session_start(); // Démarrage de la session
require_once 'config.php'; // On inclut la connexion à la base de données JSON

try {
    $jsonData = getJsonData(); // Tentative de récupération des données depuis la base de données
} catch (Exception $e) {
    // Affichage d'une alerte si l'accès à la base de données échoue
    echo '<script>alert("Impossible d\'accéder à la base de données.");</script>';
    header('Location: index.php');
    die();
}

if (!empty($_POST['email']) && !empty($_POST['password'])) // Si les champs email et password ne sont pas vides
{
    // Patch XSS
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $email = strtolower($email); // email transformé en minuscule

    // On regarde si l'utilisateur est inscrit dans la base de données JSON
    $user = array_filter($jsonData['utilisateurs'], function($utilisateur) use ($email) {
        return $utilisateur['email'] === $email;
    });

    if (!empty($user)) {
        $user = reset($user);

        // Si le mail est bon niveau format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Si le mot de passe est le bon
            if ($password === $user['password']) { // Comparaison simple sans hachage
                // On crée la session et on redirige vers la page-jeune.html
                $_SESSION['user'] = $user['token'];
                header('Location: page-jeune.html');
                die();
            } else {
                header('Location: index.php?login_err=password');
                die();
            }
        } else {
            header('Location: index.php?login_err=email');
            die();
        }
    } else {
        // Alerte en cas de présence d'e-mail dans la base de données
        echo '<script>alert("Cet e-mail n\'est pas inscrit dans la base de données.");</script>';
        header('Location: index.php?login_err=already');
        die();
    }
} else {
    header('Location: index.php');
    die();
}
?>
