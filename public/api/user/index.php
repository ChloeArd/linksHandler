<?php

require_once '../../../src/Model/DB.php';
require_once '../../../src/Model/Entity/User.php';
require_once '../../../src/Model/Manager/UserManager.php';


use Chloe\LinksHandler\Model\Entity\User;
use Chloe\LinksHandler\Model\Manager\UserManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];
$manager = new UserManager();

switch ($requestType) {
    case 'GET':
        if(isset($_GET['id'])) {
            echo getUser($manager, intval($_GET['id']));
        }
        break;
}

/**
 * Return the user
 * @param UserManager $manager
 * @return false|string
 */
function getUser(UserManager $manager, int $id): string {
    $response = [];
    $data = $manager->getUser($id);
    foreach ($data as $user) {
        $response[] = [
            'id' => $user->getId(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'role_fk' => $user->getRoleFk()
        ];
    }
    return json_encode($response);
}