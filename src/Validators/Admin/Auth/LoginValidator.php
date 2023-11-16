<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Validators\Admin\Auth;

use App\Helpers\Managers\SessionManager;
use App\Http\Repository\Admin\Auth\LoginRepository;

class LoginValidator
{
    public static function authenticate()
    {
        $errors = [];

        if (isset($_POST['submit'])) {

            // --- Admin Name
            if (isset($_POST['admin_name']) && !empty($_POST['admin_name'])) {

                // --- Admin Password
                if (isset($_POST['admin_password']) && !empty($_POST['admin_password'])) {

                    $admin_name = htmlspecialchars($_POST['admin_name']);
                    $admin_password = htmlspecialchars(sha1($_POST['admin_password']));

                    $repo = new LoginRepository();
                    $req = $repo->db->prepare('SELECT * FROM users WHERE role = ? AND username = ? AND password = ?');
                    $exec = $req->execute(array('ROLE_ADMIN', $admin_name, $admin_password));
                    $exist = $req->rowCount();
                    $admin = $req->fetch(\PDO::FETCH_OBJ);
                    if ($exist != 0) {
                        $manager = new SessionManager();
                        if (!empty($admin) && isset($admin)) {
                            $manager->set('admin_login', 1);
                            $manager->set('admin', $admin);
                            header('Location: /admin');
                            exit;
                        }
                    } else {
                        $errors[] = 'Cet administrateur n\'existe pas';
                    }

                } else {
                    $errors[] = 'Veuillez entre un mot de passe d\'administrateur';
                }

            } else {
                $errors[] = 'Veuillez entrer un nom d\'aministrateur';
            }

        }

        return $errors;
    }
}