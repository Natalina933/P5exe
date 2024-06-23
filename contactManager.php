<?php
include 'Contact.php';

class ContactManager
{
    private PDO $bdd;

    public function __construct(PDO $bdd)
    {
        $this->bdd = $bdd;
    }

    public function findAll(): array
    {
        $contacts = [];
        try {
            $query = $this->bdd->query('SELECT * FROM contact');
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $contact) {
                $contacts[] = new Contact(
                    $contact['id'],
                    $contact['name'],
                    $contact['email'],
                    $contact['phone_number']
                );
            }
        } catch (PDOException $e) {
            echo 'Erreur de requête SQL : ' . $e->getMessage();
        }
        return $contacts;
    }

    public function findContactById(int $id): ?Contact
    {
        try {
            $query = $this->bdd->prepare('SELECT * FROM contact WHERE id = :id');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $contactData = $query->fetch(PDO::FETCH_ASSOC);

            if ($contactData) {
                return new Contact(
                    $contactData['id'],
                    $contactData['name'],
                    $contactData['email'],
                    $contactData['phone_number']
                );
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo 'Erreur de requête SQL : ' . $e->getMessage();
            return null;
        }
    }
}

// Test de la méthode findAll
if ($pdo) {
    $contactManager = new ContactManager($pdo);
    $contacts = $contactManager->findAll();
    var_dump($contacts);

    // Test de la méthode findContactById
    $contact = $contactManager->findContactById(1);
    var_dump($contact);
}
?>
