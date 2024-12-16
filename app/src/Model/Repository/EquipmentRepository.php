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

    public function getAllForEquipment(int $id): array
    {
        $query = sprintf(
            'SELECT * FROM `%s` WHERE equipment_id=:equipment_id',
            $this->getMappingAccommodation()
        );

        $sth = $this->pdo->prepare($query);

        if (! $sth) {
            return [];
        }

        $success = $sth->execute(['equipment_id' => $id]);

        if (! $success) {
            return [];
        }

        $data = [];

        while ($object_data = $sth->fetch()) {
            $equipment = new Equipment($object_data);
            $data[] = $equipment;
        }

        return $data;
    }

    public function attachForEquipment(array $ids_accommodations, int $equipment_id): bool
    {
        $query_values = [];
        foreach ($ids_accommodations as $accommodation_id) {
            $query_values[] = sprintf('( %s,%s )', $accommodation_id, $equipment_id);
        }

        $query = sprintf(
            'INSERT INTO `%s` 
                (`accommodation_id`, `equipment_id`) 
                VALUES %s',
            $this->getMappingAccommodation(),
            implode(',', $query_values)
        );

        $sth = $this->pdo->prepare($query);

        if (! $sth) {
            return false;
        }

        $success = $sth->execute();

        return $success;
    }

    public function detachAllForEquipment(int $id): bool
    {
        $query = sprintf(
            'DELETE FROM `%s` WHERE equipment_id=:id',
            $this->getMappingAccommodation()
        );

        $sth = $this->pdo->prepare($query);

        if (! $sth) {
            return false;
        }

        $success = $sth->execute(['id' => $id]);

        return $success;
    }
}
