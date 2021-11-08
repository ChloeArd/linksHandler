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
    case 'PUT' :
        $response = [
            'error' => 'success',
            'message' => 'Modifié avec succès.',
        ];

        $data = json_decode(file_get_contents('php://input'));
        if (isset($data->id, $data->firstname, $data->lastname, $data->email)) {
            $id = intval($data->id);
            $passN = htmlentities(trim(($data->passN)));
            $pass = htmlentities(trim(($data->pass)));
            $passR = htmlentities(trim($data->passR));

            if ($passN === $_SESSION['password']) {
                $maj = preg_match('@[A-Z]@', $pass);
                $min = preg_match('@[a-z]@', $pass);
                $number = preg_match('@[0-9]@', $pass);
                // Checks if the new password contains an uppercase, a lowercase, a number and that it has a length greater than or equal to 8.
                if ($maj && $min && $number && strlen($pass) >= 8) {
                    if ($pass === $passR) {
                        // The password is encrypted in the database.
                        $passwordCrypt = password_hash($pass, PASSWORD_BCRYPT);
                        session_start();
                        $_SESSION['password'] = $passwordCrypt;

                        $user = new User($id, '', '', '', $passwordCrypt);
                        $result = $manager->updatePasswordUser($user);

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
                            'message' => 'Les nouveaux mots de passes ne correspondent pas.',
                        ];
                    }
                }
                else {
                    $response = [
                        'error' => 'error3',
                        'message' => 'Le mot de passe ne contient soit pas de minuscule, majuscule, chiffre ou est inférieur à 8 caractères.',
                    ];
                }
            }
            else {
                $response = [
                    'error' => 'error4',
                    'message' => 'L\'email n\'est pas valide.',
                ];
            }
        }
        else {
            $response = [
                'error' => 'error5',
                'message' => 'Tous les champs ne sont pas complétés.',
            ];
        }
        echo json_encode($response);
        break;
}