<?php

namespace App\Model\Repository;

use App\Model\Entity\Equipment;
use Symplefony\Model\Repository;

class EquipmentRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'equipments';
    }
    private function getMappingAccommodation(): string
    {
        return 'accommodations_equipments';
    }

    public function getAll(): array
    {
        return $this->readAll(Equipment::class);
    }

    public function getById(int $id): ?Equipment
    {
        return $this->readById(Equipment::class, $id);
    }

    public function getByLabel(string $label): ?Equipment
    {
        $query = sprintf(
            'SELECT * FROM `%s` WHERE label=:label',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare($query);

        if (! $sth) {
            return null;
        }

        $success = $sth->execute(['label' => $label]);

        if (! $success) {
            return null;
        }

        $object_data = $sth->fetch();

        if ($object_data) {
            return new Equipment($object_data);
        }

        return null;
    }

    public function getAllForAccommodation(int $id): array
    {
        $query = sprintf(
            'SELECT equipments.* FROM `%1$s` as equipments 
            JOIN `%2$s` as accommodations_equipments ON accommodations_equipments.equipments_id = equipments.id
            WHERE accommodations_equipments.accommodation_id=:id',
            $this->getTableName(),
            $this->getMappingAccommodation()
        );

        $sth = $this->pdo->prepare($query);

        if (! $sth) {
            return [];
        }

        $success = $sth->execute([
            'id' => $id
        ]);

        if (! $success) {
            return [];
        }

        $equipments = [];

        while ($equipment_data = $sth->fetch()) {
            $equipments[] = new Equipment($equipment_data);
        }

        return $equipments;
    }

    public function detachAllForAccommodation(int $id): bool
    {
        $query = sprintf(
            'DELETE FROM `%s` WHERE accommodation_id=:id',
            $this->getMappingAccommodation()
        );

        $sth = $this->pdo->prepare($query);

        if (! $sth) {
            return false;
        }

        $success = $sth->execute(['id' => $id]);

        return $success;
    }

    public function attachForAccommodation( array $ids_equipments, int $accommodation_id): bool
    {
        $query_values = [];
        foreach($ids_equipments as $equipments_id) {
            $query_values[] = sprintf('(%s, %s)', $equipments_id, $accommodation_id);
        }

        $query = sprintf(
            'INSERT INTO `%s` (equipments_id, accommodation_id) VALUES %s',
            $this->getMappingAccommodation(),
            implode(',', $query_values)
        );

        $sth = $this->pdo->prepare($query);

        if (! $sth) {
            return false;
        }

        $success = $sth->execute();
    }
}
