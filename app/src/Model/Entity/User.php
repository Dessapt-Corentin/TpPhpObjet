<?php

namespace App\Model\Entity;

use Symplefony\Model\Entity;

class User extends Entity
{
    protected int $id;
    public function getId(): int
    {
        return $this->id;
    }

    protected string $password;
    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this; // Permet de "chaîner" les appels aux setters: $toto->setId(2)->setName('toto'), etc.
    }

    protected string $email;
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    protected string $firstname;
    public function getFirstname(): string
    {
        return $this->firstname;
    }
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    protected string $lastname;
    public function getLastname(): string
    {
        return $this->lastname;
    }
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    protected string $phone_number;
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }
    public function setPhoneNumber(int $value): self
    {
        $this->phone_number = $value;
        return $this;
    }

    protected string $role;
    public function getRole(): string
    {
        return $this->role;
    }
    public function setRole(string $value): self
    {
        $this->role = $value;
        return $this;
    }
}
