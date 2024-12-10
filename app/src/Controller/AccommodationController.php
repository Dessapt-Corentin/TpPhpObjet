<?php

namespace App\Controller;

use App\Model\Repository\RepoManager;
use Symplefony\Controller;
use Symplefony\View;

class AccommodationController extends Controller
{
    // Biens: Liste
    public function list(): void
    {
        $view = new View('accommodation:admin:accommodation');
        $data = [
            'title' => 'Liste des biens',
            'accommodations' => RepoManager::getRM()->getAccommodationRepo()->getAll()
        ];
        $view->render($data);
    }
}
