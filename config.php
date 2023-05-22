<?php 
        /*
           Attention ! le host => l'adresse de la base de données et non du site !!
        
           Pour ceux qui doivent spécifier le port ex : 
           $bdd = new PDO("mysql:host=CHANGER_HOST_ICI;dbname=CHANGER_DB_NAME;charset=utf8;port=3306", "CHANGER_LOGIN", "CHANGER_PASS");
           
         
    try 
    {
        $bdd = new PDO("mysql:host=CHANGER_HOST_ICI;dbname=CHANGER_DB_NAME;charset=utf8", "CHANGER_LOGIN", "CHANGER_PASS");
    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }*/

    $base = '/database/Base_Jeunes.db';

// Connexion
try {
    $bd = new SQLite3($base);
} catch (SQLiteException $e) {
    die("La création ou l'ouverture de la base [$base] a échouée ".
         "pour la raison suivante: ".$e->getMessage());
}

// Inserer ici les requêtes

// Deconnexion
$bd = null;