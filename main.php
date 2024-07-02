<?php
require_once 'contact.php';
require_once 'contactManager.php';
require_once 'DBConnect.php';
require_once 'command.php';

// Cette classe contient l'ensemble de toutes les commandes qui pourront être
// demandée par l'utilisateur. 
$commandClass = new Command();

// Coeur du programme. C'est une boucle infinie qui attend une commande de l'utilisateur
// et qui exécute la commande demandée. La boucle s'arrête quand l'utilisateur tape "quit"
while (true) {
    // A chaque tour de boucle, le programme attend que l'utilisateur tape une commande
    // Cette commande est validée quand l'utilisateur appuie sur la touche "Entrée"
    // Cette commande est stockée dans la variable $line
    $line = readline("Entrez votre commande (help, list, detail, create, delete, quit) : ");

    // Commande "help"
    // Cette commande affiche l'aide. 
    if ($line == "help") {
        $commandClass->help();
        // Si la commande est traitée, on peut passer directement au tour de boucle suivant
        // sans tester les autres options. C'est ce que fait le mot-clé "continue"
        continue;
    }

    // Commande "quit"
    // Cette commande quitte le programme
    if ($line == "quit") {
        // On sort de la boucle. Le programme s'arrête
        break;
    }

    // Commande "detail"
    // Cette commande affiche le détail d'un contact
    if (preg_match("/^detail (.*)$/", $line, $matches)) {
        // Exemple : detail 1
        $commandClass->detail($matches[1]);
        continue;
    }

    // Commande "list"
    // Cette commande liste les contacts
    if ($line == 'list') {
        $commandClass->list();
        continue;
    }

    // Commande "create"
    // Cette commande crée un contact. 
    // preg_match permet d'utiliser les expressions régulière pour valider la commande
    // et récupérer les paramètres. Tout ce qui est entre parenthèse dans l'expression
    // régulière est récupéré dans le tableau $matches
    // Ici, on vérifie que la commande commence par "create" suivi de 4 paramètres
    // séparés par des virgules et un espace. 
    if (preg_match("/^create (.*), (.*), (.*)$/", $line, $matches)) {
        // Exemple : create nom, mail@provider.com, 0102030405
        $commandClass->create($matches[1], $matches[2], $matches[3]);
        continue;
    }

    // Commande "delete"
    // Cette commande supprime un contact.
    // On utilise à nouveau preg_match pour valider la commande et récupérer le paramètre
    // correspondant à l'id du contact à supprimer
    if (preg_match("/^delete (.*)$/", $line, $matches)) {
        // Exemple : delete 1
        $commandClass->delete($matches[1]);
        continue;
    }

    // Commande inconnue
    // Si aucune des commandes précédentes n'a été exécutée, c'est que la commande
    // est inconnue ou mal formatée. 
    // On affiche un message d'erreur en répétant la commande tapée par l'utilisateur. 
    echo "Commande non valide : $line\n";
}
