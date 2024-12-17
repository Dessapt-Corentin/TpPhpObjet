<?php

namespace App\Controller;

use App\Model\Entity\Rental;
use App\Model\Repository\RepoManager;
use Symplefony\Controller;
use Symplefony\View;
use Laminas\Diactoros\ServerRequest;

class RentalController extends Controller
{

    public function addRental(int $id): void
    {
        $view = new View('user:create-rental');
        $accommodation = RepoManager::getRM()->getAccommodationRepo()->getById($id);
        $data = [
            'title' => 'Créer une location - Airbnb.com',
            'accommodation' => $accommodation
        ];
        $view->render($data);
    }


    public function createRental(ServerRequest $request): void
    {
        $rental_data = $request->getParsedBody();

        $accommodation_id = $rental_data['accommodation_id'];
        $accommodation = RepoManager::getRM()->getAccommodationRepo()->getById($accommodation_id);

        if (!$accommodation) {
            $this->redirect('/');
        }

        $date_start = date('Y-m-d H:i:s', strtotime($rental_data['date_start']));
        $date_end = date('Y-m-d H:i:s', strtotime($rental_data['date_end']));
        $user_id = $_SESSION['user']->getId();

        $rental = new Rental();

        $rental->setAccommodationId($accommodation_id);

        $rental->setDateStart(new \DateTime($date_start));
        $rental->setDateEnd(new \DateTime($date_end));
        $rental->setUserId($user_id);

        RepoManager::getRM()->getRentalRepo()->create($rental);

        $this->redirect('/');
    }

    // On va afficher la liste des locations pour un utilisateur connecté en reconvertissant les dates en string
    public function listRental(int $id): void
    {
        $view = new View('user:list-rental');
        $rentals = RepoManager::getRM()->getRentalRepo()->getByUserId($id);
        foreach ($rentals as $rental) {
            $rental->setDateStart($rental->getDateStart());
            $rental->setDateEnd($rental->getDateEnd());
        }
        $data = [
            'title' => 'Mes locations',
            'rentals' => $rentals
        ];

        $view->render($data);
    }

    // Je veux lister les rentals faite sur les biens de l'utilisateur connecté
    public function listReserve(): void
    {
        $view = new View('user:list-who-reserve');
        $rentals = RepoManager::getRM()->getRentalRepo()->getAllForOwner($_SESSION['user']->getId());
        foreach ($rentals as $rental) {
            $rental->setDateStart($rental->getDateStart());
            $rental->setDateEnd($rental->getDateEnd());
        }
        $data = [
            'title' => 'Mes locations de biens',
            'rentals' => $rentals
        ];

        $view->render($data);
    }
}
