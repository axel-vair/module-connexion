<?php
include 'header.php'; // HEADER FILE LINK
include 'connect.php'; // CONNECT FILE LINK


$login = $_SESSION['login']; // MY LOGIN = SESSION LOGIN

if(!empty($_SESSION)) { // if $session is not empty so select information of user
    $query = "SELECT * FROM utilisateurs WHERE login='$login'";
    $sql = $conn->query($query);
    $result = $sql->fetch_assoc(); // stock in assoc
    $login_bdd = $result['login'];  // stock in variables
    $nom = $result['nom'];
    $prenom = $result['prenom'];
    $password = $result['password'];

    if (isset($_POST['submit'])) { // if user send form
        if ($nom != $_POST['nom']) { // if name bdd is different to post name sended so update it
            $sql1 = "UPDATE `utilisateurs` SET nom='{$_POST['nom']}' WHERE nom='$nom'";
            $result1 = $conn->query($sql1);
            echo "Votre nom a bien été changé par:" . $_POST['nom'] ."<br>";

        }if ($prenom != $_POST['prenom']) { // same for prenom
            $sql2 = "UPDATE `utilisateurs` SET prenom='{$_POST['prenom']}' WHERE prenom='$prenom'";
            $result2 = $conn->query($sql2);
            echo "Votre nom a bien été changé par:" . $_POST['prenom'] . "<br>";
        }if ($login != $_POST['login']) { // same for login
            $sql3 = "UPDATE `utilisateurs` SET login='{$_POST['login']}' WHERE login='$login'";
            $result3 = $conn->query($sql3);
            echo "Votre login a bien été changé par:" . $_POST['login'] . "<br>";
        }if ($password != $_POST['password']) { // same for login and don't forget to hash it
            $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql4 = "UPDATE `utilisateurs` SET password='$new_password' WHERE password='$password'";
            $result4 = $conn->query($sql4);
            echo "Votre mot de passe a bien été changé par:" . $_POST['password'] . "<br>";
        }

    }

}
if (isset($_POST['delete'])) { // if user push delete button so delete all data from bdd and destroy session then redirect.
    $sql_delete = "DELETE FROM utilisateurs WHERE login='$login'";
    $result_delete = $conn->query($sql_delete);
    echo "Vos données ont été supprimées";
    session_destroy();
    header('Location: index.php');
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
    <title>Page de profil</title>
</head>
<body>
<section class="container_formulaire">
    <p id="p_profil"><?php echo 'Vous êtes connecté.e en tant que ' . $_SESSION['login'];?> </p>
    <h1>Votre profil</h1>

    <br>
    <br>
    <section id="tableau">
        <table>
            <form method="post">
                <thead>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Login</td>
                <td>Mot de passe</td>
                </thead>
                <tbody>
                <tr>
                    <td><input id="input_profil" name="nom" placeholder="<?php echo $result['nom'] ?>" required></td>
                    <td><input id="input_profil" name="prenom" placeholder="<?php echo $result['prenom'] ?>" required></td>
                    <td><input id="input_profil" name="login" placeholder="<?php echo $result['login'] ?>"required></td>
                    <td><input id="input_profil" name="password" placeholder="<?php echo $result['password'] ?>"></td>
                </tr>
                </tbody>
                <button class="delete" type="submit" name="delete">Supprimer mon compte</button>
                <button class="modifier" type="submit" name="submit">Modifier</button>
            </form>
        </table>
    </section>


</section>

<?php include 'footer.php'?>
</body>
</html>
