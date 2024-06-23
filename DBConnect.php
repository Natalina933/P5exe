<?php
//API pour nous connecter à MySQL
function dbConnect()
{
    try {
        $host = 'localhost';
        $dbname = 'gest_contact'; 
        $username = 'root';
        $password = '';

        // Création de l'objet PDO pour la connexion à la base de données
        $pdo = new PDO(
            'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8',
            $username,
            $password
        );

        // Définit l'attribut ERRMODE pour lever des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retourne l'objet PDO
        return $pdo;
    } catch (PDOException $e) {
        // Affiche un message d'erreur en cas de problème de connexion
        echo 'Erreur de connexion : ' . $e->getMessage();
        return null; // Retourne null en cas d'erreur
    }
}
// Test de la fonction dbConnect
$pdo = dbConnect();
var_dump($pdo);
?>