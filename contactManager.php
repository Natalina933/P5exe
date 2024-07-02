<?php
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

    public function create(string $name, string $email, string $phone): bool
    {
        try {
            $query = $this->bdd->prepare('INSERT INTO contact (contact_name, contact_email, contact_phone) VALUES (:name, :email, :phone)');
            $query->bindValue(':name', $name, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->bindValue(':phone', $phone, PDO::PARAM_STR);
            return $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur de requête SQL : ' . $e->getMessage();
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $query = $this->bdd->prepare('DELETE FROM contact WHERE contact_id = :id');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur de requête SQL : ' . $e->getMessage();
            return false;
        }
    }
}
