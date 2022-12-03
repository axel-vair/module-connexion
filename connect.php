<?php
$servername = 'localhost';
$username = 'root';
$password_db = 'root';
$database = 'moduleconnexion';
//Connect to database
/*
$servername = 'localhost';
$username = 'AxelVair';
$password_db = 'verTis-nuhwod-gakhi7';
$database = 'axel-vair_moduleconnexion'; */

$conn = mysqli_connect($servername, $username, $password_db, $database);