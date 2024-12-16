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
    public function addAccommodation(): void
    {
        $view = new View('user:create-accommodation');
        $type_accommodation = RepoManager::getRM()->getTypeAccommodationRepo()->getAll();
        $data = [
            'title' => 'Ajouter un bien',
            'types_accommodations' => $type_accommodation,
            'equipments' => RepoManager::getRM()->getEquipmentRepo()->getAll()
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

        // Insert into accommodations_equipments table
        if (isset($accommodation_data['equipments']) && is_array($accommodation_data['equipments'])) {
            foreach ($accommodation_data['equipments'] as $equipment_id) {
                RepoManager::getRM()->getAccommodationEquipmentRepo()->create([
                    'accommodation_id' => $accommodation_id,
                    'equipment_id' => $equipment_id
                ]);
            }
        }

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
