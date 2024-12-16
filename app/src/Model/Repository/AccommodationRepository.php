<?php

namespace App\Model\Repository;

use App\Model\Entity\Accommodation;
use App\Model\Entity\Equipment;
use PDO;
use Symplefony\Model\Repository;

class AccommodationRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'accommodations';
    }
    private function getMappingAccommodation(): string
    {
        return 'accommodations_equipments';
    }

    /* Crud: Create */
    public function create(array $accommodation): ?Accommodation
    {
        // Check if the accommodation already exists
        $queryCheck = 'SELECT * FROM accommodations WHERE adresse_id = :adresse_id AND owner_id = :owner_id';
        $stmtCheck = $this->pdo->prepare($queryCheck);
        $stmtCheck->execute(['adresse_id' => $accommodation['adresse_id'], 'owner_id' => $accommodation['owner_id']]);
        
        if ($stmtCheck->fetch()) {
            // Accommodation already exists
            return null;
        }

        // 1. Insérer les données de accommodation dans la table accommodations
        $queryAccommodation = 'INSERT INTO accommodations (adresse_id, price, id_type, size, description, beds, owner_id)
        VALUES (:adresse_id, :price, :id_type, :size, :description, :beds, :owner_id)';
        $stmtAccommodation = $this->pdo->prepare($queryAccommodation);
        $stmtAccommodation->execute($accommodation);

        // 2. Récupérer l'ID de l'accommodation inséré
        return $this->getById($this->pdo->lastInsertId());
    }

    // Récupérer tous les accommodations
    public function getAll(): array
    {
        return $this->readAll(Accommodation::class);
    }

    // Récupérer un Accommodation par son ID
    public function getById(int $owner_id): ?Accommodation
    {
        return $this->readById(Accommodation::class, $owner_id);
    }

    // Récupérer les accommodations d'un seul utilisateur par son owner ID 
    public function getByOwnerId(int $owner_id): array
    {
        $query = sprintf(
            'SELECT * FROM `%s` WHERE owner_id=:owner_id',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare($query);

        // Si la préparation échoue
        if (! $sth) {
            return null;
        }


        $success = $sth->execute(['owner_id' => $owner_id]);

        // Si echec
        if (! $success) {
            return null;
        }

        // Récupération des résultats
        $data = [];

        while ($object_data = $sth->fetch()) {
            $accommodation = new Accommodation($object_data);
            $data[] = $accommodation;
        }

        return $data;
    }


    // Todo 
    public function getAllForAccommodation(int $id): array
    {
        $query = sprintf(
            'SELECT c.* FROM `%1$s` as c 
                JOIN `%2$s` as cc ON cc.equipments_id = c.id
                WHERE cc.accommodation_id=:id',
            $this->getTableName(),
            $this->getMappingAccommodation()
        );
        $sth = $this->pdo->prepare($query);
        // Si la préparation échoue
        if (! $sth) {
            return [];
        }
        $success = $sth->execute([
            'id' => $id
        ]);
        // Si echec de l'insertion
        if (! $success) {
            return [];
        }
        $categories = [];
        while ($equipment_data = $sth->fetch()) {
            $categories[] = new Equipment($equipment_data);
        }
        return $categories;
    }

    /* Delete toutes les liaisons de catégories d'une voiture donnée */
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
    public function attachForAccommodation(array $ids_equipments, int $accommodation_id): bool
    {
        $query_values = [];
        foreach ($ids_equipments as $equipments_id) {
            $query_values[] = sprintf('( %s,%s )', $equipments_id, $accommodation_id);
        }
        $query = sprintf(
            'INSERT INTO `%s` 
                (`equipments_id`, `accommodation_id`) 
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
