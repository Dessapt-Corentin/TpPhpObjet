<?php

namespace App\Model\Repository;

use App\Model\Entity\Accommodation;
use PDO;
use Symplefony\Model\Repository;

class AccommodationRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'accommodations';
    }

    /* Crud: Create */
    public function create(array $accommodation): ?Accommodation
    {
        // 1. Insérer les données de accommodation dans la table accommodations
        $queryAccommodation = 'INSERT INTO accommodations (adresse_id, price, id_type,size,description,beds,owner_id)
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

        // Récupération du premier résultat
        $object_data = $sth->fetch();

        // Récupération des résultats
        $data = [];

        while ($object_data = $sth->fetch()) {
            $accommodation = new Accommodation($object_data);
            $data[] = $accommodation;
        }

        return $data;
    }
}
