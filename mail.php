<?php

function utiliserVariable($mail) {
    if (isset($_POST[$mail])) {
        $valeur = $_POST[$mail];
        // Utiliser la valeur comme variable
        // Par exemple, afficher la valeur
        echo "La valeur du champ $mail est : $valeur";
    } else {
        echo "Le champ $mail n'a pas été rempli.";
    }
}
