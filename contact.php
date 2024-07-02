<?php

class Contact
{
    private int $id;
    private string $name;
    private string $email;
    private string $phone_number;

    public function __construct(int $id, string $name, string $email, string $phone_number)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function toString(): string
    {
        return "{$this->id}, {$this->name}, {$this->email}, {$this->phone_number}";
    }

    public static function fromArray(array $data): Contact
    {
        return new self($data['contact_id'], $data['contact_name'], $data['contact_email'], $data['contact_phone']);
    }
}
