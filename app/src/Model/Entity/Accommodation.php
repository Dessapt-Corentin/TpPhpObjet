<?php

namespace App\Model\Entity;

use Symplefony\Model\Entity;

class Accommodation extends Entity
{
    protected int $id;
    public function getId(): int
    {
        return $this->id;
    }

    protected int $adresse_id;
    public function getAdresseId(): int
    {
        return $this->adresse_id;
    }
    public function setAdresseId(int $value): self
    {
        $this->id = $value;
        return $this;
    }

    protected float $price;
    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice(int $value): self
    {
        $this->price = $value;
        return $this;
    }

    protected int $id_type;
    public function getIdType(): int
    {
        return $this->id_type;
    }
    public function setIdType(int $value): self
    {
        $this->id_type = $value;
        return $this;
    }

    protected int $size;
    public function getSize(): int
    {
        return $this->size;
    }
    public function setSize(int $value): self
    {
        $this->size = $value;
        return $this;
    }

    protected string $descripton = '';
    public function getDescripton(): string
    {
        return $this->descripton;
    }
    public function setDescripton(int $value): self
    {
        $this->descripton = $value;
        return $this;
    }

    protected int $beds;
    public function getBeds(): int
    {
        return $this->beds;
    }
    public function setBeds(int $value): self
    {
        $this->beds = $value;
        return $this;
    }

    protected int $owner_id;
    public function getOwnerId(): int
    {
        return $this->owner_id;
    }
    public function setOwnerId(int $value): self
    {
        $this->owner_id = $value;
        return $this;
    }

    protected ?string $image = null;
    public function getImage(): ?string
    {
        return $this->image;
    }
    public function setImage(int $value): self
    {
        $this->image = $value;
        return $this;
    }
}
