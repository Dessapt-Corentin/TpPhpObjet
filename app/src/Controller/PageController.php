<?php

namespace App\Controller;

use App\Model\Repository\RepoManager;
use Symplefony\View;

use Symplefony\Controller;

class PageController extends Controller
{
    // Page d'accueil
    public function index(): void
    {
        $view = new View('page:home');
        $accommodations = RepoManager::getRM()->getAccommodationRepo()->getAll();

        $data = [
            'title' => 'Accueil - Easyloc.com',
            'accommodations' => $accommodations
        ];

        $view->render($data);
    }
}
