<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Validators\User\Auth;

use App\Helpers\Base\BaseRepository;
use App\Http\Repository\User\Auth\LogupRepository;

class LogupValidator
{
    private array $errors = [];

    public function logup()
    {
        if (isset($_POST['submit'])) {

            // Username
            if (isset($_POST['username']) && !empty($_POST['username'])) {
                $username = htmlspecialchars($_POST['username']);

                $repo = new BaseRepository();
                $username_exist = $repo->selectOne('users', 'username', $username);

                if($username_exist == false) {

                    // Email
                    if (isset($_POST['email']) && !empty($_POST['email'])) {
                        $email = htmlspecialchars($_POST['email']);

                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                            $repo = new BaseRepository();
                            $email_exist = $repo->selectOne('users', 'email', $email);

                            if ($email_exist === false) {

                                // Password
                                if (isset($_POST['password']) && !empty($_POST['password'])) {
                                    $password = htmlspecialchars(sha1($_POST['password']));

                                    // Password Confirmation
                                    if (isset($_POST['password_confirmation']) && !empty($_POST['password_confirmation'])) {
                                        $password_confirmation = htmlspecialchars(sha1($_POST['password_confirmation']));

                                        if($password == $password_confirmation) {

                                            $logup_repo = new LogupRepository();
                                            $logup_repo->signUp($username, $email, $password, $password_confirmation);

                                        } else {
                                            $this->setErrors('Les mot de passes ne correspondent pas');
                                        }

                                    } else {
                                        $this->setErrors('Veuillez entrer une confirmation de mot de passe');
                                    }

                                } else {
                                    $this->setErrors('Veuillez entrer un email au format email');
                                }

                            } else {
                                $this->setErrors('Votre adresse email est déjà enregistré');
                            }

                        } else {
                            $this->setErrors('Veuillez entrer un mot de passe');
                        }

                    } else {
                        $this->setErrors('Veuillez entrer une adresse éléctronique');
                    }

                } else {
                    $this->setErrors('Votre nom d\'utilisateur existe déjà');
                }

            } else {
                $this->setErrors('Veuillez entrer un nom d\'utilisateur');
            }

        }
    }

    public
    function getErrors(): array
    {
        return $this->errors;
    }

    public
    function setErrors($errors): void
    {
        $this->errors[] = $errors;
    }
}