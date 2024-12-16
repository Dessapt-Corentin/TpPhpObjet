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
            'INSERT INTO `%s` (user_id, accommodation_id, start_date, end_date) VALUES (:user_id, :accommodation_id, :start_date, :end_date)',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare($query);

        // Si la préparation échoue
        if (! $sth) {
            return null;
        }

        //ToDO reformater les dates


        $success = $sth->execute([
            'user_id' => $_SESSION['user']->getId(),
            'accommodation_id' => $rental->getAccommodationId(),
            'start_date' => $rental->getDateStart(),
            'end_date' => $rental->getDateEnd()
        ]);

        // Si echec
        if (! $success) {
            return null;
        }

        // On récupère l'id de l'objet créé
        $rental->setId((int) $this->pdo->lastInsertId());

        return $rental;
    }
}
