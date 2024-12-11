<?php

namespace App\Model\Repository;

use App\Model\Entity\Rental;
use Symplefony\Model\Repository;

class RentalRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'types_accommodations';
    }

    public function getAll(): array
    {
        return $this->readAll(Rental::class);
    }

    public function getById(int $id): ?Rental
    {
        return $this->readById(Rental::class, $id);
    }
    
}
