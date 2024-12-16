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

        $rental_data['date_start'] = date('Y-m-d H:i:s', strtotime($rental_data['date_start']));
        $rental_data['date_end'] = date('Y-m-d H:i:s', strtotime($rental_data['date_end']));
        $rental_data['user_id'] = $_SESSION['user']->getId();

        $rental = new Rental();
        RepoManager::getRM()->getRentalRepo()->create($rental);

        $this->redirect('/');
    }

    // On va lister toutes les rentals de l'utilisateur connécté en session
    public function list($id): void
    {
        $view = new View('user:list-rental');
        $rentals = RepoManager::getRM()->getRentalRepo()->getByUserId($id);
        $data = [
            'title' => 'Mes locations - Airbnb.com',
            'rentals' => $rentals
        ];
        $view->render($data);
    }
}
