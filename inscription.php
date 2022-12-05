<?php

include 'header.php'; // HEADER FILE LINK
include 'connect.php'; // CONNECT FILE LINK

    //Vérification des champs: s'ils ne sont pas vides alors on stock les infos entrées dans des variables
    //On ajoute une requête stockée dans $query qui va permettre d'insérer les données dans la BDD
    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['login']) && !empty($_POST['password'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $co_password = htmlspecialchars($_POST['confirmation_password']);
        $verify_user = "SELECT `login` FROM utilisateurs WHERE login = '$login'"; //  Query for select login from utilisateurs
        $sql = $conn->query($verify_user); // Execute query
        $result_user = $sql->fetch_assoc(); // stock in array result bdd

        if($login == $result_user['login']){ // If login equal to login in BBD SO error message
            echo "<p id='error'>Le login est déjà utilisé</p>";
        }

        if($password != $co_password){ // if pass and pass confirmation are differents so error
            echo "<p id='error'>Les mots de passe ne correspondent pas</p>";

        }

        if ($login != $result_user['login'] && $password == $co_password) { // if login is different with bdd login and password equal so execute code and insert user
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $co_password = password_hash($_POST['confirmation_password'], PASSWORD_DEFAULT);
            $query = "INSERT INTO utilisateurs(nom, prenom, login, password) VALUES('$nom', '$prenom', '$login', '$password')";
            $result = mysqli_query($conn, $query);
            header('Location: connexion.php');
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
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" type="text/css" href="moduleconnexion.css">
</head>
<body>

<h1> Formulaire d'inscription </h1>
<form action="inscription.php" name='register' method='post'>
    <fieldset>
        <legend> Informations personnelles de l'utilisateur </legend>
        <label for="name">Votre nom </label> <br>
        <input type = "text" name="nom" id="name" required> <br>
        <label for="prenom">Votre prenom </label> <br>
        <input type = "text" name="prenom" id="prenom" required> <br>
        <label for="login">Votre login </label> <br>
        <input type = "text" name="login" id="login" required> <br>
        <label for="password">Mot de passe</label> <br>
        <input type = "password" name="password" id="password" required> <br>
        <label for="confirmation_password">Confirmer votre mot de passe</label> <br>
        <input type = "password" name= "confirmation_password" id="confirmation_password" required> <br>
        <br><button type="submit" value = "inscription">S'inscrire</button>
    </fieldset>
</form>
<!-- Need to feed this include display <?php include 'footer.php'?> -->
</body>
</html>



