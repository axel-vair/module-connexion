<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="moduleconnexion.css">
</head>
<body>
</body>
</html>

<?php
include 'header.php'; // HEADER FILE LINK
include 'connect.php'; // CONNECT FILE LINK


$sql = mysqli_query($conn, "SELECT * FROM utilisateurs");
$result = mysqli_fetch_all($sql);

if($_SESSION['login'] === 'admin'){ // if session login = admin so display all information of BDD in a table

    echo "<table id='table_admin'>";
    echo "<thead>
            <td>Nom</td>
            <td>Prénom</td>
            <td>Login</td>
            <td>Mot de passe</td>
        </thead>";
    echo "<h1>Bonjour {$_SESSION['login']}</h1>";
    echo "<br><br><p>Voici la base de données</p><br><br>";
    foreach($sql as $row):;
        echo "<tr>";
        echo "<td>". $row['login'] . "</td>";
        echo "<td>". $row['nom'] . "</td>";
        echo "<td>". $row['prenom'] . "</td>";
        echo "<td>". $row['password'] . "</td>";
        echo "</tr>";
    endforeach;
    echo "<table>";
}else{ // if not admin redirect at index.php.
    echo "<p id='error'>Vous n'avez pas les droits pour accéder à cette page</p>";
    header("Refresh:1 url=index.php");
}

?>
