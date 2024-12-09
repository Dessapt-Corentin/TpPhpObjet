<?php

namespace App\Model\Entity;

use Symplefony\Model\Entity;

class Adresse extends Entity
{
    protected int $id;
    public function getId(): int
    {
        return $this->id;
    }

    protected string $country;
    public function getCountry(): string
    {
        return $this->country;
    }
    public function setCountry(string $value): self
    {
        $this->country = $value;
        return $this;
    }

    protected string $city;
    public function getCity(): string
    {
        return $this->city;
    }
    public function setCity(string $value): self
    {
        $this->city = $value;
        return $this;
    }

    protected string $adress;
    public function getAdress(): string
    {
        return $this->adress;
    }
    public function setAdress(string $value): self
    {
        $this->adress = $value;
        return $this;
    }

    protected int $postal_code;
    public function getPostalCode(): int
    {
        return $this->postal_code;
    }
    public function setPostalCode(int $value): self
    {
        $this->postal_code = $value;
        return $this;
    }
}
