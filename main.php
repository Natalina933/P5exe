<?php
require_once 'contact.php';
require_once 'contactManager.php';
require_once 'DBConnect.php';
require_once 'command.php';

// Obtenez une instance de PDO à partir de DBConnect
$dbConnect = DBConnect::getInstance();
$pdo = $dbConnect->getPDO();

// Vérifiez si $pdo est une instance de PDO valide
if ($pdo instanceof PDO) {
    // Créez une instance de ContactManager avec $pdo
    $contactManager = new ContactManager($pdo);

    // Créez une instance de Command avec $contactManager
    $commandClass = new Command($contactManager);

    // Boucle principale pour lire les commandes
    while (true) {
        $line = readline("Entrez votre commande (help, list, detail, create, delete, quit) : ");
        // Commande "help"
        if ($line == "help") {
            $commandClass->help();
            continue;
        }

        // Commande "quit"
        if ($line == "quit") {
            break;
        }

        // Commande "detail"
        if (preg_match("/^detail (\d+)$/", $line, $matches)) {
            $commandClass->detail((int)$matches[1]);
            continue;
        }

        // Commande "list"
        if ($line == 'list') {
            $commandClass->list();
            continue;
        }

        // Commande "create"
        if (preg_match("/^create (.*), (.*), (.*)$/", $line, $matches)) {
            $commandClass->create($matches[1], $matches[2], $matches[3]);
            continue;
        }

        // Commande "delete"
        if (preg_match("/^delete (\d+)$/", $line, $matches)) {
            $commandClass->delete((int)$matches[1]);
            continue;
        }

        // Commande inconnue
        echo "Commande non valide : $line\n";
    }
} else {
    echo 'Échec de la connexion à la base de données';
}
?>
