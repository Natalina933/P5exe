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
        echo "id, nom, email, telephone\n";
        foreach ($contacts as $contact) {
            echo $contact->toString();
        }
    }
}
?>
