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
        $request = DB::getInstance()->prepare("SELECT * FROM prefix_user WHERE id = :id");
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
}