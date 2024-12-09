<?php

namespace App\Model\Entity;

use Symplefony\Model\Entity;

class TypeAccommodation extends Entity
{
    protected int $id;
    public function getId(): int
    {
        return $this->id;
    }

    protected int $type_accommodation;
    public function getTypeAccommodation(): int
    {
        return $this->type_accommodation;
    }

    public function setTypeAccommodation(int $value): self
    {
        $this->type_accommodation = $value;
        return $this;
    }
}
