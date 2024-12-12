<?php

namespace App\Controller;

use App\Model\Entity\Rental;
use App\Model\Repository\RepoManager;
use Symplefony\Controller;
use Symplefony\View;

class RentalController extends Controller
{

    public function add(): void
    {
        $view = new View('user:create-rental');
        $data = [
            'title' => 'Créer une location - Airbnb.com'
        ];
        $view->render($data);
    }

    public function createRental(): void
    {
        $rental = new Rental('create-rental');
        $rental->setUserId($_SESSION['user']->getId());
        $rental->setAccommodationId($_GET['accommodation_id']);
        $rental->setDateStart($_GET['date_start']);
        $rental->setDateEnd($_GET['date_end']);

        $rental_created = RepoManager::getRM()->getRentalRepo()->create($rental);
        if (is_null($rental_created)) {
            $this->redirect('/accommodations/show?id=' . $_GET['accommodation_id']);
        } else {
            $this->redirect('/');
        }
    }
}
