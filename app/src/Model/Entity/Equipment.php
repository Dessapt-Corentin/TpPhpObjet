<?php

namespace App\Model\Entity;

use Symplefony\Model\Entity;

class Equipment extends Entity
{
    protected int $id;
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): self
    {
        $this->id = $value;
        return $this;
    }

    protected string $label;
    public function getEquipment()
    {
        return $this->label;
    }

    public function setEquipment(string $value): self
    {
        $this->label = $value;
        return $this;
    }
}
