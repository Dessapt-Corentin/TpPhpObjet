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
        $type_accommodation = RepoManager::getRM()->getAccommodationTypeRepo()->getAll();
        $data = [
            'title' => 'Ajouter un bien',
            'types_accommodations' => $type_accommodation

        ];
        $view->render($data);
    }

    // Biens: Création


    // Biens: Liste
    public function list(): void
    {
        $view = new View('accommodation');
        $data = [
            'title' => 'Liste des biens',
            'accommodations' => RepoManager::getRM()->getAccommodationRepo()->getAll()
        ];
        $view->render($data);
    }

    public function create(ServerRequest $request): void
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
            'owner_id' => $accommodation_data['owner_id']
        ];

        RepoManager::getRM()->getAccommodationRepo()->create($data_accommodation);



        // $accommodation = new Accommodation($accommodation_data);
        // $user_id = $request->getAttribute('user_id'); // Assuming user_id is available in the request
        // $accommodation->setId($user_id);
        // $accommodation_created = RepoManager::getRM()->getAccommodationRepo()->create($accommodation->toArray());
        // if (is_null($accommodation_created)) {
        //     $this->redirect('/accommodations/add');
        // }
        // $this->redirect('/');
    }
}
