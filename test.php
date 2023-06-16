<?php

$to_email = 'emessienerachel@gmail.com';
            $subject = 'Présentation du projet Jeunes 6.4';
            $body = 'Bonjour';
            $headers = 'From: jeune070@gmail.com';
    
            if(mail($to_email, $subject, $body, $headers)) {
                echo("Cool $to_email...");
            } else {
                echo("Mince...");
                }

?>