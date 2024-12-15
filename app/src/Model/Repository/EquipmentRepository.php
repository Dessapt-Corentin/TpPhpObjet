<?php

namespace App\Model\Repository;

use App\Model\Entity\Equipment;
use Symplefony\Model\Repository;

class EquipmentRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'equipments';
    }

    public function getAll(): array
    {
        return $this->readAll(Equipment::class);
    }

    public function getById(int $id): ?Equipment
    {
        return $this->readById(Equipment::class, $id);
    }

    public function getbyLabel(): ?Equipment
    {
        return $this->readByLabel(Equipment::class, $label);
    }

    
}
