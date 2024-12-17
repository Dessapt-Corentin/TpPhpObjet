<?php

namespace App\Model\Repository;

use App\Model\Entity\Accommodation;
use App\Model\Entity\AccommodationEquipment;
use App\Model\Entity\Equipment;
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
    public function getById(int $accommodation_id): ?AccommodationEquipment
    {
        $query = sprintf(
            'SELECT * FROM `%s` WHERE accommodation_id=:accommodation_id',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare($query);
        $sth->execute(['accommodation_id' => $accommodation_id]);
        return $sth->fetchObject(AccommodationEquipment::class) ?: null;
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

    public function create(array $accommodationEquipment): ?AccommodationEquipment
    {
        // Insert the accommodation equipment data into the accommodations_equipments table
        $query = 'INSERT INTO accommodations_equipments (accommodation_id, equipments_id)
                  VALUES (:accommodation_id, :equipments_id)';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'accommodation_id' => $accommodationEquipment['accommodation_id'],
            'equipments_id' => $accommodationEquipment['equipments_id']
        ]);

        // Retrieve the ID of the inserted accommodation equipment
        $id = $this->pdo->lastInsertId();
        return $this->getById($id);
    }
}
