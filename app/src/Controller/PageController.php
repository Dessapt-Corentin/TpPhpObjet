<?php

namespace App\Controller;

use Symplefony\View;

use Symplefony\Controller;

class PageController extends Controller
{
    // Page d'accueil
    public function index(): void
    {
        $view = new View('page:home');

        $data = [
            'title' => 'Accueil - Airbnb.com',
        ];

        $view->render($data);
    }

    // Page de mentions légales
    public function legalMentions(): void
    {
        echo 'Mentions légales depuis le controller';
    }
}
