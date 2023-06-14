<?php
require_once 'config.php'; // Inclure le fichier de configuration
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="NoS1gnal"/>
    <link rel="stylesheet" type="text/css" href="inscription.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Inscription</title>
</head>
<body>
<div class="login-form">
    <?php
    if (isset($_GET['reg_err'])) {
        $err = htmlspecialchars($_GET['reg_err']);

        switch ($err) {
            case 'success':
                ?>
                <div class="alert alert-success">
                    <strong>Succès</strong> inscription réussie ! Vous allez pouvoir vous connecter !
                </div>
                <a href="index.php" class="btn btn-primary">Se connecter</a>
                <?php
                break;

            case 'password':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> mot de passe différent
                </div>
                <?php
                break;

            case 'email':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> email non valide
                </div>
                <?php
                break;

            case 'email_length':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> email trop long
                </div>
                <?php
                break;

            case 'pseudo_length':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> pseudo trop long
                </div>
                <?php
                break;

            case 'already':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> compte déjà existant
                </div>
                <?php
                break;

            case 'age':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> vous devez avoir au moins 16 ans pour vous inscrire
                </div>
                <?php
                break;

            case 'name_letters':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> le nom et le prénom doivent être uniquement composés de lettres
                </div>
                <?php
                break;
        }
    }
    ?>

    <form action="inscription_traitement.php" method="post">
        <h2 class="text-center">Inscription compte Jeune</h2>
        <div class="jeune"><img src="images/Jeunes.png" alt="logo Jeune"></div>
        <div class="form-group">
            <input type="text" name="prenom" class="form-control" placeholder="Prénom" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="text" name="nom" class="form-control" placeholder="Nom" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="date" name="date_naissance" class="form-control" placeholder="Date de naissance" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password_retype" class="form-control" placeholder="Confirmez le mot de passe" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Inscription</button>
        </div>
    </form>
</div>

</body>
</html>
