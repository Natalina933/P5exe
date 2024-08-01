<?php
class Command
{
    private ContactManager $contactManager;

    public function __construct(ContactManager $contactManager)
    {
        $this->contactManager = $contactManager;
    }

    public function list(): void
    {
        $contacts = $this->contactManager->findAll();
        if (empty($contacts)) {
            echo "Aucun contact\n";
            return;
        }
        echo "Liste des contacts : \n";
        echo "id, nom, email, téléphone\n";
        foreach ($contacts as $contact) {
            echo $contact->toString() . "\n";
        }
    }

    public function help(): void
    {
        echo "Commandes disponibles : \n";
        echo "help : Affiche cette aide\n";
        echo "list : Affiche la liste des contacts\n";
        echo "detail <id> : Affiche les détails du contact avec l'ID donné\n";
        echo "create <nom>, <email>, <téléphone> : Crée un nouveau contact\n";
        echo "delete <id> : Supprime le contact avec l'ID donné\n";
        echo "quit : Quitte le programme\n";
    }

    public function detail(int $id): void
    {
        $contact = $this->contactManager->findContactById($id);
        if ($contact) {
            echo $contact->toString() . "\n";
        } else {
            echo "Contact non trouvé\n";
        }
    }

    /**
     * Creates a new contact with the given name, email, and phone number.
     *
     * @param string $name The name of the contact.
     * @param string $email The email address of the contact.
     * @param string $phone The phone number of the contact.
     * @return void
     */
    public function create(string $name, string $email, string $phone): void
    {
        $result = $this->contactManager->create($name, $email, $phone);
        if ($result) {
            echo "Contact créé avec succès\n";
        } else {
            echo "Erreur lors de la création du contact\n";
        }
    }

    public function delete(int $id): void
    {
        $result = $this->contactManager->delete($id);
        if ($result) {
            echo "Contact supprimé avec succès\n";
        } else {
            echo "Erreur lors de la suppression du contact\n";
        }
    }
}
