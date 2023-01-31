<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/sass/index.css">
    <title>Hackers Poulette</title>
</head>
<body>
    <?php
        function filter_string_polyfill(string $string): string
        {
            $str = preg_replace('/\x00|<[^>]*>?/', '', $string);
            return str_replace(["'", '"'], ['&#39;', '&#34;'], $str);
        }
        $status = 0;
        $status1 = 0;
    ?>
    <div class="container">
        <form method="post" class="signUp">
            <p>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" minlength="2" maxlength="255" required>
                <?php
                    if (isset($_POST["name"])) {
                        $name = filter_string_polyfill($_POST["name"]);
                        if (strlen($name) > 256 || strlen($name) < 1) {
                            echo "<p><mark style='color:red;'>Nom invalide</mark></p>";
                            $status++;
                        }
                    } else {
                        echo "<p><mark style='color:red;'>Nom non saisi</mark></p>";
                        $status++;
                    }
                ?>
            </p>
            <p>
                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" id="firstname" minlength="2" maxlength="255" required>
                <?php
                    if (isset($_POST["firstname"])) {
                        $firstname = filter_string_polyfill($_POST["firstname"]);
                        if (strlen($firstname) > 256 || strlen($firstname) < 1) {
                            echo "<p><mark style='color:red;'>Prenom invalide</mark></p>";
                            $status++;
                        }
                    } else {
                        echo "<p><mark style='color:red;'>Prenom non saisi</mark></p>";
                        $status++;
                    }
                ?>
            </p>
            <p>
                <label for="email">Email:</label>
                <textarea type="text" name="email" id="email" minlength="2" maxlength="255" required></textarea>
                <?php
                    if (isset($_POST["email"])) {
                        $email= filter_var(filter_string_polyfill($_POST["email"]), FILTER_SANITIZE_EMAIL);
                        if (strlen($email) > 256 || strlen($email) < 1 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo "<p><mark style='color:red;'>Email invalide</mark></p>";
                            $status++;
                        }
                    } else {
                        echo "<p><mark style='color:red;'>Email non saisi</mark></p>";
                        $status++;
                    }
                ?>
            </p>
            <p>
                <label for="comment">Comment:</label>
                <textarea type="text" name="comment" id="comment" minlength="2" maxlength="1000" required></textarea>
                <?php
                    if (isset($_POST["comment"])) {
                        $comment = filter_string_polyfill($_POST["comment"]);
                        if (strlen($comment) < 249 || strlen($comment) > 1001) {
                            echo "<p><mark style='color:red;'>Commentaire invalide</mark></p>";
                            $status++;
                        }
                    } else {
                        echo "<p><mark style='color:red;'>Commentaire non saisi</mark></p>";
                        $status++;
                    }
                ?>
            </p>
            <p>
                <label>Entrer le texte dans l'image</label>
                <br><img src="captcha.php"/><br>
                <input name="captcha" type="text" id="captcha">
                <?php
                    session_start();
                    echo ((isset($_POST["captcha"]) && $_SESSION["code"] != $_POST["captcha"] && $_POST["captcha"] != "")? "<p>Le code captcha entré ne correspond pas! Veuillez réessayer.</p>" :"");
                ?>
            </p>
            <button class="form-btn log-in sx" type="button">Se connecter</button>
            <button class="form-btn dx" type="submit">Valider</button>
        </form>
        <form action="./dashboard.php" class="signIn">
            <p>Acces aux formulaires</p>
            <button class="form-btn back sx" type="button">Revenir</button>
            <button class="form-btn dx" type="submit">Se connecter</button>
        </form>
    </div>
    <?php
        if (!$status)
        {
            echo "<p>Formulaire valide</p>";
            try
            {
                $string = "INSERT INTO formulaire (nom, prenom, email, comment) VALUES ('" . $name . "','" . $firstname . "','" . $email . "','" . $comment . "');";
                $bdd = new PDO("mysql:host=localhost;dbname=test1", "root", "");
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = $bdd->query($string);
                $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
                echo "<p>Envoie du formulaire: valide</p>";
                require("mail.php");
            }
            catch(PDOException $e) { echo "<p>Envoie du formulaire: echec</p>"; }
        }
    ?>
    <script src="./assets/scripts/script.js"></script>
</body>
</html>