<?php

namespace App\Model\Repository;

use Symplefony\Model\Repository;

use App\Model\Entity\User;
use PDO;

class UserRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'users';
    }

    /* Crud: Create */
    public function create(User $user): ?User
    {

        // Hachage du mot de passe
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $user->setPassword($hashedPassword); // Met à jour l'objet User avec le mot de passe haché

        $query = sprintf(
            'INSERT INTO `%s` 
                (`password`,`email`,`firstname`,`lastname`,`phone_number`,`role`) 
                VALUES (:password,:email,:firstname,:lastname,:phone_number,:role)',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare($query);

        // Si la préparation échoue
        if (! $sth) {
            return null;
        }

        $success = $sth->execute([
            'password' => $user->getPassword(),
            'email' => $user->getEmail(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'phone_number' => $user->getPhoneNumber(),
            'role' => $user->getRole()
        ]);

        // Si echec de l'insertion
        if (! $success) {
            return null;
        }

        // Ajout de l'id de l'item créé en base de données
        $user->setId($this->pdo->lastInsertId());

        return $user;
    }

    /* cRud: Read tous les items */
    public function getAll(): array
    {
        return $this->readAll(User::class);
    }

    /* cRud: Read un item par son id */
    public function getById(int $id): ?User
    {
        return $this->readById(User::class, $id);
    }

    public function login(string $email, string $password): ?User
    {
        $query = sprintf(
            'SELECT * FROM `%s` WHERE `email` = :email',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare($query);

        // Si la préparation échoue
        if (! $sth) {
            return null;
        }

        $sth->execute(['email' => $email]);

        $user = $sth->fetchObject(User::class);

        // Si l'email n'existe pas
        if (! $user) {
            return null;
        }

        // Si le mot de passe ne correspond pas
        if (! password_verify($password, $user->getPassword())) {
            return null;
        }

        return $user;
    }

    public function getByEmail(string $email): ?User
    {
        $query = sprintf(
            'SELECT * FROM `%s` WHERE email = :email',
            $this->getTableName()
        );

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['email' => $email]);

        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user_data) {
            $user = new User();
            $user->setId($user_data['id']);
            $user->setEmail($user_data['email']);
            $user->setPassword($user_data['password']); // Haché
            $user->setFirstname($user_data['firstname']);
            return $user;
        }

        return null; // L'utilisateur n'a pas été trouvé
        $user = $repo->getByEmail($user_data['email']);
        var_dump($user);
        exit();
    }
}
