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
    $message = '<html>
                <head>
                    <title>Calendrier des anniversaires pour Août</title>
                </head>
                <body>
                    <p>Voici les anniversaires à venir au mois d\'Août !</p>
                    <table>
                        <tr>
                            <th>Personne</th><th>Jour</th><th>Mois</th><th>Année</th>
                        </tr>
                        <tr>
                            <td>Josiane</td><td>3</td><td>Août</td><td>1970</td>
                        </tr>
                        <tr>
                            <td>Emma</td><td>26</td><td>Août</td><td>1973</td>
                        </tr>
                    </table>
                </body>
                </html>';
    $headers = "De :" . $_SESSION['name'];
    mail($to,$subject,$message, $headers);
    echo "L'email a été envoyé.";
?>