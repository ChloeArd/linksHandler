<?php
namespace Chloe\LinksHandler\Model\Manager;

use Chloe\LinksHandler\Model\DB;
use Chloe\LinksHandler\Model\Entity\Role;
use Chloe\LinksHandler\Model\Manager\Traits\ManagerTrait;

class RoleManager {

    use ManagerTrait;

    /**
     * Return a role based on id.
     * @param int $id
     */
    public function getRole(int $id) {
        $request = DB::getInstance()->prepare("SELECT * FROM prefix_role WHERE id = $id");
        $request->execute();
        $info = $request->fetch();
        $role = new Role();
        if ($info) {
            $role->setId($info['id']);
            $role->setRole($info['role']);
        }
        return $role;
    }

    /**
     * Return all roles
     * @return array
     */
    public function getRoles(): array {
        $roles = [];
        $request = DB::getInstance()->prepare("SELECT * FROM prefix_role");
        $request->execute();
        $roles_response = $request->fetchAll();
        if($roles_response) {
            foreach($roles_response as $info) {
                $roles[] = new Role($info['id'], $info['role']);
            }
        }
        return $roles;
    }
}