<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Validators\User\Profil;

use App\Http\Repository\Admin\Users\UsersRepository;

class ProfilValidator
{
    private array $errors = [];

    public function editProfile($old_user)
    {
        if (isset($_POST['submit'])) {
            $repo = new UsersRepository();

            // Vérification et nettoyage des champs
            $firstname = isset($_POST['firstname']) && !empty($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : '';
            $lastname = isset($_POST['lastname']) && !empty($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : '';
            $username = isset($_POST['username']) && !empty($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
            $age = isset($_POST['age']) && !empty($_POST['age']) ? htmlspecialchars((int)$_POST['age']) : '';
            $email = isset($_POST['email']) && !empty($_POST['email']) ? filter_var(htmlspecialchars($_POST['email']), FILTER_VALIDATE_EMAIL) : '';
            $phone_number = isset($_POST['phone_number']) && !empty($_POST['phone_number']) ? htmlspecialchars($_POST['phone_number']) : '';
            $password = isset($_POST['password']) && !empty($_POST['password']) ? sha1(htmlspecialchars($_POST['password'])) : '';
            $password_confirmation = isset($_POST['password_confirmation']) && !empty($_POST['password_confirmation']) ? htmlspecialchars(sha1($_POST['password_confirmation'])) : '';


            if (
                $firstname != $old_user->firstname ||
                $lastname != $old_user->lastname ||
                $username != $old_user->username ||
                $age != $old_user->age ||
                $email != $old_user->email ||
                $phone_number != $old_user->phone_number ||
                $password != $old_user->password ||
                $password_confirmation != $old_user->password_confirmation
           ) {

                $repo->updateUserProfile(
                    $old_user->id,
                    $firstname,
                    $lastname,
                    $username,
                    $age,
                    $email,
                    $phone_number,
                    $password,
                    $password_confirmation
                );
                header('Location: /profil');
                exit();
            } else {
                $this->setErrors('Aucun changement détecté');
            }
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors($errors): void
    {
        $this->errors[] = $errors;
    }
}
