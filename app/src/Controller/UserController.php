<?php

namespace App\Controller;

use App\Model\Entity\User;
use App\Model\Repository\RepoManager;
use Laminas\Diactoros\ServerRequest;
use Symplefony\Controller;
use Symplefony\View;
use App\Model\UserModel;

class UserController extends Controller
{
    /**
     * Pages Publique
     */
    // Affichage du formulaire de création d'un utilisateur
    public function add(): void
    {
        $view = new View('user:create-account');
        $data = [
            'title' => 'Créer mon compte - Airbnb.com'
        ];
        $view->render($data);
    }
    // Admin: Traitement du formulaire de création d'un utilisateur
    public function create(ServerRequest $request): void
    {
        $user_data = $request->getParsedBody();
        $user = new User($user_data);
        $user_created = RepoManager::getRM()->getUserRepo()->create($user);
        if (is_null($user_created)) {
            // TODO: gérer une erreur
            $this->redirect('/users/add');
        }
        $this->redirect('/users');
    }
}
