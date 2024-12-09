<?php

namespace App\Model\Repository;

use App\Model\Repository\AccommodationRepository;
use Symplefony\Database;
use Symplefony\Model\RepositoryManagerTrait;

class RepoManager
{
    use RepositoryManagerTrait;

    private static ?self $instance = null;
    private UserRepository $user_repository;
    private AccommodationRepository $accommodation_repository;

    public function getUserRepo(): UserRepository
    {
        return $this->user_repository;
    }

    public function getAccommodationRepo(): AccommodationRepository
    {
        return $this->accommodation_repository;
    }

    private function __construct()
    {
        $pdo = Database::getPDO();

        $this->user_repository = new UserRepository($pdo);
    }
}
