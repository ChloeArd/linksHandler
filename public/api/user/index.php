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

    case 'PUT' :
        $response = [
            'error' => 'success',
            'message' => 'Modifié avec succès.',
        ];

        $data = json_decode(file_get_contents('php://input'));
        if (isset($data->id, $data->firstname, $data->lastname, $data->email)) {
            $id = intval($data->id);
            $firstname = htmlentities(trim(ucfirst($data->firstname)));
            $lastname = htmlentities(trim(ucfirst($data->lastname)));
            $email = htmlentities(trim($data->email));

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                session_start();
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['email'] = $email;

                $user = new User($id, $firstname, $lastname, $email);
                $result = $manager->update($user);

                if (!$result) {
                    $response = [
                        'error' => 'error1',
                        'message' => 'Une erreur est survenue.',
                    ];
                }
            }
            else {
                $response = [
                    'error' => 'error2',
                    'message' => 'L\'email n\'est pas valide.',
                ];
            }
        }
        else {
            $response = [
                'error' => 'error3',
                'message' => 'Tous les champs ne sont pas complétés.',
            ];
        }
        echo json_encode($response);
        break;

    case 'DELETE' :
        $response = [
            'error' => 'success',
            'message' => 'Votre compte a été supprimé avec succès.',
        ];

        $data = json_decode(file_get_contents('php://input'));
        if (isset($data->id)) {
            $id = intval($data->id);
            $result = $manager->delete($id);

            if (!$result) {
                $response = [
                    'error' => 'error1',
                    'message' => 'Une erreur est survenue.',
                ];
            }
        }
        else {
            $response = [
                'error' => 'error2',
                'message' => 'L\'id est manquant.',
            ];
        }
        echo json_encode($response);
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