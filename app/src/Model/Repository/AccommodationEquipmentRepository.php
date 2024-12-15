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

    // Récupérer l'id de l'accommodations pour la mettre dans la table accommodations_equipments
    public function getById(int $id): ?AccommodationEquipment
    {
        return $this->readById(AccommodationEquipment::class, $id);
    }

    // Récupérer les équipements d'un seul accommodation par son accommodation ID
    public function getByAccommodationId(int $accommodation_id): array
    {
        $query = sprintf(
            'SELECT * FROM `%s` WHERE accomodation_id=:accomodation_id',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare($query);
        $sth->execute(['accomodation_id' => $accommodation_id]);
        return $sth->fetchAll(\PDO::FETCH_CLASS, AccommodationEquipment::class);
    }

    

    public function create(array $accommodation_equipment): ?AccommodationEquipment
    {
        $query = "INSERT INTO accommodations_equipments (accomodation_id, equipments_id) VALUES (:accomodation_id, :equipments_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($accommodation_equipment);
        return $this->getById($this->pdo->lastInsertId());
    }

}
