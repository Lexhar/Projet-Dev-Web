<!DOCTYPE html>
<html>
<head>
    <title>Confirmation</title> <!-- Titre de la page -->
    <meta charset="UTF-8"> <!-- Encodage des caractères -->
    <link rel="stylesheet" type="text/css" href="page-jeune.css"> <!-- Inclusion d'une feuille de styles externe -->
</head>
<body>
<div id="en_tête">
    <div class="logo">
        <img class="jeune" src="images/Jeunes.png" alt="logo"> <!-- Image du logo -->
    </div>
    <div class="Utilisateur">
        <p class="Utilisateur">JEUNE</p> <!-- Texte "JEUNE" -->
        <p class="action">Je donne de la valeur à mon engagement</p> <!-- Texte décrivant l'action -->
    </div>
</div>

<div id="conteneur">
    <div id="onglet">
        <div class="jeune">
            <a href="page-jeune.html">JEUNE</a> <!-- Lien vers la page "JEUNE" -->
        </div>
        <div class="référent">
            <a href="page-référent.html">RÉFÉRENT</a> <!-- Lien vers la page "RÉFÉRENT" -->
        </div>
        <div class="consultant">
            <a href="page-consultant.html">CONSULTANT</a> <!-- Lien vers la page "CONSULTANT" -->
        </div>
        <div class="partenaires">
            <a href="page-partenaires.html">PARTENAIRES</a> <!-- Lien vers la page "PARTENAIRES" -->
        </div>
    </div>

    <div class="connexion">
        <a href="deconexion.php"> <!-- Lien de déconnexion vers "deconexion.php" -->
            <button type="button" class="image-bouton"> <!-- Bouton avec une image -->
                <img class="connexion" src="images/deconnexion.png" alt="Bouton Valider"> <!-- Image de déconnexion -->
            </button>
        </a>
    </div>

</div>

<div class="confirmation">
    <h2>Merci ! Votre demande de référence a été envoyée avec succès.</h2> <!-- Titre de confirmation -->
    <p>Vous recevrez bientôt un e-mail de confirmation à l'adresse que vous avez indiquée.</p> <!-- Message de confirmation -->
    <p>Nous vous recontacterons dès que possible.</p> <!-- Message de suivi -->
</div>

</body>
</html>
