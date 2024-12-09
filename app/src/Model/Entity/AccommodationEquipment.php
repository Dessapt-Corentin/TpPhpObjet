<?php

namespace App\Model\Entity;

use Symplefony\Model\Entity;

class AccommodationEquipment extends Entity
{
    protected int $accommodation_id;
    public function getAccommodationId(): int
    {
        return $this->accommodation_id;
    }
    public function setAccommodationId(int $value): self
    {
        $this->accommodation_id = $value;
        return $this;
    }

    protected int $equipment_id;
    public function getEquipmentId(): int
    {
        return $this->equipment_id;
    }
    public function setEquipmentId(int $value): self
    {
        $this->equipment_id = $value;
        return $this;
    }
}
