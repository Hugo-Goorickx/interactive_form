<?php
    session_start();

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    $_SESSION['name'] = $name;
    $_SESSION['firstname'] = $firstname;
    $_SESSION['email'] = $email;
    $_SESSION['comment'] = $comment;

    $to = "hugoorickx@gmail.com";
    $subject = "Formulaire valide et envoye";
    $message = 'Nouveua formulaire recu !';
    $headers = "De :" . $_SESSION['name'];
    mail($to,$subject,$message, $headers);
    echo "L'email a été envoyé.";
?>