<?php

namespace App\Model\Repository;

use App\Controller\SessionController;
use App\Model\Entity\Accommodation;
use App\Model\Entity\Adresse;
use PDO;
use Symplefony\Model\Repository;

class AccommodationRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'accommodations';
    }

    /* Crud: Create */
    public function create(array $accommodation): ?Accommodation
    {
        // // 3. Gérer l'upload d'image
        // $image_name = null;
        // if (!empty($_FILES['image']['name'])) {
        //     $image = $_FILES['image']['name'];
        //     $format = $_FILES['image']['type'];
        //     $tmp_name = $_FILES['image']['tmp_name'];
        //     $dir_name = __DIR__ . '/../../../public/image/';

        //     if (!in_array($format, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'])) {
        //         echo "Erreur : Format d'image non pris en charge.";
        //         return null;
        //     }

        //     // Nom unique pour l'image
        //     $image_name = uniqid() . '_' . $image;

        //     if (!move_uploaded_file($tmp_name, $dir_name . $image_name)) {
        //         echo "Erreur : Impossible de déplacer l'image.";
        //         return null;
        //     }
        // }


        // 1. Insérer les données de accommodation dans la table accommodations
        $queryAccommodation = 'INSERT INTO accommodations (adresse_id, price, id_type,size,description,beds,owner_id)
        VALUES (:adresse_id, :price, :id_type, :size, :description, :beds, :owner_id)';
        $stmtAccommodation = $this->pdo->prepare($queryAccommodation);
        $stmtAccommodation->execute($accommodation);



        // 2. Récupérer l'ID de l'accommodation inséré
        return $this->getById($this->pdo->lastInsertId());
    }

    // Récupérer tous les accommodations
    public function getAll(): array
    {
        return $this->readAll(Accommodation::class);
    }

    // Récupérer un Accommodation par son ID
    public function getById(int $id): ?Accommodation
    {
        return $this->readById(Accommodation::class, $id);
    }
}
