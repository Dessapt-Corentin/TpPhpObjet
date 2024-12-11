<?php

namespace App\Model\Repository;

use App\Model\Entity\AccommodationEquipment;
use Symplefony\Model\Repository;

class AccommodationEquipmentRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'types_accommodations';
    }

    public function getAll(): array
    {
        return $this->readAll(AccommodationEquipment::class);
    }

    public function getById(int $id): ?AccommodationEquipment
    {
        return $this->readById(AccommodationEquipment::class, $id);
    }
    
}
