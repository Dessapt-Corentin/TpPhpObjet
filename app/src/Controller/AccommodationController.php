<?php

namespace App\Controller;

use App\Model\Entity\Accommodation;
use App\Model\Repository\RepoManager;
use Laminas\Diactoros\ServerRequest;
use Symplefony\Controller;
use Symplefony\View;

class AccommodationController extends Controller
{
    // Biens: Ajout
    public function add(): void
    {
        $view = new View('user:create-accommodation');
        $type_accommodation = RepoManager::getRM()->getTypeAccommodationRepo()->getAll();
        $label = RepoManager::getRM()->getEquipmentRepo()->getAll();
        $data = [
            'title' => 'Ajouter un bien',
            'types_accommodations' => $type_accommodation,
            'equipments' => $label
        ];
        $view->render($data);
    }

    // Biens: Création
    public function createAccommodation(ServerRequest $request): void
    {
        $accommodation_data = $request->getParsedBody();

        $data_adress = [
            'country' => $accommodation_data['country'],
            'city' => $accommodation_data['city'],
            'adress' => $accommodation_data['adress'],
            'postal_code' => $accommodation_data['postal_code']
        ];

        $adress_id = RepoManager::getRM()->getAdresseRepo()->create($data_adress);
        $data_accommodation = [
            'adresse_id' => $adress_id,
            'price' => $accommodation_data['price'],
            'id_type' => $accommodation_data['id_type'],
            'size' => $accommodation_data['size'],
            'description' => $accommodation_data['description'],
            'beds' => $accommodation_data['beds'],
            'owner_id' => $_SESSION['user']->getId()
        ];

        $accommodation_id = RepoManager::getRM()->getAccommodationRepo()->create($data_accommodation);
        $data_accommodation_equipments = [
            'accommodation_id' => $accommodation_id,
            'equipment_id' => $accommodation_data['equipment_id'] ?? null
        ];


        RepoManager::getRM()->getAccommodationRepo()->create($data_accommodation);
        $this->redirect('/');
    }

    // Biens: Liste pour un utilisateur connecté
    public function list($id): void
    {
        $view = new View('user:list-accommodation');
        $accommodations = RepoManager::getRM()->getAccommodationRepo()->getByOwnerId($id);
        $data = [
            'title' => 'Mes biens',
            'accommodations' => $accommodations
        ];
        $view->render($data);
    }
}
