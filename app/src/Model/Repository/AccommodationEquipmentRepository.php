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

    public function create(Accommodation $accommodation, Equipment $equipment)
    {
        $accommodationId = $accommodation->getId();
        $equipmentId = $equipment->getId();

        $query = sprintf(
            'INSERT INTO `%s` (accommodation_id, equipments_id) VALUES (:accommodation_id, :equipments_id)',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare($query);
        $sth->execute([
            'accommodation_id' => $accommodationId,
            'equipments_id' => $equipmentId
        ]);

        return $this->getById($this->pdo->lastInsertId());
    }

    public function detachAllForAccommodation(int $id): bool
    {
        $query = sprintf(
            'DELETE FROM `%s` WHERE accommodation_id=:id',
            $this->getMappingAccommodation()
        );

        $sth = $this->pdo->prepare($query);

        // Si la préparation échoue
        if (! $sth) {
            return false;
        }

        $success = $sth->execute(['id' => $id]);

        return $success;
    }

    /* Insére les liaisons de catégories demandée pour d'une voiture donnée */
    public function attachForAccommodation(array $ids_categories, int $accommodation_id): bool
    {
        $query_values = [];
        foreach ($ids_categories as $category_id) {
            $query_values[] = sprintf('( %s,%s )', $category_id, $accommodation_id);
        }

        $query = sprintf(
            'INSERT INTO `%s` 
                (`category_id`, `accommodation_id`) 
                VALUES %s',
            $this->getMappingAccommodation(),
            implode(',', $query_values)
        );

        $sth = $this->pdo->prepare($query);

        // Si la préparation échoue
        if (! $sth) {
            return false;
        }

        return $sth->execute();
    }
}
