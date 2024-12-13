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

    protected string $label = '';
    public function getEquipment()
    {
        return $this->label;
    }

}
