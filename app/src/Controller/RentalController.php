<?php

namespace App\Controller;

use App\Model\Entity\Rental;
use App\Model\Repository\RepoManager;
use Symplefony\Controller;
use Symplefony\View;
use Laminas\Diactoros\ServerRequest;

class RentalController extends Controller
{

    public function addRental(): void
    {
        $view = new View('user:create-rental');
        $data = [
            'title' => 'Créer une location - Airbnb.com'
        ];
        $view->render($data);
    }


    public function createRental(ServerRequest $request): void
    {
        $rental_data = $request->getParsedBody();
        $rental_data['date_start'] = date('Y-m-d H:i:s', strtotime($rental_data['date_start']));
        $rental_data['date_end'] = date('Y-m-d H:i:s', strtotime($rental_data['date_end']));
        $rental = new Rental($rental_data);
        $rental->setUserId($_SESSION['user']->getId());
        $rental = RepoManager::getRM()->getRentalRepo()->create($rental);
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
