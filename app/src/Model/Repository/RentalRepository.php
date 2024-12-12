<?php

namespace App\Model\Repository;

use App\Model\Entity\Rental;
use Symplefony\Model\Repository;

class RentalRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'rentals';
    }

    public function getAll(): array
    {
        return $this->readAll(Rental::class);
    }

    public function getById(int $id): ?Rental
    {
        return $this->readById(Rental::class, $id);
    }

    
    public function create(Rental $rental): ?Rental
    {

        $query = sprintf(
            'INSERT INTO `%s`
    (user_id, accommodation_id, date_start, date_end)
    VALUES (:user_id, :accommodation_id, :date_start, :date_end)',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare($query);

        // Si la préparation échoue
        if (! $sth) {
            return null;
        }

        $success = $sth->execute([
            'user_id' => $rental->getUserId(),
            'accommodation_id' => $rental->getAccommodationId(),
            'date_start' => $rental->getDateStart(),
            'date_end' => $rental->getDateEnd(),
        ]);
        var_dump($success);
        die();

        // Si echec de l'insertion
        if (! $success) {
            return null;
        }

        // Ajout de l'id de l'item créé en base de données
        $rental->setId($this->pdo->lastInsertId());

        return $rental;
    }
}
