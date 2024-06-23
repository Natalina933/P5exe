<?php
// Inclusion de dbConnect.php pour obtenir l'objet PDO
require_once 'DBConnect.php';
require_once 'contact.php';
require_once 'contactManager.php';
require_once 'command.php';

$pdo = DBConnect(); // Assurez-vous que dbConnect est correctement défini

if (!$pdo) {
    die('Erreur de connexion à la base de données');
}

$contactManager = new ContactManager($pdo);
$command = new Command($contactManager);

while (true) {
    $line = readline("Entrez votre commande : ");
    echo "Vous avez saisi : $line\n";

    if ($line == "list") {
        $command->list();
    } elseif ($line == "quit") {
        break;
    } else {
        echo "Commande non reconnue.\n";
    }
}
?>
 