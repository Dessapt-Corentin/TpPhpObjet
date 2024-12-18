<?php

namespace App\Model\Entity;

use App\Model\Repository\RepoManager;
use Symplefony\Model\Entity;
use App\Model\Repository\EquipmentRepository;

class Accommodation extends Entity
{
    protected int $id;
    public function getId(): int
    {
        return $this->id;
    }

    protected int $adresse_id;
    public function getAdresseId(): int
    {
        return $this->adresse_id;
    }
    public function setAdresseId(int $value): self
    {
        $this->id = $value;
        return $this;
    }

    protected float $price;
    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice(int $value): self
    {
        $this->price = $value;
        return $this;
    }

    protected int $id_type;
    public function getIdType(): int
    {
        return $this->id_type;
    }
    public function setIdType(int $value): self
    {
        $this->id_type = $value;
        return $this;
    }

    protected int $size;
    public function getSize(): int
    {
        return $this->size;
    }
    public function setSize(int $value): self
    {
        $this->size = $value;
        return $this;
    }

    protected string $description;
    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $value): self
    {
        $this->description = $value;
        return $this;
    }

    protected int $beds;
    public function getBeds(): int
    {
        return $this->beds;
    }
    public function setBeds(int $value): self
    {
        $this->beds = $value;
        return $this;
    }

    protected int $owner_id;
    public function getOwnerId(): int
    {
        return $this->owner_id;
    }
    public function setOwnerId(int $value): self
    {
        $this->owner_id = $value;
        return $this;
    }

    protected ?string $image = null;
    public function getImage(): ?string
    {
        return $this->image;
    }
    public function setImage(?string $value): self
    {
        $this->image = $value;
        return $this;
    }

    protected ?string $label = null;
    public function getLabel(): ?string
    {
        return $this->label;
    }
    public function setLabel(?string $value): self
    {
        $this->label = $value;
        return $this;
    }

    protected ?string $accommodation_id = null;
    public function getAccommodationId(): ?string
    {
        return $this->accommodation_id;
    }

    public function setAccommodationId(?string $value): self
    {
        $this->accommodation_id = $value;
        return $this;
    }

    protected ?string $equipments_id = null;
    public function getEquipmentId(): ?string
    {
        return $this->equipments_id;
    }

    public function setEquipmentId(?string $value): self
    {
        $this->equipments_id = $value;
        return $this;
    }


    // Liaison avec la table adresse
    protected Adresse $adresse;
    public function getAdress(): Adresse
    {
        if (!isset($this->adresse)) {
            $this->adresse = RepoManager::getRM()->getAdresseRepo()->getById($this->adresse_id);
        }
        return $this->adresse;
    }

    public function setAdress(Adresse $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    // Liaison avec la table type
    protected TypeAccommodation $type;
    public function getType(): TypeAccommodation
    {
        if (!isset($this->type)) {
            $this->type = RepoManager::getRM()->getTypeAccommodationRepo()->getById($this->id_type);
        }
        return $this->type;
    }

    public function setType(TypeAccommodation $type): self
    {
        $this->type = $type;
        return $this;
    }

    // Liaison avec la table user
    protected User $owner;
    public function getOwner(): User
    {
        if (!isset($this->owner)) {
            $this->owner = RepoManager::getRM()->getUserRepo()->getById($this->owner_id);
        }
        return $this->owner;
    }

    public function setOwner(User $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    // Liaison avec la table equipment
    protected array $equipments;
    public function getEquipments(): array
    {
        if (!isset($this->equipments)) {
            $this->equipments = RepoManager::getRM()->getEquipmentRepo()->getAllForAccommodation($this->id);
        }
        return $this->equipments;
    }

    public function addEquipments(array $ids_equipments): self
    {
        $equipment_repo = RepoManager::getRM()->getEquipmentRepo();

        $equipment_repo->detachAllForAccommodation($this->id);

        if (empty($ids_equipments)) {
            return $this;
        }

        $equipment_repo->attachForAccommodation($ids_equipments, $this->id);

        return $this;
    }
}
