<?php
include 'header.php'; // HEADER FILE LINK
include 'connect.php'; // CONNECT FILE LINK


if(isset($_POST['submit'])){ // If submit -> put login and password in variable
    $login = htmlspecialchars($_POST['login']);
    $password = $_POST['password'];
    $query = "SELECT `password` FROM utilisateurs WHERE login='$login'"; // query select password from utilisateur
    $sql = $conn->query($query); // Execute query on the database
    $result = $sql->fetch_array(); // return in array
    $hashPassword = $result['password']; // stock result password in Hashpassword
    $matchPassword = password_verify($password, $hashPassword); // variable for verify if password and hash are the same

    if ($matchPassword) {
        // if return true so connect, else don't
        session_start();

        $_SESSION['login'] = $login;

        if($login == 'admin') { // if login = admin so redicrect to admin pannel
            header('Location: admin.php');
        }else{ // if not admin redirect to index
            header('Location: index.php');
        }
    } else {
        echo "<p id='error'>Le login ou le mot de passe est incorrect</p>";
    }

}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="moduleconnexion.css">
    <title>Connexion</title>
</head>
<body>
<section class="container_formulaire">
    <h1> Connectez-vous </h1>
    <section id="formulaire">
        <form method="post" name="register">
            <fieldset>
                <legend> Entrez votre login et votre mot de passe </legend>
                <label>Votre login </label> <br>
                <input type = "text" name = "login" placeholder="entrez votre login"> <br>
                <label>Mot de passe</label> <br>
                <input type = "password" name = "password" placeholder="mot de passe"> <br>
                <button type="submit" name="submit" value = "inscription">Connexion</button>
            </fieldset>
        </form>
    </section>
</section>
<?php include 'footer.php'?>
</body>
</html>