<?php

namespace App\Model\Repository;

use Symplefony\Database;
use Symplefony\Model\RepositoryManagerTrait;
use App\Model\Repository\AccommodationRepository;
use App\Model\Repository\TypeAccommodationRepository;

class RepoManager
{
    use RepositoryManagerTrait;

    private static ?self $instance = null;
    private UserRepository $user_repository;
    private AccommodationRepository $accommodation_repository;
    private TypeAccommodationRepository $type_accommodation;
    private AdresseRepository $adresse_repository;
    private RentalRepository $rental_repository;
    private EquipmentRepository $equipment_repository;
    private AccommodationEquipmentRepository $accommodation_equipment_repository;

    public function getUserRepo(): UserRepository
    {
        return $this->user_repository;
    }

    public function getAccommodationRepo(): AccommodationRepository
    {
        return $this->accommodation_repository;
    }

    public function getTypeAccommodationRepo(): TypeAccommodationRepository
    {
        return $this->type_accommodation;
    }

    public function getAdresseRepo(): AdresseRepository
    {
        return $this->adresse_repository;
    }

    public function getRentalRepo(): RentalRepository
    {
        return $this->rental_repository;
    }

    public function getEquipmentRepo(): EquipmentRepository
    {
        return $this->equipment_repository;
    }

    public function getAccommodationEquipmentRepo(): AccommodationEquipmentRepository
    {
        return $this->accommodation_equipment_repository;
    }



    private function __construct()
    {
        $pdo = Database::getPDO();

        $this->user_repository = new UserRepository($pdo);
        $this->accommodation_repository = new AccommodationRepository($pdo);
        $this->type_accommodation = new TypeAccommodationRepository($pdo);
        $this->adresse_repository = new AdresseRepository($pdo);
        $this->rental_repository = new RentalRepository($pdo);
        $this->equipment_repository = new EquipmentRepository($pdo);
        $this->accommodation_equipment_repository = new AccommodationEquipmentRepository($pdo);
    }
}
