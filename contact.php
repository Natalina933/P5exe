<?php

class Contact
{
    private int $id;
    private string $name;
    private string $email;
    private string $phone_Number;

    public function __construct(int $id, string $name, string $email, string $phone_Number)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_Number = $phone_Number;
    }

    public function toString(): string
    {
        return "{$this->id}, {$this->name}, {$this->email}, {$this->phone_number}";
    }
}
?>