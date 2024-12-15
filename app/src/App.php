<?php

/**
 * Classe de démarrage de l'application
 */

// Déclaration du namespace de ce fichier
namespace App;

use App\Controller\AccommodationController;
use App\Controller\PageController;
use App\Controller\UserController;
use App\Controller\RentalController;
use Exception;
use Throwable;

use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;

use Symplefony\View;



final class App
{
    private static ?self $app_instance = null;

    // Le routeur de l'application
    private Router $router;
    public function getRouter(): Router
    {
        return $this->router;
    }

    public static function getApp(): self
    {
        // Si l'instance n'existe pas encore on la crée
        if (is_null(self::$app_instance)) {
            self::$app_instance = new self();
        }

        return self::$app_instance;
    }

    // Démarrage de l'application
    public function start(): void
    {
        session_start();
        $this->registerRoutes();
        $this->startRouter();
    }

    private function __construct()
    {
        // Création du routeur
        $this->router = Router::create();
    }

    // Enregistrement des routes de l'application
    private function registerRoutes(): void
    {
        $this->router->pattern('id', '\d+');

        $this->router->get('/', [PageController::class, 'index']);

        // Gestion de la création d'un compte
        $this->router->get('/users/add', [UserController::class, 'add']);
        $this->router->post('/users/add', [UserController::class, 'create']);

        // Gestion de la connexion
        $this->router->get('/users/login', [UserController::class, 'login']);
        $this->router->post('/users/login', [UserController::class, 'log']);
        $this->router->get('/users/logout', [UserController::class, 'logout']);

        $this->router->get('/users/addaccommodation', [AccommodationController::class, 'addAccommodation']);
        $this->router->post('/users/addaccommodation', [AccommodationController::class, 'createAccommodation']);
        $this->router->get('/users/listaccomodation/{id}', [AccommodationController::class, 'list']);

        $this->router->get('/users/create-rental', [RentalController::class, 'addRental']);
        $this->router->post('/users/create-rental', [RentalController::class, 'createRental']);
        $this->router->get('/users/list-rental/{id}', [RentalController::class, 'list']);

        
    }

    // Démarrage du routeur
    private function startRouter(): void
    {
        try {
            $this->router->dispatch();
        }
        // Page 404 avec status HTTP adequat pour les pages non listée dans le routeur
        catch (RouteNotFoundException $e) {
            View::renderError(404);
        }
        // Erreur 500 pour tout autre problème temporaire ou non
        catch (Throwable $e) {
            View::renderError(500);
            var_dump($e);
        }
    }

    private function __clone() {}
    public function __wakeup()
    {
        throw new Exception("Non c'est interdit !");
    }
}
