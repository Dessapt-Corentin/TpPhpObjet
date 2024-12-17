<?php

namespace App\Model\Repository;

use App\Model\Entity\Rental;
use Symplefony\Model\Repository;
use DateTime;

class RentalRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'rentals';
    }
    private function getMappingAccommodation(): string
    {
        return 'accommodations';
    }

    public function getAll(): array
    {
        return $this->readAll(Rental::class);
    }

    public function getById(int $id): ?Rental
    {
        return $this->readById(Rental::class, $id);
    }

    public function getByUserId(int $userId): array
    {
        $query = 'SELECT * FROM rentals WHERE user_id = :user_id';
        $sth = $this->pdo->prepare($query);
        $sth->execute(['user_id' => $userId]);

        $results = $sth->fetchAll();
        $rentals = [];

        foreach ($results as $result) {
            $rental = new Rental();
            $rental->setId($result['id']);
            $rental->setAccommodationId($result['accommodation_id']);
            $rental->setDateStart(new \DateTime($result['date_start'])); // Conversion ici
            $rental->setDateEnd(new \DateTime($result['date_end']));     // Conversion ici
            $rentals[] = $rental;
        }

        return $rentals;
    }

    public function create(Rental $rental): ?Rental
    {
        $query = sprintf(
            'INSERT INTO `%s` (user_id, accommodation_id, date_start, date_end) VALUES (:user_id, :accommodation_id, :date_start, :date_end)',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare($query);

        // Si la préparation échoue
        if (! $sth) {
            return null;
        }

        // Formater string en date
        $date_start = $rental->getDateStart()->format('Y-m-d H:i:s');
        $date_end = $rental->getDateEnd()->format('Y-m-d H:i:s');



        $success = $sth->execute([
            'user_id' => $_SESSION['user']->getId(),
            'accommodation_id' => $rental->getAccommodationId(),
            'date_start' => $date_start,
            'date_end' => $date_end
        ]);

        // Si echec
        if (! $success) {
            return null;
        }

        // On récupère l'id de l'objet créé
        $rental->setId((int) $this->pdo->lastInsertId());

        return $rental;
    }

    public function getAllForOwner(): array
    {
        $query = 'SELECT * FROM rentals r JOIN accommodations a ON r.accommodation_id = a.id WHERE a.owner_id = :owner_id';
        $sth = $this->pdo->prepare($query);
        $sth->execute(['owner_id' => $_SESSION['user']->getId()]);

        $results = $sth->fetchAll();
        $rentals = [];

        foreach ($results as $result) {
            $rental = new Rental();
            $rental->setId($result['id']);
            $rental->setAccommodationId($result['accommodation_id']);
            $rental->setDateStart(new \DateTime($result['date_start'])); // Conversion ici
            $rental->setDateEnd(new \DateTime($result['date_end']));     // Conversion ici
            $rentals[] = $rental;
        }

        return $rentals;
    }
}
