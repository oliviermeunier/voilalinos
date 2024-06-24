<?php

$hostname = getenv('database.default.hostname');
$username = getenv('database.default.username');
$password = getenv('database.default.password');
$database = getenv('database.default.database');

echo "db: $database";die;

$mysqli = new mysqli($hostname, $username, $password);

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Créer la base de données
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($mysqli->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $mysqli->error . "\n";
}

$mysqli->close();
