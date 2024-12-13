<?php

namespace App\Model\Repository;

use App\Model\Entity\AccommodationEquipment;
use Symplefony\Model\Repository;

class AccommodationEquipmentRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'accommodations_equipments';
    }

    public function getAll(): array
    {
        return $this->readAll(AccommodationEquipment::class);
    }

    public function getById(int $id): ?AccommodationEquipment
    {
        return $this->readById(AccommodationEquipment::class, $id);
    }

    public function create(array $accommodation_equipment): ?AccommodationEquipment
    {
        $query = "INSERT INTO accommodations_equipments (id_accommodation, id_equipment) VALUES (:id_accommodation, :id_equipment)";
        $sth = $this->pdo->prepare($query);
        $sth->execute($data_accommodation);
        return (int) $this->pdo->lastInsertId();
    }
    
}
