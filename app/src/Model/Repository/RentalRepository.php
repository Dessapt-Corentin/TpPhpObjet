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

    public function getById(int $user_id): ?Rental
    {
        return $this->readById(Rental::class, $user_id);
    }

    public function getByUserId(int $user_id): array
    {
        $query = sprintf(
            'SELECT * FROM `%s` WHERE user_id=:user_id',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare($query);

        // Si la préparation échoue
        if (! $sth) {
            return null;
        }

        $success = $sth->execute(['user_id' => $user_id]);

        // Si echec
        if (! $success) {
            return null;
        }
        
        // Récupération du premier résultat
        $object_data = $sth->fetch();

        // Récupération des résultats
        $data = [];

        while ($object_data = $sth->fetch()) {
            $rental = new Rental($object_data);
            $data[] = $rental;
        }

        return $data;
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
            'accommodation_id' => (int) $rental->getAccommodationId(),
            'date_start' => $rental->getDateStart()->format('Y-m-d H:i:s'),
            'date_end' => $rental->getDateEnd()->format('Y-m-d H:i:s'),
        ]);

        // Si echec de l'insertion
        if (! $success) {
            return null;
        }

        // Ajout de l'id de l'item créé en base de données
        $rental->setId($this->pdo->lastInsertId());

        return $rental;
    }
}
