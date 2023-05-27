<?php 
    session_start();

    // Supprimer les données de l'utilisateur connecté de la session
    unset($_SESSION['user']);

    // Rediriger vers la page d'accueil
    header('Location: index.php');
    exit();
?>
