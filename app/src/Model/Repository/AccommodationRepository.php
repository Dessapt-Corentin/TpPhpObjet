<?php

namespace App\Model\Repository;

use App\Model\Entity\Accommodation;
use Symplefony\Model\Repository;

class AccommodationRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'accommodations';
    }

    /* Crud: Create */
    // TODO la méthode 

    /* cRud: Read tous les items */
    public function getAll(): array
    {
        return $this->readAll(Accommodation::class);
    }

    /* cRud: Read un item par son id */
    public function getById(int $id): ?Accommodation
    {
        return $this->readById(Accommodation::class, $id);
    }
}
