<?php

namespace App\Controller;

use App\Model\Repository\RepoManager;
use Symplefony\Controller;
use Symplefony\View;

class AccommodationController extends Controller
{
    // Biens: Ajout
    public function add(): void
    {
        $view = new View('accommodation:admin:add');
        $data = [
            'title' => 'Ajouter un bien'
        ];
        $view->render($data);
    }

    // Biens: Création


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
