<?php

namespace App\Model\Repository;

use App\Model\Entity\TypeAccommodation;
use Symplefony\Model\Repository;

class AccommodationTypeRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'types_accommodations';
    }

    public function getAll(): array
    {
        return $this->readAll(TypeAccommodation::class);
    }

    public function getById(int $id): ?TypeAccommodation
    {
        return $this->readById(TypeAccommodation::class, $id);
    }
    
}
