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

    protected string $label;
    public function getLabel(): string
    {
        return $this->label;
    }
    public function setLabel(string $value): self
    {
        $this->label = $value;
        return $this;
    }
}
