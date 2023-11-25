<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Repository\Admin\Users;

use App\Helpers\Base\BaseRepository;

class UsersRepository extends BaseRepository
{
    public function updateUserProfile($userId, $firstname, $lastname, $username, $age, $email, $phone_number, $password, $password_confirmation)
    {

        $query = "UPDATE users SET
                  firstname = ?,
                  lastname = ?,
                  username = ?,
                  age = ?,
                  email = ?,
                  phone_number = ?,
                  password = ?,
                  password_confirmation = ?
                  WHERE id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->execute(array($firstname, $lastname, $username, $age, $email, $phone_number, $password, $password_confirmation, $userId));
    }
}