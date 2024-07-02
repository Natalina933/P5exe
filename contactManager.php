<?php
include_once 'contact.php';
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
                $contacts[] = Contact::fromArray($contact);
            }
        } catch (PDOException $e) {
            echo 'Erreur de requête SQL : ' . $e->getMessage();
        }
        return $contacts;
    }

    public function findContactById(int $id): ?Contact
    {
        try {
            $query = $this->bdd->prepare('SELECT * FROM contact WHERE contact_id = :id');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $contactData = $query->fetch(PDO::FETCH_ASSOC);

            if ($contactData) {
                return Contact::fromArray($contactData);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo 'Erreur de requête SQL : ' . $e->getMessage();
            return null;
        }
    }
}
