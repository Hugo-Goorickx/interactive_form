<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/sass/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <?php
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=u716273791_me", "u716273791_hugoorickx", "8X=HB]mW&px");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "<p>Connexion echec</p>";
        }

        if (isset($_POST['status']))
        {
            try {
                $string = "UPDATE test1 SET state_now = ".$_POST['status']." WHERE id=".$_POST['input'].";";
                $bdd->query($string)->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e) {
                echo "<p>Mise a jour compromise</p>";
            }
        }

        try {
            $string = "SELECT id, nom, prenom, comment, email, state_now FROM `test1` WHERE 1;";
            $resultat = $bdd->query($string)->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            echo "<p>Reception compromise</p>";
        }

        foreach ($resultat as $groupe) {
            echo "  <details>
                        <summary>".$groupe['nom']." ".$groupe['prenom']."
                            <form method='post'>
                                <select name='status' id='status'>
                                    <option value=1 ".(($groupe['state_now'] == 1)? "selected": "").">pas traite</option>
                                    <option value=2 ".(($groupe['state_now'] == 2)? "selected": "").">en cours</option>
                                    <option value=3 ".(($groupe['state_now'] == 3)? "selected": "").">fait</option>
                                </select>
                                <input type='hidden' value='".$groupe['id']."' name='input'>
                                <input class='btn' type='submit' value='update' id='submit'>
                            </form>
                        </summary>
                        <p>".$groupe['comment']."</p>
                        <span>EMail: ".$groupe['email']."</span>
                    </details>";
        }
    ?>
</body>
</html>