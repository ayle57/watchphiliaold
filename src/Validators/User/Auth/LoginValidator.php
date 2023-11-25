<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Validators\User\Auth;

use App\Helpers\Base\BaseRepository;

class LoginValidator
{
    private array $errors = [];

    public function login()
    {
        if (isset($_POST['submit'])) {

            // Email
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $email = htmlspecialchars($_POST['email']);

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    // Password
                    if (isset($_POST['password']) && !empty($_POST['password'])) {
                        $password = htmlspecialchars(sha1($_POST['password']));

                        $repo = new BaseRepository();
                        $pdo = $repo->db;

                        $stmt = 'SELECT * FROM users WHERE email = ? AND password = ?';
                        $req = $pdo->prepare($stmt);
                        $fetch = $req->execute([$email, $password]);

                        $userExist = $req->rowCount();

                        if ($userExist == 1) {
                            $user = $repo->selectOne('users', 'email', $email);

                            $_SESSION['user_login'] = 1;
                            $_SESSION['user'] = $user;

                            header('Location: /');
                            exit;
                        } else {
                            $this->setErrors('L\'utilisateur n\'existe pas');
                        }

                    } else {
                        $this->setErrors('Veuillez entrer un mot de passe');
                    }

                } else {
                    $this->setErrors('Veuillez entrer une adresse email valide');
                }

            } else {
                $this->setErrors('Veuillez entrer une adresse email');
            }

        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors($errors)
    {
        $this->errors[] = $errors;
    }
}