<?php

namespace App\Controller;

use App\Model\Entity\User;
use App\Model\Repository\RepoManager;
use Laminas\Diactoros\ServerRequest;
use Symplefony\Controller;
use Symplefony\View;

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
            'title' => 'Créer mon compte - Easyloc.com'
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
        // Ajout de l'utilisateur en session
        $user_created->setPassword('');
        $_SESSION['user'] = $user_created;

        $this->redirect('/');
    }

    
    public function login(): void
    {
        $view = new View('user:login');
        $data = [
            'title' => 'Connexion - Easyloc.com'
        ];
        $view->render($data);
    }
    
    public function log(ServerRequest $request): void
    {
        // Récupérer les données du formulaire
        $user_data = $request->getParsedBody();
        
        // Vérifier si les données sont présentes
        if (isset($user_data['email']) && isset($user_data['password'])) {
            // Charger le repository de l'utilisateur
            $repo = RepoManager::getRM()->getUserRepo();
            
            // Récupérer l'utilisateur par email
            $user = $repo->getByEmail($user_data['email']);
            
            // Vérifier si l'utilisateur existe et si le mot de passe est correct
            if ($user && password_verify($user_data['password'], $user->getPassword())) {
                // Si la connexion est réussie, l'utilisateur est authentifié
                // Ajout de l'utilisateur en session
                $user->setPassword('');
                $_SESSION['user'] = $user;
                
                // Rediriger l'utilisateur vers la page d'accueil 
                $this->redirect('/');
            } else {
                // Si l'utilisateur n'existe pas ou le mot de passe est incorrect
                echo "Email ou mot de passe incorrect.";
            }
        } else {
            // Si les champs sont vides
            echo "Veuillez remplir tous les champs.";
        }
    }
    
    public function logout(): void
    {
        // Supprimer l'utilisateur de la session
        unset($_SESSION['user']);
        
        // Détruire le cookie de session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
        }
    
        // Détruire la session
        session_destroy();
    
        // Rediriger l'utilisateur vers la page d'accueil
        $this->redirect('/');
    }

}
