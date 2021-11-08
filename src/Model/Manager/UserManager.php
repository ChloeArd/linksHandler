<?php
namespace Chloe\LinksHandler\Model\Manager;

require_once "Traits/ManagerTrait.php";
require_once "RoleManager.php";

use Chloe\LinksHandler\Model\DB;
use Chloe\LinksHandler\Model\Entity\User;
use Chloe\LinksHandler\Model\Manager\Traits\ManagerTrait;

class UserManager {

    use ManagerTrait;

    private RoleManager $roleManager;

    public function __construct() {
        $this->roleManager = new RoleManager();
    }

    /**
     * Return a user based on id.
     * @param $id
     * @return User
     */
    public function getUser( $id): User {
        $request = DB::getInstance()->prepare("SELECT * FROM f07409276b_user WHERE id = :id");
        $id = intval($id);
        $request->bindParam(":id", $id);
        $request->execute();
        $info = $request->fetch();
        $user = new User();
        if ($info) {
            $user->setId($info['id']);
            $user->setFirstname($info['firstname']);
            $user->setLastname($info['lastname']);
            $user->setEmail($info['email']);
            $user->setPassword(''); // We do not display the password
            $role = $this->roleManager->getRole($info['role_fk']);
            $user->setRoleFk($role);
        }
        return $user;
    }

    /**
     * Change the user's password.
     * @param User $user
     * @return bool
     */
    public function updatePasswordUser(User $user): bool {
        $request = DB::getInstance()->prepare("UPDATE f07409276b_user SET password = :password WHERE id = :id");
        $request->bindValue(':id', $user->getId());
        $request->bindValue(':password', $user->setPassword($user->getPassword()));
        return $request->execute();
    }

    /**
     * Modifies the user's personal information.
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool {
        $request = DB::getInstance()->prepare("UPDATE f07409276b_user SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id");
        $request->bindValue(':id', $user->getId());
        $request->bindValue(':firstname', $user->setFirstname($user->getFirstname()));
        $request->bindValue(':lastname', $user->setLastname($user->getLastname()));
        $request->bindValue(':email', $user->setEmail($user->getEmail()));
        return $request->execute();
    }

    /**
     * Deletes a user but also deletes the categories, subjects, comments
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool {
        $request = DB::getInstance()->prepare("DELETE FROM f07409276b_link WHERE user_fk = :user_fk");
        $request->bindParam(":user_fk", $id);
        $request->execute();
        $request = DB::getInstance()->prepare("DELETE FROM f07409276b_user WHERE id = :id");
        $request->bindParam(":id", $id);

        session_start();
        session_unset();
        session_destroy();

        return $request->execute();
    }
}