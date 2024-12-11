<?php

namespace App\Model\Repository;

use App\Model\Entity\Adresse;
use Symplefony\Model\Repository;

class AdresseRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'adresses';
    }

    public function getAll(): array
    {
        return $this->readAll(Adresse::class);
    }

    public function getById(int $id): ?Adresse
    {
        return $this->readById(Adresse::class, $id);
    }

    public function create(array $data): int
    {
        $query = "INSERT INTO adresses (country, city, adress, postal_code) VALUES (:country, :city, :adress, :postal_code)";
        $sth = $this->pdo->prepare($query);
        $sth->execute($data);
        return (int) $this->pdo->lastInsertId();
    }
}
