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

    protected string $type_accommodation;
    public function getTypeAccommodation()
    {
        return $this->type_accommodation;
    }

    public function setTypeAccommodation($type_accommodation)
    {
        $this->type_accommodation = $type_accommodation;
        return $this;
    }
}
